<?php
 
namespace App\Http\Controllers;
 
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class ReviewController extends Controller
{
    /**
     * Tampilkan halaman ulasan Pelaku Usaha (Form + Riwayat Ulasan).
     */
    public function index()
    {
        $user = Auth::user();

        // Admin DPN langsung diarahkan ke halaman moderasi ulasan
        if ($user->isDpn()) {
            return redirect()->route('admin.reviews.index');
        }

        $myReviews = Review::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $approvedReviews = Review::with('user')
            ->where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        return view('ulasan.index', compact('myReviews', 'approvedReviews'));
    }
 
    /**
     * Simpan ulasan baru dari Pelaku Usaha (moderasi default: false).
     */
    public function store(Request $request)
    {
        $request->validate([
            'module_type' => 'required|in:non_berusaha,berusaha,kebijakan,lapolpa,umum',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ], [
            'rating.required' => 'Rating bintang wajib dipilih.',
            'comment.required' => 'Catatan ulasan wajib diisi.',
            'comment.max' => 'Catatan ulasan maksimal 1000 karakter.',
        ]);
 
        $user = Auth::user();
        $moduleType = $request->input('module_type');
        $rating = (int) $request->input('rating');
        
        // Untuk module_type 'umum', module_id diisi 0. Untuk yang lain, ambil dari input (default 0 jika kosong)
        $moduleId = $moduleType === 'umum' ? 0 : (int) $request->input('module_id', 0);
 
        // Proteksi anti-spam: Cek apakah user sudah mengulas permohonan/layanan ini
        $existing = Review::where('user_id', $user->id)
            ->where('module_type', $moduleType)
            ->where('module_id', $moduleId)
            ->first();
 
        if ($existing) {
            return redirect()->back()->withErrors(['review_spam' => 'Anda sudah memberikan ulasan untuk layanan ini sebelumnya.']);
        }
 
        // Konversi rating angka menjadi label teks
        $ratingLabels = [
            5 => 'Sangat Baik',
            4 => 'Baik',
            3 => 'Cukup Baik',
            2 => 'Kurang',
            1 => 'Sangat Kurang'
        ];
        $label = $ratingLabels[$rating] ?? 'Baik';
 
        $isApproved = $rating >= 4;

        Review::create([
            'user_id' => $user->id,
            'module_type' => $moduleType,
            'module_id' => $moduleId,
            'rating' => $rating,
            'rating_label' => $label,
            'comment' => $request->input('comment'),
            'is_approved' => $isApproved, // Otomatis disetujui jika rating 4 atau 5
        ]);
 
        $msg = $isApproved 
             ? 'Ulasan Anda berhasil dikirim dan telah diterbitkan di halaman utama!' 
             : 'Ulasan Anda berhasil dikirim! Ulasan akan ditampilkan setelah disetujui oleh admin DPN.';

        return redirect()->back()->with('success', $msg);
    }
 
    /**
     * Tampilkan halaman pengelolaan ulasan bagi Admin (DPN).
     * Terbagi 3 kategori terpisah:
     * 1. Layanan Perizinan & Pertimbangan Teknis (PKKPR, Kebijakan, dll.)
     * 2. Layanan LAPOL PAK (Pelaporan & Tatap Muka)
     * 3. Layanan INFORMAL (Peta Digital & Zonasi)
     */
    public function adminIndex(Request $request)
    {
        $user = Auth::user();
        if (!($user->isDpn() || $user->isBpn() || $user->isDinasPu() || $user->isDinasPutr() || $user->isSatuPintu() || $user->isAdminBerita())) {
            abort(403, 'Anda tidak memiliki akses ke halaman evaluasi ulasan.');
        }

        $layanan = $request->input('layanan');

        // 1. Ulasan Layanan Perizinan & Kebijakan
        $queryPerizinan = Review::with('user')
            ->whereIn('module_type', ['berusaha', 'non_berusaha', 'kebijakan', 'tanah_timbul', 'psn', 'umum'])
            ->orderBy('rating', 'desc')
            ->orderBy('created_at', 'desc');

        // 2. Ulasan Layanan LAPOL PAK
        $queryLapolpa = Review::with('user')
            ->where('module_type', 'lapolpa')
            ->orderBy('rating', 'desc')
            ->orderBy('created_at', 'desc');

        // 3. Ulasan Peta Digital INFORMAL
        $queryInformal = \App\Models\InformalRating::with('user')
            ->where(function($q) {
                $q->where('informal_type', '!=', 'LAPOLPA')
                  ->orWhereNull('informal_type');
            })
            ->orderBy('rating', 'desc')
            ->orderBy('created_at', 'desc');

        if ($layanan) {
            if ($layanan === 'lapolpa') {
                $queryPerizinan->whereRaw('1 = 0');
                $queryInformal->whereRaw('1 = 0');
            } elseif ($layanan === 'informal') {
                $queryPerizinan->whereRaw('1 = 0');
                $queryLapolpa->whereRaw('1 = 0');
            } elseif ($layanan === 'perizinan') {
                $queryLapolpa->whereRaw('1 = 0');
                $queryInformal->whereRaw('1 = 0');
            } else {
                $queryPerizinan->where('module_type', $layanan);
                $queryLapolpa->whereRaw('1 = 0');
                $queryInformal->whereRaw('1 = 0');
            }
        }

        $reviews = $queryPerizinan->get();
        $lapolpaReviews = $queryLapolpa->get();
        $informalRatings = $queryInformal->get();
        
        return view('admin.reviews', compact('reviews', 'lapolpaReviews', 'informalRatings', 'layanan'));
    }
 
    /**
     * Setujui ulasan (layak ditampilkan).
     */
    public function approve($id)
    {
        if (!Auth::user()->isDpn()) {
            abort(403, 'Aksi tidak diizinkan.');
        }
 
        $review = Review::findOrFail($id);
        $review->is_approved = true;
        $review->save();
 
        return redirect()->route('admin.reviews.index')->with('success', 'Ulasan disetujui dan kini ditampilkan di halaman utama!');
    }
 
    /**
     * Hapus / Tolak ulasan.
     */
    public function destroy($id)
    {
        if (!Auth::user()->isDpn()) {
            abort(403, 'Aksi tidak diizinkan.');
        }
 
        $review = Review::findOrFail($id);
        $review->delete();
 
        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }
 
    public function approveInformal($id)
    {
        if (!Auth::user()->isDpn()) {
            abort(403, 'Aksi tidak diizinkan.');
        }
 
        $review = \App\Models\InformalRating::findOrFail($id);
        $review->is_approved = true;
        $review->save();
 
        return redirect()->back()->with('success', 'Ulasan Peta Informal berhasil disetujui dan kini tampil publik.');
    }
 
    public function destroyInformal($id)
    {
        if (!Auth::user()->isDpn()) {
            abort(403, 'Aksi tidak diizinkan.');
        }
 
        $review = \App\Models\InformalRating::findOrFail($id);
        $review->delete();
 
        return redirect()->back()->with('success', 'Ulasan Peta Informal berhasil dihapus.');
    }

    /**
     * Update / Edit Ulasan Formal oleh Admin DPN.
     */
    public function update(Request $request, $id)
    {
        if (!Auth::user()->isSuperAdmin()) {
            abort(403, 'Aksi edit ulasan hanya diizinkan untuk akun Super Admin NaooSU.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review = Review::findOrFail($id);
        $rating = (int) $request->input('rating');
        $ratingLabels = [
            5 => 'Sangat Memuaskan',
            4 => 'Memuaskan',
            3 => 'Cukup',
            2 => 'Kurang',
            1 => 'Sangat Kurang'
        ];

        $review->rating = $rating;
        $review->rating_label = $ratingLabels[$rating] ?? 'Memuaskan';
        $review->comment = $request->input('comment');
        if ($request->has('is_approved')) {
            $review->is_approved = (bool) $request->input('is_approved');
        }
        $review->save();

        return redirect()->back()->with('success', 'Ulasan berhasil diperbarui!');
    }

    /**
     * Update / Edit Ulasan Informal oleh Admin DPN.
     */
    public function updateInformal(Request $request, $id)
    {
        if (!Auth::user()->isSuperAdmin()) {
            abort(403, 'Aksi edit ulasan hanya diizinkan untuk akun Super Admin NaooSU.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
            'name' => 'nullable|string|max:150',
        ]);

        $review = \App\Models\InformalRating::findOrFail($id);
        $review->rating = (int) $request->input('rating');
        $review->comment = $request->input('comment');
        if ($request->filled('name')) {
            $review->name = $request->input('name');
        }
        if ($request->has('is_approved')) {
            $review->is_approved = (bool) $request->input('is_approved');
        }
        $review->save();

        return redirect()->back()->with('success', 'Ulasan Informal berhasil diperbarui!');
    }
}

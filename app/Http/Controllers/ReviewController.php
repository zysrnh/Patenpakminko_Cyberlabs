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
 
        return view('ulasan.index', compact('myReviews'));
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
 
        Review::create([
            'user_id' => $user->id,
            'module_type' => $moduleType,
            'module_id' => $moduleId,
            'rating' => $rating,
            'rating_label' => $label,
            'comment' => $request->input('comment'),
            'is_approved' => false, // Harus disetujui admin dulu sebelum tampil
        ]);
 
        return redirect()->back()->with('success', 'Ulasan Anda berhasil dikirim! Ulasan akan ditampilkan di halaman utama setelah disetujui oleh admin DPN.');
    }
 
    /**
     * Tampilkan halaman pengelolaan ulasan bagi Admin (DPN).
     */
    public function adminIndex()
    {
        if (!Auth::user()->isDpn()) {
            abort(403, 'Hanya DPN / Super Admin yang dapat mengelola ulasan.');
        }
 
        $reviews = Review::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.reviews', compact('reviews'));
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
 
        return redirect()->route('admin.reviews.index')->with('success', 'Ulasan berhasil dihapus.');
    }
}

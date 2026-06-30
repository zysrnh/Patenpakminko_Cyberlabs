<?php
 
namespace App\Http\Controllers;
 
use App\Models\LapolpaBooking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Mailbox;
 
class LapolpaController extends Controller
{
    /**
     * Tampilkan antarmuka LAPOLPAK berdasarkan peran user.
     */
    public function index()
    {
        $user = Auth::user();

        // Get holidays for datepicker
        $holidays = \App\Models\Holiday::pluck('date')->map(function($date) {
            return \Carbon\Carbon::parse($date)->format('Y-m-d');
        })->toArray();
 
        // Jika Guest (Belum Login)
        if (!$user) {
            return view('lapolpa.public_index', compact('holidays'));
        }

        // Jika Pelaku Usaha
        if ($user->isPelakuUsaha()) {
            // Ambil booking terakhir
            $booking = LapolpaBooking::where('user_id', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->first();
            return view('lapolpa.index', compact('booking', 'holidays'));
        }
 
        // Jika Admin (DPN) atau Petugas Instansi Lain
        $bookings = LapolpaBooking::with('user')->orderBy('booking_date', 'asc')->get();
        return view('lapolpa.admin_index', compact('bookings'));
    }
 
    /**
     * Simpan pemesanan jadwal pelaporan LAPOLPAK baru.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
 
        // Proteksi anti-spam: Cek apakah user sudah punya booking yang masih aktif (booked)
        if ($user) {
            $existingBooking = LapolpaBooking::where('user_id', $user->id)
                                ->where('status', 'booked')
                                ->first();
            if ($existingBooking) {
                return redirect()->route('lapolpa.index')->withErrors(['spam' => 'Anda masih memiliki jadwal pelaporan LAPOLPAKK yang aktif. Silakan tunggu hingga statusnya selesai sebelum membuat jadwal baru.']);
            }
        }
 
        $request->validate([
            'nama_pemohon' => $user ? 'nullable' : 'required|string|max:100',
            'whatsapp_number' => 'required|string|max:20',
            'booking_date' => 'required|date|after:today',
            'time_range' => 'required',
        ], [
            'nama_pemohon.required' => 'Nama pemohon/pengguna layanan wajib diisi.',
            'whatsapp_number.required' => 'Nomor WhatsApp wajib diisi.',
            'booking_date.required' => 'Tanggal booking wajib dipilih.',
            'booking_date.after' => 'Permohonan jadwal konsultasi wajib H-1 dari jadwal yang ditentukan.',
            'time_range.required' => 'Rentang waktu wajib dipilih.',
        ]);

        $times = explode('-', $request->input('time_range'));
        $timeStart = trim($times[0]);
        $timeEnd = trim($times[1] ?? '15:00');
 
        // Cek Kuota Maksimal 6 Pengajuan / Hari
        $bookingDate = Carbon::parse($request->input('booking_date'))->format('Y-m-d');
        $dailyCount = LapolpaBooking::whereDate('booking_date', $bookingDate)->count();

        if ($dailyCount >= 6) {
            return redirect()->back()->withInput()->withErrors(['booking_date' => 'Mohon maaf, kuota permohonan untuk tanggal tersebut sudah penuh (Maksimal 6 permohonan/hari). Silakan pilih tanggal lain.']);
        }

        // Simpan data booking
        $booking = LapolpaBooking::create([
            'user_id' => $user ? $user->id : null,
            'nama_pemohon' => $user ? ($user->name ?? $user->username) : $request->input('nama_pemohon'),
            'whatsapp_number' => $request->input('whatsapp_number'),
            'booking_date' => Carbon::parse($request->input('booking_date')),
            'time_start' => $timeStart,
            'time_end' => $timeEnd,
            'status' => 'booked',
        ]);
 
        // Kirim Notifikasi WhatsApp Fonnte ke Pemohon & Admin DPN
        $this->sendLapolpaNotifications($booking);
 
        return redirect()->route('lapolpa.success');
    }
 
    /**
     * Tampilkan halaman sukses setelah booking.
     */
    public function success()
    {
        return view('lapolpa.success');
    }

    /**
     * Memperbarui status booking oleh admin (Selesai/Batal).
     */
    public function updateStatus(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->isPelakuUsaha()) {
            abort(403, 'Aksi tidak diizinkan.');
        }
 
        $booking = LapolpaBooking::findOrFail($id);
        $request->validate([
            'status' => 'required|in:booked,diterima,selesai,ditolak',
            'admin_note' => 'nullable|string'
        ]);
 
        $booking->status = $request->input('status');
        if ($request->has('admin_note')) {
            $booking->admin_note = $request->input('admin_note');
        }
        $booking->save();
 
        // Kirim notifikasi update status ke pemohon
        $this->sendLapolpaStatusUpdateNotification($booking);
 
        return redirect()->route('lapolpa.index')->with('success', 'Status jadwal LAPOLPAK berhasil diperbarui.');
    }
 
    /**
     * Helper: Mendapatkan pengaturan WhatsApp.
     */
    private function getWhatsappSettings()
    {
        $path = storage_path('app/whatsapp_settings.json');
        if (file_exists($path)) {
            $settings = json_decode(file_get_contents($path), true);
        } else {
            $settings = [
                'connected' => true,
                'fonnte_token' => '',
            ];
        }
        return $settings;
    }
 
    /**
     * Kirim Notifikasi WhatsApp Awal.
     */
    private function sendLapolpaNotifications($booking)
    {
        $pemohonName = $booking->nama_pemohon ?? ($booking->user ? ($booking->user->name ?? $booking->user->username) : 'Tamu');
        $tglIndo = $booking->formatted_date;
        $rentangWaktu = $booking->formatted_time_range;
        $url = route('lapolpa.index');
 
        // 1. Pesan Notifikasi & Panduan ke Pelaku Usaha (Pemohon)
        $messagePemohon = "Halo *{$pemohonName}*,\n\n"
                        . "Terima kasih! Jadwal pelaporan LAPOLPAK Anda telah berhasil didaftarkan dengan status *BOOKED*.\n\n"
                        . "Rincian Jadwal:\n"
                        . "🗓️ Tanggal: {$tglIndo}\n"
                        . "⏰ Waktu: {$rentangWaktu}\n"
                        . "📱 WhatsApp: {$booking->whatsapp_number}\n\n"
                        . "📌 *PANDUAN PELAPORAN LAPOLPAK*:\n"
                        . "1. Mohon hadir tepat waktu sesuai jadwal yang telah dipilih.\n"
                        . "2. Siapkan dokumen identitas diri (KTP) asli.\n"
                        . "3. Bawa cetakan fisik dokumen permohonan PPKPR/izin terkait.\n"
                        . "4. Pastikan nomor WhatsApp Anda selalu aktif selama proses berlangsung.\n\n"
                        . "Lacak bukti pemesanan Anda melalui tautan berikut:\n{$url}";
        
        $settings = $this->getWhatsappSettings();
        if (!empty($settings['cp_admin'])) {
            $messagePemohon .= "\n\n_Jika ada pertanyaan, hubungi CP Admin: " . $settings['cp_admin'] . "_";
        }
        $wa_links = [];
        $mailboxes = [];

        $formatPhone = function($phone) {
            $phone = preg_replace('/[^0-9]/', '', $phone);
            if (str_starts_with($phone, '0')) {
                $phone = '62' . substr($phone, 1);
            }
            return $phone;
        };

        if ($booking->whatsapp_number) {
            $wa_links[] = [
                'target' => 'Pemohon (' . $pemohonName . ')',
                'url' => 'https://wa.me/' . $formatPhone($booking->whatsapp_number) . '?text=' . urlencode($messagePemohon)
            ];
            
            if ($booking->user_id) {
                $mailboxes[] = [
                    'target_user_id' => $booking->user_id,
                    'target_role' => null,
                    'title' => 'Notifikasi Pemohon - LAPOLPAK',
                    'message' => $messagePemohon,
                    'link' => $url,
                ];
            }
        }
 
        // 2. Pesan Notifikasi Pemberitahuan ke Admin (DPN)
        $admin = User::where('role', 'dpn')->first();
        $adminPhone = $admin ? $admin->phone_number : '081234567894';
        
        $messageAdmin = "Notifikasi LAPOLPAK: Pendaftaran Pelaporan Baru!\n\n"
                      . "Pemohon: {$pemohonName}\n"
                      . "Jadwal: {$tglIndo} ({$rentangWaktu})\n"
                      . "WhatsApp: {$booking->whatsapp_number}\n\n"
                      . "Silakan periksa dan kelola jadwal LAPOLPAK di dashboard admin: {$url}";
 
        $wa_links[] = [
            'target' => 'Admin DPN',
            'url' => 'https://wa.me/' . $formatPhone($adminPhone) . '?text=' . urlencode($messageAdmin)
        ];
        
        $mailboxes[] = [
            'target_user_id' => null,
            'target_role' => 'dpn',
            'title' => 'Pendaftaran LAPOLPAK Baru',
            'message' => $messageAdmin,
            'link' => $url,
        ];

        if (count($wa_links) > 0) {
            session()->flash('wa_links', $wa_links);
        }

        foreach ($mailboxes as $box) {
            \App\Models\Mailbox::create([
                'target_user_id' => $box['target_user_id'],
                'target_role' => $box['target_role'],
                'title' => $box['title'],
                'message' => $box['message'],
                'link' => $box['link'],
                'is_read' => false,
            ]);
        }
    }
 
    /**
     * Kirim Notifikasi Perubahan Status.
     */
    private function sendLapolpaStatusUpdateNotification($booking)
    {
        $pemohonName = $booking->nama_pemohon ?? ($booking->user ? ($booking->user->name ?? $booking->user->username) : 'Tamu');
        $tglIndo = $booking->formatted_date;
        $rentangWaktu = $booking->formatted_time_range;
        $statusLabel = $booking->status_label;
 
        $message = "Halo *{$pemohonName}*,\n\n"
                 . "Status Permohonan Fitur LAPOL PAK Anda untuk tanggal *{$tglIndo} ({$rentangWaktu})* telah diubah menjadi: *{$statusLabel}* oleh Kantor Pertanahan Sukabumi.\n\n";

        if ($booking->admin_note) {
            $message .= "Catatan dari Petugas:\n_{$booking->admin_note}_\n\n";
        }

        $message .= "Terima kasih atas kerja sama Anda.\n"
                 . "Lacak detail selengkapnya di: " . route('lapolpa.index');

        if ($booking->status === 'selesai') {
            $reviewLink = route('lapolpa.review.form', ['id' => $booking->id]);
            $message .= "\n\n⭐ *Mohon Berikan Ulasan Anda*\n"
                     . "Bantu kami meningkatkan kualitas layanan dengan mengisi ulasan singkat melalui tautan berikut:\n"
                     . $reviewLink;
        }
 
        $settings = $this->getWhatsappSettings();
        if (!empty($settings['cp_admin'])) {
            $message .= "\n\n_Jika ada pertanyaan, hubungi CP Admin: " . $settings['cp_admin'] . "_";
        }
 
        $formatPhone = function($phone) {
            $phone = preg_replace('/[^0-9]/', '', $phone);
            if (str_starts_with($phone, '0')) {
                $phone = '62' . substr($phone, 1);
            }
            return $phone;
        };

        $wa_links = [];
        if ($booking->whatsapp_number) {
            $wa_links[] = [
                'target' => 'Pemohon (' . $pemohonName . ')',
                'url' => 'https://wa.me/' . $formatPhone($booking->whatsapp_number) . '?text=' . urlencode($message)
            ];
            
            if ($booking->user_id) {
                \App\Models\Mailbox::create([
                    'target_user_id' => $booking->user_id,
                    'target_role' => null,
                    'title' => 'Update Status LAPOLPAK',
                    'message' => $message,
                    'link' => route('lapolpa.index'),
                    'is_read' => false,
                ]);
            }
            session()->flash('wa_links', $wa_links);
        }
    }
 
    /**
     * Tampilkan form ulasan publik khusus LAPOLPAK.
     */
    public function showReviewForm($id)
    {
        $booking = LapolpaBooking::findOrFail($id);
        
        // Cek apakah sudah pernah diulas
        $existingReview = \App\Models\InformalRating::where('informal_type', 'LAPOLPA')
                            ->where('latitude', $booking->id) // pinjam kolom latitude buat nyimpen ID booking
                            ->first();
                            
        if ($existingReview) {
            return redirect('/')->with('success', 'Anda sudah memberikan ulasan untuk jadwal ini. Terima kasih!');
        }

        return view('lapolpa.review', compact('booking'));
    }

    /**
     * Simpan ulasan publik khusus LAPOLPAK.
     */
    public function submitReview(Request $request, $id)
    {
        $booking = LapolpaBooking::findOrFail($id);
        
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string'
        ]);

        $isApproved = $request->rating >= 4;

        \App\Models\InformalRating::create([
            'user_id' => $booking->user_id,
            'name' => $booking->nama_pemohon,
            'informal_type' => 'LAPOLPA',
            'latitude' => $booking->id, // pinjam kolom latitude buat foreign key ke booking
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => $isApproved,
        ]);

        return redirect('/')->with('success', 'Terima kasih! Ulasan Anda telah berhasil dikirim.');
    }
}


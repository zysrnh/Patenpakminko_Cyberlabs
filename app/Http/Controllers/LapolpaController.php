<?php
 
namespace App\Http\Controllers;
 
use App\Models\LapolpaBooking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
 
class LapolpaController extends Controller
{
    /**
     * Tampilkan antarmuka LAPOLPA berdasarkan peran user.
     */
    public function index()
    {
        $user = Auth::user();
 
        // Jika Pelaku Usaha
        if ($user->isPelakuUsaha()) {
            $booking = LapolpaBooking::where('user_id', $user->id)->first();
            return view('lapolpa.index', compact('booking'));
        }
 
        // Jika Admin (DPN) atau Petugas Instansi Lain
        $bookings = LapolpaBooking::with('user')->orderBy('booking_date', 'asc')->get();
        return view('lapolpa.admin_index', compact('bookings'));
    }
 
    /**
     * Simpan pemesanan jadwal pelaporan LAPOLPA baru.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
 
        if (!$user->isPelakuUsaha()) {
            abort(403, 'Hanya Pelaku Usaha yang dapat melakukan booking LAPOLPA.');
        }
 
        // Proteksi anti-spam: Cek apakah user sudah pernah booking sebelumnya
        $existingBooking = LapolpaBooking::where('user_id', $user->id)->first();
        if ($existingBooking) {
            return redirect()->route('lapolpa.index')->withErrors(['spam' => 'Anda sudah pernah mendaftarkan jadwal pelaporan LAPOLPA. Anda tidak dapat mengirim laporan lebih dari sekali untuk mencegah spam.']);
        }
 
        $request->validate([
            'whatsapp_number' => 'required|string|max:20',
            'booking_date' => 'required|date|after_or_equal:today',
            'time_start' => 'required',
            'time_end' => 'required|after:time_start',
        ], [
            'whatsapp_number.required' => 'Nomor WhatsApp wajib diisi.',
            'booking_date.required' => 'Tanggal booking wajib dipilih.',
            'booking_date.after_or_equal' => 'Tanggal booking tidak boleh hari kemarin.',
            'time_start.required' => 'Jam mulai wajib diisi.',
            'time_end.required' => 'Jam selesai wajib diisi.',
            'time_end.after' => 'Jam selesai harus setelah jam mulai.',
        ]);
 
        // Simpan data booking
        $booking = LapolpaBooking::create([
            'user_id' => $user->id,
            'whatsapp_number' => $request->input('whatsapp_number'),
            'booking_date' => Carbon::parse($request->input('booking_date')),
            'time_start' => $request->input('time_start'),
            'time_end' => $request->input('time_end'),
            'status' => 'booked',
        ]);
 
        // Kirim Notifikasi WhatsApp Fonnte ke Pemohon & Admin DPN
        $this->sendLapolpaNotifications($booking);
 
        return redirect()->route('lapolpa.index')->with('success', 'Jadwal pelaporan LAPOLPA Anda berhasil didaftarkan! Detail jadwal dan panduan telah dikirimkan ke nomor WhatsApp Anda.');
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
            'status' => 'required|in:booked,selesai,dibatalkan'
        ]);
 
        $booking->status = $request->input('status');
        $booking->save();
 
        // Kirim notifikasi update status ke pemohon
        $this->sendLapolpaStatusUpdateNotification($booking);
 
        return redirect()->route('lapolpa.index')->with('success', 'Status jadwal LAPOLPA berhasil diperbarui.');
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
        $pemohonName = $booking->user->name ?? $booking->user->username;
        $tglIndo = $booking->formatted_date;
        $rentangWaktu = $booking->formatted_time_range;
        $url = route('lapolpa.index');
 
        // 1. Pesan Notifikasi & Panduan ke Pelaku Usaha (Pemohon)
        $messagePemohon = "Halo {$pemohonName},\n\nJadwal pelaporan LAPOLPA Anda berhasil terdaftar dengan status BOOKED!\n\n"
                        . "🗓️ Tanggal: {$tglIndo}\n"
                        . "⏰ Waktu: {$rentangWaktu}\n"
                        . "📱 WhatsApp terdaftar: {$booking->whatsapp_number}\n\n"
                        . "*PANDUAN PELAPORAN LAPOLPA UTK PEMOHON*:\n"
                        . "1. Hadir tepat waktu sesuai jadwal yang telah Anda pilih.\n"
                        . "2. Siapkan dokumen identitas diri (KTP) asli.\n"
                        . "3. Bawa cetakan dokumen permohonan PPKPR/izin terkait.\n"
                        . "4. Pastikan nomor WhatsApp Anda aktif selama proses pelaporan berlangsung.\n\n"
                        . "Lacak bukti booking Anda di dashboard: {$url}";
        
        $this->executeFonnteSend($booking->whatsapp_number, $messagePemohon);
 
        // 2. Pesan Notifikasi Pemberitahuan ke Admin (DPN)
        $admin = User::where('role', 'dpn')->first();
        $adminPhone = $admin ? $admin->phone_number : '081234567894';
        
        $messageAdmin = "Notifikasi LAPOLPA: Pendaftaran Pelaporan Baru!\n\n"
                      . "Pemohon: {$pemohonName}\n"
                      . "Jadwal: {$tglIndo} ({$rentangWaktu})\n"
                      . "WhatsApp: {$booking->whatsapp_number}\n\n"
                      . "Silakan periksa dan kelola jadwal LAPOLPA di dashboard admin: {$url}";
 
        $this->executeFonnteSend($adminPhone, $messageAdmin);
    }
 
    /**
     * Kirim Notifikasi Perubahan Status.
     */
    private function sendLapolpaStatusUpdateNotification($booking)
    {
        $pemohonName = $booking->user->name ?? $booking->user->username;
        $tglIndo = $booking->formatted_date;
        $rentangWaktu = $booking->formatted_time_range;
        $statusLabel = $booking->status_label;
 
        $message = "Halo {$pemohonName},\n\nStatus pelaporan LAPOLPA Anda untuk tanggal {$tglIndo} ({$rentangWaktu}) telah diubah oleh petugas menjadi:\n"
                 . "*{$statusLabel}*\n\n"
                 . "Terima kasih atas kerja sama Anda.\n"
                 . "Lacak detail selengkapnya di: " . route('lapolpa.index');
 
        $this->executeFonnteSend($booking->whatsapp_number, $message);
    }
 
    /**
     * Kirim notifikasi WA ke Fonnte API dan catat ke JSON log.
     */
    private function executeFonnteSend($phone, $message)
    {
        $settings = $this->getWhatsappSettings();
        $statusText = 'Simulasi';
        $fonnteResponse = null;
 
        if (!empty($settings['fonnte_token'])) {
            $recipientClean = preg_replace('/[^0-9]/', '', $phone);
            if (str_starts_with($recipientClean, '0')) {
                $recipientClean = '62' . substr($recipientClean, 1);
            }
 
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 20,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $recipientClean,
                    'message' => $message,
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ' . $settings['fonnte_token']
                ),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
 
            if (!$err) {
                $fonnteResponse = json_decode($response, true);
                if (isset($fonnteResponse['status']) && $fonnteResponse['status'] == true) {
                    $statusText = 'Terkirim (Fonnte API)';
                } else {
                    $statusText = 'Gagal (Fonnte: ' . ($fonnteResponse['reason'] ?? 'Kesalahan Token') . ')';
                }
            } else {
                $statusText = 'Gagal (Koneksi API Error)';
            }
        }
 
        $logPath = storage_path('app/whatsapp_logs.json');
        $logs = [];
        if (file_exists($logPath)) {
            $logs = json_decode(file_get_contents($logPath), true) ?: [];
        }
 
        $newLog = [
            'id' => uniqid(),
            'recipient' => $phone,
            'message' => $message,
            'timestamp' => now()->format('d M Y, H:i:s'),
            'status' => $statusText,
        ];
 
        array_unshift($logs, $newLog);
        file_put_contents($logPath, json_encode($logs, JSON_PRETTY_PRINT));
    }
}

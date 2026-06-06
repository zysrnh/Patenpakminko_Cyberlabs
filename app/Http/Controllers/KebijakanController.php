<?php
 
namespace App\Http\Controllers;
 
use App\Models\KebijakanApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
 
class KebijakanController extends Controller
{
    /**
     * Tampilkan daftar pengajuan Kebijakan Khusus.
     */
    public function index()
    {
        $user = Auth::user();
 
        // Jika Pelaku Usaha, tampilkan permohonan miliknya sendiri
        if ($user->isPelakuUsaha()) {
            $applications = KebijakanApplication::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
            return view('kebijakan.index', compact('applications'));
        }
 
        // Jika BPN, tampilkan semua permohonan agar dapat dipantau riwayatnya
        if ($user->isBpn()) {
            $applications = KebijakanApplication::orderBy('created_at', 'desc')->get();
            return view('kebijakan.index', compact('applications'));
        }
 
        // Jika DPN (Super Admin/Notifier), tampilkan semua permohonan
        if ($user->isDpn()) {
            $applications = KebijakanApplication::orderBy('created_at', 'desc')->get();
            return view('kebijakan.index', compact('applications'));
        }
 
        abort(403, 'Peran akun Anda tidak terdaftar dalam sistem.');
    }
 
    /**
     * Tampilkan form pengajuan baru.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('ptp.create')->with('info', 'Silakan isi formulir Permohonan PTP terlebih dahulu.');
        }

        if (!Auth::user()->isPelakuUsaha()) {
            abort(403, 'Hanya Pelaku Usaha yang dapat membuat pengajuan permohonan.');
        }

        return view('kebijakan.create');
    }
 
    /**
     * Simpan permohonan baru.
     */
    public function store(Request $request)
    {
        if (!Auth::check() || !Auth::user()->isPelakuUsaha()) {
            abort(403, 'Aksi tidak diizinkan.');
        }
 
        if (in_array($request->input('hubungan_pengaju'), ['Lainnya', 'Pemilik Usaha / Pengguna Layanan'])) {
            $request->merge([
                'hubungan_pengaju' => $request->input('hubungan_pengaju_lainnya') ?: $request->input('hubungan_pengaju')
            ]);
        }

        $request->validate([
            'nama_pemilik_usaha' => 'required|string|max:100',
            'nama_pengaju' => 'required|string|max:100',
            'hubungan_pengaju' => 'required|string|max:100',
            'peta_lokasi' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'surat_kuasa' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'fc_ktp' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'fc_npwp' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'fc_akta_pendirian' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'rencana_penggunaan_tanah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'nib' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'kbli_kode' => 'required|string|max:20',
            'kbli' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'proposal_kegiatan' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'persyaratan_lainnya' => 'nullable|file|mimes:pdf,jpg,jpeg,png,zip,rar|max:10240',
        ], [
            'nama_pemilik_usaha.required' => 'Nama pemilik usaha wajib diisi.',
            'nama_pengaju.required' => 'Nama pengaju wajib diisi.',
            'hubungan_pengaju.required' => 'Hubungan pengaju / sebagai apa wajib diisi.',
        ]);
 
        $data = $request->only([
            'nama_pemilik_usaha', 'nama_pengaju', 'hubungan_pengaju', 'kbli_kode'
        ]);
 
        $data['user_id'] = Auth::id();
        $data['status'] = 'menunggu_bpn';
        if (session()->has('ptp_form_data')) {
            $data['ptp_data'] = json_encode(session('ptp_form_data'));
        }
        
        // Generate Nomor Permohonan Kebijakan
        $data['application_number'] = 'KEBIJAKAN-' . date('Ymd') . '-' . strtoupper(Str::random(5));
 
        $filesToStore = [
            'peta_lokasi', 'surat_kuasa', 'fc_ktp', 'fc_npwp',
            'fc_akta_pendirian', 'rencana_penggunaan_tanah',
            'nib', 'kbli', 'proposal_kegiatan', 'persyaratan_lainnya'
        ];
 
        $pemilik = Str::slug($data['nama_pemilik_usaha'], '_');
        $timestamp = date('Ymd_His');
 
        foreach ($filesToStore as $fileKey) {
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                $extension = $file->getClientOriginalExtension();
                $fileName = "{$pemilik}_{$fileKey}_{$timestamp}.{$extension}";
                $data[$fileKey] = $file->storeAs('kebijakan_docs', $fileName, 'public');
            }
        }
 
        $app = KebijakanApplication::create($data);
        session()->forget('ptp_form_data');
        
        // Kirim Notifikasi WhatsApp
        $this->sendWhatsappNotification($app, 'Verifikasi Dokumen (BPN)', 'Berkas permohonan Kebijakan Khusus baru berhasil diajukan.');
 
        return redirect()->route('kebijakan.show', $app->application_number)->with('success', 'Permohonan Kebijakan Khusus Anda berhasil diajukan! Silakan pantau proses verifikasi.');
    }
 
    /**
     * Tampilkan detail permohonan.
     */
    public function show($id)
    {
        $application = KebijakanApplication::where('id', $id)->orWhere('application_number', $id)->firstOrFail();
        $user = Auth::user();
 
        // Keamanan: Pelaku usaha hanya boleh melihat permohonannya sendiri
        if ($user->isPelakuUsaha() && $application->user_id !== $user->id) {
            abort(403, 'Anda tidak diizinkan mengakses permohonan ini.');
        }
 
        return view('kebijakan.show', compact('application'));
    }
 
    /**
     * Download Formulir PTP dalam bentuk PDF.
     */
    public function ptpPdf($id)
    {
        $application = KebijakanApplication::where('id', $id)->orWhere('application_number', $id)->firstOrFail();
        
        // Pastikan ada data PTP
        if (!$application->ptp_data) {
            return back()->with('error', 'Data Formulir PTP tidak ditemukan untuk permohonan ini.');
        }

        $ptp = json_decode($application->ptp_data, true);
        $ptp['app_number'] = $application->application_number;
        $ptp = array_merge([
            "nama" => "-", "nik" => "-", "nib" => "-", "alamat" => "-", "phone_number" => "-", 
            "email" => "-", "bertindak_atas_nama" => "-", "anggaran_dasar_tanggal" => "-", 
            "anggaran_dasar_no" => "-", "rencana_kegiatan" => "-", "kbli" => "-", 
            "letak_tanah_jalan" => "-", "letak_tanah_kelurahan" => "-", "letak_tanah_kecamatan" => "-", 
            "luas_tanah" => "-", "status_penguasaan" => "-", "penggunaan_saat_ini" => "-"
        ], $ptp);


        // Gunakan Barryvdh\DomPDF\Facade\Pdf
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('berkas.ptp_pdf', $ptp);
        
        return $pdf->stream('Formulir_PTP_' . $application->application_number . '.pdf');
    }

    /**
     * Proses Verifikasi oleh BPN (Staged Verification).
     */
    public function verify(Request $request, $id)
    {
        $application = KebijakanApplication::where('id', $id)->orWhere('application_number', $id)->firstOrFail();
        $user = Auth::user();
        $step = $request->input('step');
 
        // ==========================================
        // SUB-ALUR BPN (4 LANGKAH BERTURUT-TURUT)
        // ==========================================
 
        // BPN Langkah 1: Verifikasi Berkas Awal
        if ($user->isBpn() && $application->status === 'menunggu_bpn' && $step === 'bpn_berkas') {
            $request->validate([
                'action' => 'required|in:approve,reject',
                'notes' => 'required|string|max:1000',
            ], [
                'notes.required' => 'Catatan pemeriksaan berkas wajib diisi.',
            ]);
 
            $action = $request->input('action');
            $notes = $request->input('notes');
 
            $application->bpn_notes = $notes;
            $application->bpn_berkas_status = $action === 'approve' ? 'diterima' : 'ditolak';
            
            if ($action === 'reject') {
                $application->status = 'ditolak';
                $msg = 'Permohonan ditolak pada verifikasi berkas awal oleh BPN.';
            } else {
                $msg = 'Berkas awal berhasil disetujui. Silakan tentukan jadwal cek lokasi.';
            }
            $application->save();
 
            // Kirim Notifikasi WhatsApp
            $this->sendCustomWhatsappNotification($application, 'berkas_verifikasi');
 
            return redirect()->route('kebijakan.show', $id)->with('success', $msg);
        }
 
        // BPN Langkah 2: Input Jadwal Cek Lokasi Lapangan
        if ($user->isBpn() && $application->status === 'menunggu_bpn' && $step === 'bpn_cek_lokasi') {
            $request->validate([
                'bpn_cek_lokasi_dt' => 'required|date',
                'bpn_cek_lokasi_cp' => 'required|string|max:100',
            ], [
                'bpn_cek_lokasi_dt.required' => 'Waktu peninjauan cek lokasi wajib ditentukan.',
                'bpn_cek_lokasi_cp.required' => 'Kontak person petugas lapangan wajib diisi.',
            ]);
 
            // Konversi datetime input ke format string Indonesia otomatis
            $dtInput = Carbon::parse($request->input('bpn_cek_lokasi_dt'));
            $dateLabel = $dtInput->locale('id')->translatedFormat('l, d F Y \J\a\m H:i \W\I\B');
 
            // Deteksi perubahan jadwal untuk template khusus
            $isReschedule = !empty($application->bpn_cek_lokasi_dt);
 
            $application->bpn_cek_lokasi_dt = $dtInput;
            $application->bpn_cek_lokasi_date = $dateLabel;
            $application->bpn_cek_lokasi_cp = $request->input('bpn_cek_lokasi_cp');
            $application->save();
 
            // Kirim Notifikasi WhatsApp
            $this->sendCustomWhatsappNotification($application, $isReschedule ? 'cek_lokasi_ubah' : 'cek_lokasi');
 
            return redirect()->route('kebijakan.show', $id)->with('success', 'Jadwal Cek Lokasi Lapangan berhasil disimpan & di-blast ke WhatsApp pemohon.');
        }
 
        // BPN Langkah 3: Input Jadwal Rapat Koordinasi
        if ($user->isBpn() && $application->status === 'menunggu_bpn' && $step === 'bpn_rapat') {
            $request->validate([
                'bpn_rapat_dt' => 'required|date',
            ], [
                'bpn_rapat_dt.required' => 'Waktu sidang/rapat koordinasi wajib ditentukan.',
            ]);
 
            // Konversi datetime input ke format string Indonesia otomatis
            $dtInput = Carbon::parse($request->input('bpn_rapat_dt'));
            $dateLabel = $dtInput->locale('id')->translatedFormat('l, d F Y \J\a\m H:i \W\I\B');
 
            // Deteksi perubahan jadwal untuk template khusus
            $isReschedule = !empty($application->bpn_rapat_dt);
 
            $application->bpn_rapat_dt = $dtInput;
            $application->bpn_rapat_date = $dateLabel;
            $application->save();
 
            // Kirim Notifikasi WhatsApp
            $this->sendCustomWhatsappNotification($application, $isReschedule ? 'rapat_ubah' : 'rapat');
 
            return redirect()->route('kebijakan.show', $id)->with('success', 'Jadwal Rapat Koordinasi berhasil disimpan & di-blast ke WhatsApp pemohon.');
        }
 
        // BPN Langkah 4: Penerbitan Pertek Akhir
        if ($user->isBpn() && $application->status === 'menunggu_bpn' && $step === 'bpn_pertek') {
            $request->validate([
                'action' => 'required|in:approve,reject',
                'notes' => 'required|string|max:1000',
                'bpn_pertek_document' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            ], [
                'notes.required' => 'Catatan rekomendasi teknis wajib diisi.',
                'bpn_pertek_document.mimes' => 'Dokumen Pertek Pertanahan harus berformat PDF, DOC, atau DOCX.',
                'bpn_pertek_document.max' => 'Ukuran berkas Pertek maksimal adalah 10MB.',
            ]);
 
            $action = $request->input('action');
            $notes = $request->input('notes');
 
            $application->bpn_notes = $notes;
            if ($action === 'approve') {
                if (!$request->hasFile('bpn_pertek_document')) {
                    return redirect()->back()->withErrors(['bpn_pertek_document' => 'Dokumen Pertek Pertanahan wajib diunggah saat menyetujui.']);
                }
                
                $path = $request->file('bpn_pertek_document')->store('bpn_perteks', 'public');
                $application->bpn_pertek_document = $path;
                $application->bpn_pertek_uploaded_at = now();
                $application->status = 'disetujui';
                $msg = 'Dokumen Pertek Pertanahan berhasil diterbitkan. Permohonan Kebijakan Khusus selesai dan disetujui!';
            } else {
                $application->status = 'ditolak';
                $msg = 'Permohonan ditolak pada tahap rekomendasi teknis BPN.';
            }
            $application->save();
 
            // Kirim Notifikasi WhatsApp khusus Pertek
            $this->sendCustomWhatsappNotification($application, $action === 'approve' ? 'pertek_terbit' : 'pertek_tolak');
 
            return redirect()->route('kebijakan.show', $id)->with('success', $msg);
        }
 
        abort(403, 'Aksi tidak diizinkan atau status permohonan tidak sesuai.');
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
                'template' => "Halo {nama_pemohon}, permohonan Kebijakan Khusus Anda ({nomor_registrasi}) saat ini memasuki tahap: {status_sekarang}.\n\nCatatan Pemeriksa: {catatan_terakhir}\n\nPantau detail pengajuan Anda di: {tautan_detail}",
            ];
            file_put_contents($path, json_encode($settings, JSON_PRETTY_PRINT));
        }
        return $settings;
    }
 
    /**
     * Helper: Menyimulasikan pengiriman notifikasi WhatsApp umum.
     */
    private function sendWhatsappNotification($application, $statusLabel, $notes)
    {
        $settings = $this->getWhatsappSettings();
        if (!$settings['connected']) {
            return;
        }
 
        $template = !empty($settings['template_kebijakan']) ? $settings['template_kebijakan'] : ($settings['template'] ?? '');
        $url = route('kebijakan.show', $application->id);
        
        $message = str_replace(
            ['{nama_pemohon}', '{nomor_registrasi}', '{status_sekarang}', '{catatan_terakhir}', '{tautan_detail}'],
            [$application->nama_pengaju ?: ($application->user->name ?? $application->user->username), $application->application_number, $statusLabel, $notes ?: '-', $url],
            $template
        );

        if (!empty($settings['cp_admin'])) {
            $message .= "\n\n_Jika ada pertanyaan, hubungi CP Admin: " . $settings['cp_admin'] . "_";
        }
 
        $this->executeFonnteSend($application->user->phone_number, $message);
    }
 
    /**
     * Kirim Notifikasi WhatsApp khusus sub-langkah BPN.
     */
    private function sendCustomWhatsappNotification($application, $type)
    {
        $settings = $this->getWhatsappSettings();
        if (!$settings['connected']) {
            return;
        }
 
        $url = route('kebijakan.show', $application->id);
        $namaPemohon = $application->nama_pengaju ?: ($application->user->name ?? $application->user->username);
 
        if ($type === 'berkas_verifikasi') {
            if ($application->bpn_berkas_status === 'diterima') {
                $message = "Halo {$namaPemohon}, dokumen persyaratan Permohonan Kebijakan Khusus Anda ({$application->application_number}) telah Diterima & Lolos verifikasi berkas awal oleh BPN.\n\n"
                         . "Selanjutnya, petugas BPN akan menentukan jadwal peninjauan lokasi offline. Pantau detail pengajuan Anda di: {$url}";
            } else {
                $message = "Halo {$namaPemohon}, dokumen persyaratan Permohonan Kebijakan Khusus Anda ({$application->application_number}) Ditolak oleh BPN dengan alasan:\n"
                         . "{$application->bpn_notes}\n\n"
                         . "Lacak permohonan Anda di: {$url}";
            }
        } elseif ($type === 'cek_lokasi') {
            $message = "Halo {$namaPemohon}, permohonan Kebijakan Khusus Anda ({$application->application_number}) dijadwalkan untuk Peninjauan Cek Lokasi Offline oleh Petugas BPN.\n\n"
                     . "Jadwal Cek: {$application->bpn_cek_lokasi_date}\n"
                     . "Kontak Person Petugas: {$application->bpn_cek_lokasi_cp}\n\n"
                     . "Harap mempersiapkan diri di lokasi sesuai jadwal. Lacak detail permohonan di: {$url}";
        } elseif ($type === 'cek_lokasi_ubah') {
            $message = "Halo {$namaPemohon}, [PERUBAHAN JADWAL] Jadwal Peninjauan Cek Lokasi Offline untuk permohonan Kebijakan Khusus Anda ({$application->application_number}) telah disesuaikan menjadi:\n\n"
                     . "Jadwal Baru: {$application->bpn_cek_lokasi_date}\n"
                     . "Kontak Person Petugas: {$application->bpn_cek_lokasi_cp}\n\n"
                     . "Lacak detail permohonan di: {$url}";
        } elseif ($type === 'rapat') {
            $message = "Halo {$namaPemohon}, permohonan Kebijakan Khusus Anda ({$application->application_number}) dijadwalkan untuk Sidang/Rapat Koordinasi Pertanahan BPN.\n\n"
                     . "Jadwal Rapat: {$application->bpn_rapat_date}\n\n"
                     . "Pantau detail permohonan Anda di: {$url}";
        } elseif ($type === 'rapat_ubah') {
            $message = "Halo {$namaPemohon}, [PERUBAHAN JADWAL] Jadwal Rapat Koordinasi BPN untuk permohonan Kebijakan Khusus Anda ({$application->application_number}) telah disesuaikan menjadi:\n\n"
                     . "Jadwal Baru: {$application->bpn_rapat_date}\n\n"
                     . "Pantau detail permohonan Anda di: {$url}";
        } elseif ($type === 'pertek_terbit') {
            $message = "Halo {$namaPemohon}, Rekomendasi Teknis / Pertek Pertanahan untuk permohonan Kebijakan Khusus Anda ({$application->application_number}) telah DITERBITKAN oleh Kantor Pertanahan (BPN).\n\n"
                     . "Catatan/Rekomendasi BPN: {$application->bpn_notes}\n\n"
                     . "Dengan terbitnya dokumen ini, permohonan Kebijakan Khusus Anda dinyatakan SELESAI dan DISETUJUI. Silakan buka dashboard untuk memantau detail dan mengunduh dokumen hasil akhir Anda di: {$url}";
        } elseif ($type === 'pertek_tolak') {
            $message = "Halo {$namaPemohon}, permohonan Kebijakan Khusus Anda ({$application->application_number}) DITOLAK oleh Kantor Pertanahan (BPN) pada tahap Rekomendasi Teknis dengan alasan:\n\n"
                     . "Catatan BPN: {$application->bpn_notes}\n\n"
                     . "Pantau detail pengajuan Anda di: {$url}";
        }
 
        $this->executeFonnteSend($application->user->phone_number, $message);
    }
 
    /**
     * Eksekusi curl fonnte untuk mengirim pesan WA dan log.
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


<?php

namespace App\Http\Controllers;

use App\Models\PpkprApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PpkprNonBerusahaController extends Controller
{
    /**
     * Tampilkan daftar pengajuan PPKPR.
     */
    public function index()
    {
        $user = Auth::user();

        // Jika Pelaku Usaha, tampilkan permohonan miliknya sendiri
        if ($user->isPelakuUsaha()) {
            $applications = PpkprApplication::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
            return view('non-berusaha.index', compact('applications'));
        }

        // Jika BPN, tampilkan semua permohonan agar dapat dipantau riwayatnya
        if ($user->isBpn()) {
            $applications = PpkprApplication::orderBy('created_at', 'desc')->get();
            return view('non-berusaha.index', compact('applications'));
        }

        // Jika Dinas PU, tampilkan permohonan yang menunggu verifikasi Dinas PU
        if ($user->isDinasPu()) {
            $applications = PpkprApplication::where('status', 'menunggu_dinas_pu')
                ->orderBy('created_at', 'asc')
                ->get();
            return view('non-berusaha.index', compact('applications'));
        }

        // Jika Satu Pintu, tampilkan permohonan yang menunggu verifikasi Satu Pintu
        if ($user->isSatuPintu()) {
            $applications = PpkprApplication::where('status', 'menunggu_satu_pintu')
                ->orderBy('created_at', 'asc')
                ->get();
            return view('non-berusaha.index', compact('applications'));
        }

        // Jika Dinas PUTR, tampilkan permohonan menunggu validasi PUTR
        if ($user->isDinasPutr()) {
            $applications = PpkprApplication::where('status', 'menunggu_putr')
                ->orderBy('created_at', 'asc')
                ->get();
            return view('non-berusaha.index', compact('applications'));
        }

        // Jika DPN (Super Admin/Notifier), tampilkan semua permohonan
        if ($user->isDpn()) {
            $applications = PpkprApplication::orderBy('created_at', 'desc')->get();
            return view('non-berusaha.index', compact('applications'));
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

        return view('non-berusaha.create');
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
            'nib' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'kbli_kode' => 'required|string|max:20',
            'kbli' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'proposal_kegiatan' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'persyaratan_lainnya' => 'required|file|mimes:pdf,jpg,jpeg,png,zip,rar|max:10240',
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
        
        // Generate Nomor Permohonan
        $data['application_number'] = 'PPKPR-NON-' . date('Ymd') . '-' . strtoupper(Str::random(5));

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
                $data[$fileKey] = $file->storeAs('ppkpr_docs', $fileName, 'public');
            }
        }

        $app = PpkprApplication::create($data);
        session()->forget('ptp_form_data');
        
        // Kirim Notifikasi WhatsApp
        $this->sendWhatsappNotification($app, 'Verifikasi Dokumen (BPN)', 'Berkas permohonan baru berhasil diajukan oleh pemohon.');

        return redirect()->route('pengajuan.sukses');
    }

    /**
     * Tampilkan detail permohonan.
     */
    public function show($id)
    {
        $application = PpkprApplication::where('id', $id)->orWhere('application_number', $id)->firstOrFail();
        $user = Auth::user();

        // Keamanan: Pelaku usaha hanya boleh melihat permohonannya sendiri
        if ($user->isPelakuUsaha() && $application->user_id !== $user->id) {
            abort(403, 'Anda tidak diizinkan mengakses permohonan ini.');
        }

        return view('non-berusaha.show', compact('application'));
    }

    /**
     * Download Formulir PTP dalam bentuk PDF.
     */
    public function ptpPdf($id)
    {
        $application = PpkprApplication::where('id', $id)->orWhere('application_number', $id)->firstOrFail();
        
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


        // Menggunakan PhpWord TemplateProcessor untuk cetak DOCX
        $templatePath = storage_path('app/public/doc/Formulir/Formulir Pertek 2026 Template.docx');
        if (!file_exists($templatePath)) {
            return back()->with('error', 'Template dokumen tidak ditemukan.');
        }

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);

        foreach ($ptp as $key => $value) {
            $templateProcessor->setValue($key, $value);
        }

        $fileName = 'Formulir_PTP_' . $application->application_number . '.docx';
        $tempFile = tempnam(sys_get_temp_dir(), 'PTP');
        $templateProcessor->saveAs($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }

    /**
     * Proses Verifikasi oleh Instansi Terkait (Staged Verification).
     */
    public function verify(Request $request, $id)
    {
        $application = PpkprApplication::where('id', $id)->orWhere('application_number', $id)->firstOrFail();
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
            if ($action === 'approve') {
                $application->bpn_berkas_status = 'diterima';
                $application->status = 'menunggu_putr'; // Lanjut ke PUTR untuk validasi pembayaran
                $msg = 'Berkas persyaratan berhasil diterima. Permohonan diteruskan ke Dinas PUTR untuk validasi pembayaran.';
            } else {
                $application->bpn_berkas_status = 'ditolak';
                $application->status = 'ditolak';
                $msg = 'Berkas persyaratan ditolak dan permohonan ditutup.';
            }
            $application->save();

            // Kirim notifikasi WA
            $this->sendCustomWhatsappNotification($application, 'berkas_verifikasi');

            return redirect()->route('non-berusaha.show', $id)->with('success', $msg);
        }

        // PUTR: Validasi Permohonan â†’ notif ke pemohon (cek pembayaran) & ke admin BPN
        if ($user->isDinasPutr() && $application->status === 'menunggu_putr' && $step === 'putr_validasi') {
            $request->validate(['action' => 'required|in:approve,reject', 'putr_notes' => 'nullable|string|max:1000']);
            $putrNotes = $request->input('putr_notes');

            if ($request->input('action') === 'approve') {
                $application->putr_validated_at = now();
                $application->putr_notes        = $putrNotes;
                $application->save();
                $this->sendCustomWhatsappNotification($application, 'putr_notif_payment'); // ke pemohon
                $this->sendWaToAdmin('admin_bpn', $application,                           // ke BPN
                    "[BPN] Permohonan Non-Berusaha {$application->application_number} telah divalidasi PUTR. Menunggu konfirmasi pembayaran pemohon. Detail: " . route('non-berusaha.show', $application->id));
                return redirect()->route('non-berusaha.show', $id)
                    ->with('success', 'Permohonan divalidasi. Notif pembayaran terkirim ke pemohon dan BPN.');
            } else {
                $application->status     = 'ditolak';
                $application->putr_notes = $putrNotes;
                $application->save();
                $this->sendWhatsappNotification($application, 'Permohonan Ditolak (PUTR)', $putrNotes);
                return redirect()->route('non-berusaha.show', $id)->with('success', 'Permohonan ditolak oleh Dinas PUTR.');
            }
        }

        // BPN: Konfirmasi Pembayaran + No. Berkas â†’ Blast Credentials ke pemohon
        if ($user->isBpn() && $application->status === 'menunggu_putr' && $step === 'bpn_konfirmasi_bayar') {
            $request->validate(['no_berkas' => 'required|string|max:100'], ['no_berkas.required' => 'Nomor berkas wajib diisi.']);
            $application->no_berkas          = $request->input('no_berkas');
            $application->credential_sent_at = now();
            $application->status             = 'menunggu_bpn'; // lanjut ke cek lokasi dst
            $application->save();
            $this->sendCustomWhatsappNotification($application, 'credential_blast');
            return redirect()->route('non-berusaha.show', $id)
                ->with('success', 'Pembayaran dikonfirmasi. Kredensial dikirim ke WA pemohon. No. Berkas: ' . $application->no_berkas);
        }

        // BPN Langkah 2: Jadwal Cek Lokasi (Fleksibel, bisa diubah berulang kali)
        if ($user->isBpn() && $application->status === 'menunggu_bpn' && $step === 'bpn_cek_lokasi') {
            $request->validate([
                'bpn_cek_lokasi_dt' => 'required|date',
                'bpn_cek_lokasi_cp' => 'required|string|max:255',
            ], [
                'bpn_cek_lokasi_dt.required' => 'Tanggal & Waktu cek lokasi wajib diisi.',
                'bpn_cek_lokasi_cp.required' => 'Kontak Person Petugas wajib diisi.',
            ]);

            $isUpdate = !is_null($application->bpn_cek_lokasi_dt);
            $dt = \Carbon\Carbon::parse($request->input('bpn_cek_lokasi_dt'));
            $application->bpn_cek_lokasi_dt   = $dt;
            $application->bpn_cek_lokasi_date = $dt->locale('id')->translatedFormat('l, d F Y \J\a\m H:i \W\I\B');
            $application->bpn_cek_lokasi_cp   = $request->input('bpn_cek_lokasi_cp');
            $application->save();

            // Kirim notifikasi WA
            $this->sendCustomWhatsappNotification($application, $isUpdate ? 'cek_lokasi_ubah' : 'cek_lokasi');

            $successMsg = $isUpdate ? 'Jadwal cek lokasi berhasil diubah dan dikirim ulang via WhatsApp!' : 'Jadwal cek lokasi berhasil disimpan dan dikirim ke pemohon via WhatsApp!';
            return redirect()->route('non-berusaha.show', $id)->with('success', $successMsg);
        }

        // BPN Langkah 3: Jadwal Rapat (Fleksibel, bisa diubah berulang kali)
        if ($user->isBpn() && $application->status === 'menunggu_bpn' && $step === 'bpn_rapat') {
            $request->validate([
                'bpn_rapat_dt' => 'required|date',
            ], [
                'bpn_rapat_dt.required' => 'Tanggal & Waktu Rapat Koordinasi wajib diisi.',
            ]);

            $isUpdate = !is_null($application->bpn_rapat_dt);
            $dt = \Carbon\Carbon::parse($request->input('bpn_rapat_dt'));
            $application->bpn_rapat_dt   = $dt;
            $application->bpn_rapat_date = $dt->locale('id')->translatedFormat('l, d F Y \J\a\m H:i \W\I\B');
            $application->save();

            // Kirim notifikasi WA
            $this->sendCustomWhatsappNotification($application, $isUpdate ? 'rapat_ubah' : 'rapat');

            $successMsg = $isUpdate ? 'Jadwal rapat berhasil diubah dan dikirim ulang via WhatsApp!' : 'Jadwal rapat koordinasi berhasil disimpan dan dikirim ke pemohon via WhatsApp!';
            return redirect()->route('non-berusaha.show', $id)->with('success', $successMsg);
        }

        // BPN Langkah 4: Penerbitan Pertek â†’ teruskan ke Dinas PU
        if ($user->isBpn() && $application->status === 'menunggu_bpn' && $step === 'bpn_pertek') {
            $request->validate([
                'action'              => 'required|in:approve,reject',
                'notes'               => 'required|string|max:1000',
                'bpn_pertek_document' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            ], [
                'notes.required'            => 'Catatan rekomendasi teknis wajib diisi.',
                'bpn_pertek_document.mimes' => 'Dokumen Pertek harus berformat PDF, DOC, atau DOCX.',
                'bpn_pertek_document.max'   => 'Ukuran berkas Pertek maksimal 10MB.',
            ]);

            $action = $request->input('action');
            $notes  = $request->input('notes');
            $application->bpn_notes = $notes;

            if ($action === 'approve') {
                if (!$request->hasFile('bpn_pertek_document')) {
                    return redirect()->back()->withErrors(['bpn_pertek_document' => 'Dokumen Pertek wajib diunggah saat menyetujui.']);
                }
                $path = $request->file('bpn_pertek_document')->store('bpn_perteks', 'public');
                $application->bpn_pertek_document = $path;
                $application->bpn_pertek_uploaded_at = now();
                $application->status = 'menunggu_dinas_pu'; // diteruskan ke Dinas PU
                $msg = 'Pertek diterbitkan. Permohonan diteruskan ke Dinas PU (Tata Ruang) untuk Penilaian PKKPR.';
            } else {
                $application->status = 'ditolak';
                $msg = 'Permohonan ditolak pada tahap rekomendasi teknis BPN.';
            }
            $application->save();
            $this->sendCustomWhatsappNotification($application, $action === 'approve' ? 'pertek_terbit' : 'pertek_tolak');
            return redirect()->route('non-berusaha.show', $id)->with('success', $msg);
        }

        // ==========================================
        // ALUR DINAS PU & SATU PINTU
        // ==========================================
        $request->validate([
            'action' => 'required|in:approve,reject',
            'notes' => 'required|string|max:1000',
            'approval_document' => 'nullable|file|mimes:pdf|max:10240', // Satu Pintu
        ], [
            'notes.required' => 'Catatan verifikasi wajib diisi.',
            'approval_document.mimes' => 'Dokumen PPKPR harus berformat PDF.',
            'approval_document.max' => 'Ukuran berkas dokumen PPKPR maksimal adalah 10MB.',
        ]);

        $action = $request->input('action');
        $notes = $request->input('notes');

        // 2. Verifikasi oleh Dinas PU
        if ($user->isDinasPu() && $application->status === 'menunggu_dinas_pu') {
            $application->dinas_pu_notes = $notes;
            if ($action === 'approve') {
                $application->status = 'menunggu_satu_pintu';
                $msg = 'Permohonan disetujui Dinas PU (Tata Ruang). Berkas diteruskan ke Dinas Satu Pintu.';
            } else {
                $application->status = 'ditolak';
                $msg = 'Permohonan ditolak oleh Dinas PU.';
            }
        }
        // 3. Verifikasi oleh Dinas Satu Pintu (Penerbitan PPKPR)
        elseif ($user->isSatuPintu() && $application->status === 'menunggu_satu_pintu') {
            $application->satu_pintu_notes = $notes;
            if ($action === 'approve') {
                // Satu Pintu harus mengunggah dokumen PPKPR final
                if (!$request->hasFile('approval_document')) {
                    return redirect()->back()->withErrors(['approval_document' => 'Dokumen PPKPR Final dalam format PDF wajib diunggah saat menyetujui.']);
                }
                
                $path = $request->file('approval_document')->store('ppkpr_approvals', 'public');
                $application->approval_document = $path;
                $application->status = 'disetujui';
                $msg = 'Permohonan disetujui! Dokumen PPKPR resmi telah diterbitkan.';
            } else {
                $application->status = 'ditolak';
                $msg = 'Permohonan ditolak oleh Dinas Satu Pintu.';
            }
        } else {
            abort(403, 'Anda tidak memiliki otoritas untuk memverifikasi permohonan ini pada tahap saat ini.');
        }

        $application->save();

        // Kirim Notifikasi WhatsApp
        $this->sendWhatsappNotification($application, $application->status_label, $notes);

        return redirect()->route('non-berusaha.show', $id)->with('success', $msg);
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

        $url = route('non-berusaha.show', $application->id);
        $namaPemohon = $application->nama_pengaju ?: ($application->user->name ?? $application->user->username);

        if ($type === 'berkas_verifikasi') {
            if ($application->bpn_berkas_status === 'diterima') {
                $message = "Halo {$namaPemohon}, dokumen persyaratan Permohonan PPKPR Non Berusaha Anda ({$application->application_number}) telah Diterima & Lolos verifikasi berkas awal oleh BPN.\n\n"
                         . "Permohonan Anda diteruskan ke Dinas PUTR untuk validasi dan proses pembayaran. Pantau detail pengajuan Anda di: {$url}";
            } else {
                $message = "Halo {$namaPemohon}, dokumen persyaratan Permohonan PPKPR Non Berusaha Anda ({$application->application_number}) Ditolak oleh BPN dengan alasan:\n"
                         . "{$application->bpn_notes}\n\n"
                         . "Lacak permohonan Anda di: {$url}";
            }
        } elseif ($type === 'cek_lokasi') {
            $waktu = \Carbon\Carbon::parse($application->bpn_cek_lokasi_date)->locale('id')->translatedFormat('l, d F Y \J\a\m H:i \W\I\B');
            $message = "Halo {$namaPemohon}, permohonan PPKPR Non Berusaha Anda ({$application->application_number}) dijadwalkan untuk peninjauan lapangan pada :\n\n"
                     . "Waktu: {$waktu}\n"
                     . "CP Lapangan/Admin: (atas nama) {$application->bpn_cek_lokasi_cp}\n\n"
                     . "Harap konfirmasi kesediaan anda dengan menghubungi Contact Person petugas lapangan diatas.";
        } elseif ($type === 'cek_lokasi_ubah') {
            $message = "Halo {$namaPemohon}, [PERUBAHAN JADWAL] Jadwal Peninjauan Cek Lokasi Offline untuk permohonan PPKPR Non Berusaha Anda ({$application->application_number}) telah disesuaikan menjadi:\n\n"
                     . "Jadwal Baru: {$application->bpn_cek_lokasi_date}\n"
                     . "Kontak Person Petugas: {$application->bpn_cek_lokasi_cp}\n\n"
                     . "Lacak detail permohonan di: {$url}";
        } elseif ($type === 'rapat') {
            $waktu = \Carbon\Carbon::parse($application->bpn_rapat_date)->locale('id')->translatedFormat('l, d F Y \J\a\m H:i \W\I\B');
            $message = "Halo {$namaPemohon}, sidang / rapat pembahasan pertimbangan teknis pertanahan untuk permohonan PKKPR Non Berusaha Anda ({$application->application_number}) dijadwalkan pada:\n\n"
                     . "Waktu: {$waktu}\n\n"
                     . "Pantau detail permohonan di: {$url}";
        } elseif ($type === 'rapat_ubah') {
            $message = "Halo {$namaPemohon}, [PERUBAHAN JADWAL] Jadwal Rapat Koordinasi BPN untuk permohonan PPKPR Non Berusaha Anda ({$application->application_number}) telah disesuaikan menjadi:\n\n"
                     . "Jadwal Baru: {$application->bpn_rapat_date}\n\n"
                     . "Pantau detail permohonan Anda di: {$url}";
        } elseif ($type === 'pertek_terbit') {
            $message = "Halo {$namaPemohon}, Pertimbangan Teknis Pertanahan untuk PKKPR dengan no berkas... {$application->application_number} telah DITERBITKAN oleh kantor pertanahan kota sukabumi. Proses selanjutnya di Dinas Pekerjaan Umum (PU) dan (PUTR) untuk dilakukan penilaian PKKPR Non Berusaha. informasi detail dapat diakases di {$url}";
        } elseif ($type === 'pertek_tolak') {
            $message = "Halo {$namaPemohon}, permohonan Non-Berusaha Anda ({$application->application_number}) DITOLAK BPN (tahap Pertek).\n\n"
                     . "Alasan: {$application->bpn_notes}\n\nPantau di: {$url}";
        } elseif ($type === 'putr_notif_payment') {
            $message = "Halo {$namaPemohon}, permohonan PPKPR Non-Berusaha Anda ({$application->application_number}) telah divalidasi Dinas PUTR.\n\n"
                     . "Silakan lakukan pembayaran retribusi sesuai informasi yang dikirim via email resmi kami.\n\n"
                     . "Setelah pembayaran dikonfirmasi BPN, Anda akan menerima WA berisi akun login dashboard. Pantau di: {$url}";
        } elseif ($type === 'credential_blast') {
            $ptpData  = json_decode($application->ptp_data, true) ?? [];
            $nik      = $ptpData['nik'] ?? '';
            $user     = $application->user;
            $username = $user->username ?? '-';
            $password = $nik ?: 'NIK Anda';
            $message  = "Halo {$namaPemohon}, pembayaran permohonan Non-Berusaha Anda ({$application->application_number}) telah dikonfirmasi.\n\n"
                      . "Berikut akun login portal PATEN PAK MIKO Anda:\n"
                      . "Username : {$username}\n"
                      . "Password : {$password}\n"
                      . "No. Berkas : {$application->no_berkas}\n\n"
                      . "Login dan pantau permohonan Anda di:\n" . url('/dashboard') . "\n\nBantuan: hubungi petugas BPN.";
        }

        $statusText = 'Simulasi';
        $fonnteResponse = null;

        if (!empty($settings['fonnte_token'])) {
            $recipient = $application->user->phone_number;
            $recipientClean = preg_replace('/[^0-9]/', '', $recipient);
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
            'recipient' => $application->user->phone_number,
            'message' => $message,
            'timestamp' => now()->format('d M Y, H:i:s'),
            'status' => $statusText,
        ];

        array_unshift($logs, $newLog);
        file_put_contents($logPath, json_encode($logs, JSON_PRETTY_PRINT));
    }

    /**
     * Tampilkan halaman pengaturan WhatsApp (Hanya DPN / Super Admin).
     */
    public function whatsappSettings()
    {
        if (!Auth::user()->isDpn()) {
            abort(403, 'Aksi tidak diizinkan. Hanya DPN / Super Admin yang dapat mengakses halaman ini.');
        }

        $settings = $this->getWhatsappSettings();

        // Ambil Log WhatsApp
        $logPath = storage_path('app/whatsapp_logs.json');
        $logs = [];
        if (file_exists($logPath)) {
            $logs = json_decode(file_get_contents($logPath), true) ?: [];
        }

        return view('dpn.whatsapp', compact('settings', 'logs'));
    }

    /**
     * Simpan template WhatsApp.
     */
    public function saveWhatsappSettings(Request $request)
    {
        if (!Auth::user()->isDpn()) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        $request->validate([
            'template'            => 'nullable|string|max:3000',
            'template_non_berusaha' => 'nullable|string|max:3000',
            'template_berusaha'   => 'nullable|string|max:3000',
            'template_kebijakan'  => 'nullable|string|max:3000',
            'template_tanah_timbul' => 'nullable|string|max:3000',
            'template_psn'        => 'nullable|string|max:3000',
            'template_lapolpa'    => 'nullable|string|max:3000',
        ]);

        $settings = $this->getWhatsappSettings();

        // Simpan semua template per-modul
        $templateKeys = ['template', 'template_non_berusaha', 'template_berusaha', 'template_kebijakan', 'template_tanah_timbul', 'template_psn', 'template_lapolpa'];
        foreach ($templateKeys as $key) {
            $val = $request->input($key);
            if ($val !== null) {
                $settings[$key] = $val;
            }
        }

        $this->saveSettings($settings);

        return redirect()->back()->with('success', 'Template notifikasi berhasil diperbarui!');
    }

    /**
     * Simpan konfigurasi Provider WA (Fonnte / Twilio).
     */
    public function saveProviderSettings(Request $request)
    {
        if (!Auth::user()->isDpn()) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        $request->validate([
            'provider'           => 'required|in:fonnte,twilio',
            'fonnte_token'       => 'nullable|string|max:500',
            'twilio_account_sid' => 'nullable|string|max:100',
            'twilio_auth_token'  => 'nullable|string|max:200',
            'twilio_from_number' => 'nullable|string|max:50',
            'twilio_channel'     => 'nullable|in:whatsapp,sms',
        ]);

        $settings = $this->getWhatsappSettings();
        $settings['provider']           = $request->input('provider', 'fonnte');
        $settings['fonnte_token']       = $request->input('fonnte_token') ?: ($settings['fonnte_token'] ?? '');
        $settings['twilio_account_sid'] = $request->input('twilio_account_sid') ?: ($settings['twilio_account_sid'] ?? '');
        $settings['twilio_auth_token']  = $request->input('twilio_auth_token') ?: ($settings['twilio_auth_token'] ?? '');
        $settings['twilio_from_number'] = $request->input('twilio_from_number') ?: ($settings['twilio_from_number'] ?? '');
        $settings['twilio_channel']     = $request->input('twilio_channel', 'whatsapp');
        $this->saveSettings($settings);

        $providerLabel = $settings['provider'] === 'twilio' ? 'Twilio' : 'Fonnte';
        return redirect()->back()->with('success', "Provider notifikasi berhasil diubah ke {$providerLabel}!");
    }

    /**
     * Hubungkan atau Putuskan Koneksi WhatsApp (Simulasi).
     */
    public function toggleWhatsappConnection(Request $request)
    {
        if (!Auth::user()->isDpn()) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        $settings = $this->getWhatsappSettings();
        $settings['connected'] = !$settings['connected'];
        
        if ($settings['connected']) {
            $settings['phone_number'] = $request->input('phone_number') ?: '081234567894';
            $settings['fonnte_token'] = $request->input('fonnte_token') ?: '';
        }

        $this->saveSettings($settings);

        $msg = $settings['connected'] ? 'WhatsApp Gateway berhasil dihubungkan!' : 'WhatsApp Gateway berhasil diputuskan!';
        return redirect()->back()->with('success', $msg);
    }

    /**
     * Helper: Mendapatkan pengaturan WhatsApp dari berkas JSON.
     */
    private function getWhatsappSettings()
    {
        $path = storage_path('app/whatsapp_settings.json');
        if (!file_exists($path)) {
            $default = [
                'connected' => false,
                'phone_number' => '081234567894',
                'fonnte_token' => '',
                'template' => "Halo {nama_pemohon}, permohonan PPKPR Non Berusaha Anda ({nomor_registrasi}) saat ini memasuki tahap: {status_sekarang}.\n\nCatatan Pemeriksa: {catatan_terakhir}\n\nPantau detail pengajuan Anda di: {tautan_detail}"
            ];
            file_put_contents($path, json_encode($default, JSON_PRETTY_PRINT));
            return $default;
        }
        $settings = json_decode(file_get_contents($path), true);
        if (!isset($settings['fonnte_token'])) {
            $settings['fonnte_token'] = '';
        }
        return $settings;
    }

    /**
     * Helper: Menyimpan pengaturan WhatsApp ke berkas JSON.
     */
    private function saveSettings($settings)
    {
        $path = storage_path('app/whatsapp_settings.json');
        file_put_contents($path, json_encode($settings, JSON_PRETTY_PRINT));
    }

    /**
     * Kirim WA ke nomor admin instansi berdasarkan key di settings (misal 'admin_bpn').
     */
    private function sendWaToAdmin(string $adminKey, $application, string $message): void
    {
        $settings = $this->getWhatsappSettings();
        if (!$settings['connected'] || empty($settings[$adminKey])) return;

        $numberClean = preg_replace('/[^0-9]/', '', $settings[$adminKey]);
        if (str_starts_with($numberClean, '0')) {
            $numberClean = '62' . substr($numberClean, 1);
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 20,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => ['target' => $numberClean, 'message' => $message],
            CURLOPT_HTTPHEADER     => ['Authorization: ' . $settings['fonnte_token']],
        ]);
        curl_exec($curl);
        curl_close($curl);

        $logPath = storage_path('app/whatsapp_logs.json');
        $logs    = file_exists($logPath) ? (json_decode(file_get_contents($logPath), true) ?: []) : [];
        array_unshift($logs, [
            'id'        => uniqid(),
            'recipient' => $settings[$adminKey] . ' (' . $adminKey . ')',
            'message'   => $message,
            'timestamp' => now()->format('d M Y, H:i:s'),
            'status'    => 'Terkirim ke admin',
        ]);
        file_put_contents($logPath, json_encode($logs, JSON_PRETTY_PRINT));
    }

    /**
     * Helper: Menyimulasikan pengiriman notifikasi WhatsApp dan mencatatnya ke log.
     */
    private function sendWhatsappNotification($application, $statusLabel, $notes)
    {
        $settings = $this->getWhatsappSettings();
        if (!$settings['connected']) {
            return; // Jangan kirim log jika status tidak terhubung
        }

        $template = !empty($settings['template_non_berusaha'])
            ? $settings['template_non_berusaha']
            : ($settings['template'] ?? '');
        $url = route('non-berusaha.show', $application->id);
        
        $message = str_replace(
            ['{nama_pemohon}', '{nomor_registrasi}', '{status_sekarang}', '{catatan_terakhir}', '{tautan_detail}'],
            [$application->nama_pengaju ?: ($application->user->name ?? $application->user->username), $application->application_number, $statusLabel, $notes ?: '-', $url],
            $template
        );

        if (!empty($settings['cp_admin'])) {
            $message .= "\n\n_Jika ada pertanyaan, hubungi CP Admin: " . $settings['cp_admin'] . "_";
        }

        $statusText = 'Simulasi';
        $fonnteResponse = null;

        // Kirim via Fonnte jika token diisi
        if (!empty($settings['fonnte_token'])) {
            $recipient = $application->user->phone_number;
            
            // Bersihkan format nomor telepon agar sesuai standar Fonnte (hanya angka)
            $recipientClean = preg_replace('/[^0-9]/', '', $recipient);
            if (str_starts_with($recipientClean, '0')) {
                // Konversi 08xxx menjadi format 628xxx
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
            'recipient' => $application->user->phone_number,
            'message' => $message,
            'timestamp' => now()->format('d M Y, H:i:s'),
            'status' => $statusText,
        ];

        array_unshift($logs, $newLog);
        file_put_contents($logPath, json_encode($logs, JSON_PRETTY_PRINT));
    }

    /**
     * Tampilkan template Formulir Berkas Persyaratan PPKPR Non-Berusaha (Siap Cetak).
     */
    public function templatePersyaratan()
    {
        return view('templates.persyaratan');
    }

    /**
     * Tampilkan template Surat Pernyataan Kebenaran Dokumen (Siap Cetak).
     */
    public function templatePernyataan()
    {
        return view('templates.pernyataan');
    }

    /**
     * Tampilkan template Surat Kuasa (Siap Cetak).
     */
    public function templateKuasa()
    {
        return view('templates.kuasa');
    }

    public function adminContacts()
    {
        if (!Auth::user()->isDpn()) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        $settings = $this->getWhatsappSettings();
        return view('dpn.contacts', compact('settings'));
    }

    public function saveAdminContacts(Request $request)
    {
        if (!Auth::user()->isDpn()) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        $request->validate([
            'admin_bpn' => 'nullable|string',
            'admin_putr' => 'nullable|string',
            'admin_dinas_pu' => 'nullable|string',
            'admin_satu_pintu' => 'nullable|string',
            'cp_admin' => 'nullable|string|max:100',
        ]);

        $settings = $this->getWhatsappSettings();
        $settings['admin_bpn'] = $request->input('admin_bpn');
        $settings['admin_putr'] = $request->input('admin_putr');
        $settings['admin_dinas_pu'] = $request->input('admin_dinas_pu');
        $settings['admin_satu_pintu'] = $request->input('admin_satu_pintu');
        $settings['cp_admin'] = $request->input('cp_admin') ?: '';
        $this->saveSettings($settings);

        return redirect()->back()->with('success', 'Kontak instansi berhasil diperbarui!');
    }
}


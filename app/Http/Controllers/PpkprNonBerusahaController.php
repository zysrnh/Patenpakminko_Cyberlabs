<?php

namespace App\Http\Controllers;

use App\Models\PpkprApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PpkprNonBerusahaController extends Controller
{
    use \App\Traits\WaBlastHelper;

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
            'peta_lokasi' => 'required|file|mimes:pdf,jpg,jpeg,png|max:1024000',
            'surat_kuasa' => 'required|file|mimes:pdf,jpg,jpeg,png|max:1024000',
            'fc_ktp' => 'required|file|mimes:pdf,jpg,jpeg,png|max:1024000',
            'fc_npwp' => 'required|file|mimes:pdf,jpg,jpeg,png|max:1024000',
            'fc_akta_pendirian' => 'required|file|mimes:pdf,jpg,jpeg,png|max:102400',
            'rencana_penggunaan_tanah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:102400',
            'nib' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:1024000',
            'kbli_kode' => 'required|string|max:20',
            'kbli' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:1024000',
            'proposal_kegiatan' => 'nullable|file|mimes:pdf,doc,docx|max:102400',
            'persyaratan_lainnya' => 'required|file|mimes:pdf,jpg,jpeg,png,zip,rar|max:102400',
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
        $this->sendNotificationWithMailbox($app, 'submit_berkas', 'PPKPR Non Berusaha', 'non-berusaha.show', $request->input('custom_wa_message'));

        Auth::logout();
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

        if ($user->isBpn() && $step === 'update_sla') {
            $request->validate([
                'tgl_mulai_layanan' => 'nullable|date',
                'tgl_selesai_layanan' => 'nullable|date',
            ]);
            $application->tgl_mulai_layanan = $request->filled('tgl_mulai_layanan') ? \Carbon\Carbon::parse($request->input('tgl_mulai_layanan')) : null;
            $application->tgl_selesai_layanan = $request->filled('tgl_selesai_layanan') ? \Carbon\Carbon::parse($request->input('tgl_selesai_layanan')) : null;
            $application->save();
            return redirect()->back()->with('success', 'Pengaturan SLA waktu layanan berhasil diperbarui.');
        }

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
                    $application->bpn_berkas_approved_at = now();
                $application->bpn_pembayaran_status = 'menunggu';
                // Tetap menunggu BPN untuk langkah pembayaran PNBP
                $msg = 'Berkas persyaratan berhasil diterima. Menunggu proses konfirmasi pembayaran PNBP.';
            } else {
                $application->bpn_berkas_status = 'ditolak';
                $application->status = 'ditolak';
                $msg = 'Berkas persyaratan ditolak dan permohonan ditutup.';
            }
            $application->save();

            // Kirim notifikasi WA
            $this->sendNotificationWithMailbox($application, 'berkas_verifikasi', 'PPKPR Non Berusaha', 'non-berusaha.show', $request->input('custom_wa_message'));

            return redirect()->route('non-berusaha.show', $id)->with('success', $msg);
        }

        // BPN Langkah 2: Konfirmasi Pembayaran PNBP + No. Berkas -> Blast Credentials ke pemohon
        if ($user->isBpn() && $application->status === 'menunggu_bpn' && $application->bpn_berkas_status === 'diterima' && $application->bpn_pembayaran_status === 'menunggu' && $step === 'bpn_konfirmasi_bayar') {
            $request->validate(['no_berkas' => 'required|string|max:100'], ['no_berkas.required' => 'Nomor berkas wajib diisi.']);
            $application->no_berkas          = $request->input('no_berkas');
            $application->bpn_pembayaran_status = 'sudah_bayar';
                    $application->bpn_pembayaran_approved_at = now();
            $application->credential_sent_at = now();
            $application->save();
            
            // Aktivasi Akun Pengguna
            $application->user->update(['is_active' => true]);

            $this->sendNotificationWithMailbox($application, 'credential_blast', 'PPKPR Non Berusaha', 'non-berusaha.show', $request->input('custom_wa_message'));
            return redirect()->route('non-berusaha.show', $id)
                ->with('success', 'Pembayaran PNBP dikonfirmasi. Kredensial telah dikirim ke WA pemohon. No. Berkas: ' . $application->no_berkas);
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
            $this->sendNotificationWithMailbox($application, $isUpdate ? 'cek_lokasi_ubah' : 'cek_lokasi', 'PPKPR Non Berusaha', 'non-berusaha.show', $request->input('custom_wa_message'));

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
            $this->sendNotificationWithMailbox($application, $isUpdate ? 'rapat_ubah' : 'rapat', 'PPKPR Non Berusaha', 'non-berusaha.show', $request->input('custom_wa_message'));

            $successMsg = $isUpdate ? 'Jadwal rapat berhasil diubah dan dikirim ulang via WhatsApp!' : 'Jadwal rapat koordinasi berhasil disimpan dan dikirim ke pemohon via WhatsApp!';
            return redirect()->route('non-berusaha.show', $id)->with('success', $successMsg);
        }

        // BPN Langkah 4: Penerbitan Pertek â†’ teruskan ke Dinas PU
        if ($user->isBpn() && $application->status === 'menunggu_bpn' && $step === 'bpn_pertek') {
            $request->validate([
                'action'              => 'required|in:approve,reject',
                'notes'               => 'required|string|max:1000',
                'bpn_pertek_document' => 'nullable|file|mimes:pdf,doc,docx|max:102400',
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
            $this->sendNotificationWithMailbox($application, $action === 'approve' ? 'pertek_terbit' : 'pertek_tolak', 'PPKPR Non Berusaha', 'non-berusaha.show', $request->input('custom_wa_message'));
            return redirect()->route('non-berusaha.show', $id)->with('success', $msg);
        }

        // Pelaku Usaha mengupload ulang berkas jika tidak sesuai
        if ($user->isPelakuUsaha() && $application->status === 'menunggu_bpn' && in_array($application->bpn_berkas_status, ['tidak_sesuai', 'ditolak']) && $step === 'reupload') {
            $request->validate([
                'peta_lokasi' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:1024000',
                'surat_kuasa' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:1024000',
                'fc_ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:1024000',
                'fc_npwp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:1024000',
                'fc_akta_pendirian' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:102400',
                'rencana_penggunaan_tanah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:102400',
                'nib' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:1024000',
                'kbli_kode' => 'nullable|string|max:20',
                'kbli' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:1024000',
                'proposal_kegiatan' => 'nullable|file|mimes:pdf,doc,docx|max:102400',
                'persyaratan_lainnya' => 'nullable|file|mimes:pdf,jpg,jpeg,png,zip,rar|max:102400',
            ]);
 
            $filesToStore = [
                'peta_lokasi', 'surat_kuasa', 'fc_ktp', 'fc_npwp',
                'fc_akta_pendirian', 'rencana_penggunaan_tanah',
                'nib', 'kbli', 'proposal_kegiatan', 'persyaratan_lainnya'
            ];
 
            foreach ($filesToStore as $fileKey) {
                if ($request->hasFile($fileKey)) {
                    $application->$fileKey = $request->file($fileKey)->store('ppkpr_docs', 'public');
                }
            }

            if ($request->filled('kbli_kode')) {
                $application->kbli_kode = $request->input('kbli_kode');
            }
            
            // Reset status berkas agar dicek ulang oleh BPN
            $application->bpn_berkas_status = 'menunggu';
            $application->status = 'menunggu_bpn';
            $application->save();
 
            // Notifikasi BPN ada berkas perbaikan masuk
            $this->sendNotificationWithMailbox($application, 'berkas_revisi_bpn', 'PPKPR Non Berusaha', 'non-berusaha.show', $request->input('custom_wa_message'));
 
            return redirect()->route('non-berusaha.show', $id)->with('success', 'Berkas perbaikan berhasil diunggah. Mohon tunggu verifikasi ulang dari BPN.');
        }

        // Resend Notifikasi WA (Admin Action)
        if ($step === 'resend_wa' && !$user->isPelakuUsaha()) {
            $type = $request->input('wa_type', 'berkas_verifikasi');
            
            if ($type === 'credential' && $application->user) {
                $application->user->update(['is_active' => true]);
            }

            $customMsg = $request->input('custom_wa_message');
            $this->sendNotificationWithMailbox($application, $type, 'PPKPR Non Berusaha', 'non-berusaha.show', $customMsg);
            return redirect()->route('non-berusaha.show', $id)->with('success', 'Tautan kirim ulang WhatsApp manual berhasil dimunculkan.');
        }

        // ==========================================
        // ALUR DINAS PU & SATU PINTU
        // ==========================================
        $request->validate([
            'action' => 'required|in:approve,reject',
            'notes' => 'required|string|max:1000',
            'approval_document' => 'nullable|file|mimes:pdf|max:102400', // Satu Pintu
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

        $type = 'pu_selesai';
        if ($user->isDinasPu()) {
            $type = $action === 'approve' ? 'pu_selesai' : 'pu_tolak';
        } elseif ($user->isSatuPintu()) {
            $type = $action === 'approve' ? 'pkkpr_terbit' : 'pkkpr_tolak';
        }

        // Kirim Notifikasi WhatsApp
        $this->sendNotificationWithMailbox($application, $type, 'PPKPR Non Berusaha', 'non-berusaha.show', $request->input('custom_wa_message'));

        return redirect()->route('non-berusaha.show', $id)->with('success', $msg);
    }

    public function adminContacts()
    {
        $settings = [];
        if (\Illuminate\Support\Facades\Storage::disk('local')->exists('whatsapp_settings.json')) {
            $settings = json_decode(\Illuminate\Support\Facades\Storage::disk('local')->get('whatsapp_settings.json'), true) ?? [];
        }

        return view('dpn.contacts', compact('settings'));
    }

    public function saveAdminContacts(Request $request)
    {
        $data = $request->except('_token');
        $settings = [];
        if (\Illuminate\Support\Facades\Storage::disk('local')->exists('whatsapp_settings.json')) {
            $settings = json_decode(\Illuminate\Support\Facades\Storage::disk('local')->get('whatsapp_settings.json'), true) ?? [];
        }
        $settings = array_merge($settings, $data);
        \Illuminate\Support\Facades\Storage::disk('local')->put('whatsapp_settings.json', json_encode($settings, JSON_PRETTY_PRINT));

        return redirect()->back()->with('success', 'Kontak Admin Instansi berhasil disimpan!');
    }
}

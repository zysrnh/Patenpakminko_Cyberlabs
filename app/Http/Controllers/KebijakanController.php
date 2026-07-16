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
    use \App\Traits\WaBlastHelper;

    /**
     * Tampilkan daftar pengajuan Kebijakan.
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
 
        // Instansi lain melihat semua permohonan agar dapat dipantau riwayatnya
        $applications = KebijakanApplication::orderBy('created_at', 'desc')->get();
        return view('kebijakan.index', compact('applications'));
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

        $ptp = session('ptp_form_data');
        $jenisPermohonan = $ptp['jenis_permohonan'] ?? 'kebijakan';

        $serviceName = 'Kebijakan / Lainnya';
        if ($jenisPermohonan === 'tanah-timbul') {
            $serviceName = 'Tanah Timbul';
        }

        return view('kebijakan.create', compact('serviceName', 'jenisPermohonan'));
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
            'nib' => 'required|file|mimes:pdf,jpg,jpeg,png|max:1024000',
            'kbli_kode' => 'required|string|max:20',
            'kbli' => 'required|file|mimes:pdf,jpg,jpeg,png|max:1024000',
            'proposal_kegiatan' => 'required|file|mimes:pdf,doc,docx|max:102400',
            'persyaratan_lainnya' => 'nullable|file|mimes:pdf,jpg,jpeg,png,zip,rar|max:102400',
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
        $this->sendNotificationWithMailbox($app, 'submit', 'Pertimbangan Teknis Pertanahan Kebijakan', 'kebijakan.show', $request->input('custom_wa_message'));
 
        Auth::logout();
        return redirect()->route('pengajuan.sukses');
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
    public function ptpPdf(Request $request, $id)
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

        if ($request->query('action') === 'download') {
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

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('berkas.ptp_pdf', $ptp);
        $pdf->setPaper([0, 0, 609.4488, 935.433], 'portrait');
        $filename = 'Formulir_PTP_' . $application->application_number . '.pdf';
        
        return $pdf->stream($filename);
    }

    /**
     * Proses Verifikasi oleh BPN (Staged Verification).
     */
    public function verify(Request $request, $id)
    {
        $application = KebijakanApplication::where('id', $id)->orWhere('application_number', $id)->firstOrFail();
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
                'sps_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            ], [
                'notes.required' => 'Catatan pemeriksaan berkas wajib diisi.',
                'sps_document.mimes' => 'Format file SPS harus PDF, JPG, JPEG, atau PNG.',
                'sps_document.max' => 'Ukuran file SPS maksimal 5MB.',
            ]);
 
            $action = $request->input('action');
            $notes = $request->input('notes');
 
            $application->bpn_notes = $notes;
            if ($action === 'approve') {
                if (!$request->hasFile('sps_document') && !$application->bpn_sps_document) {
                    return redirect()->back()->withErrors(['sps_document' => 'SPS wajib diunggah saat menyetujui berkas (Lengkap).']);
                }
                if ($request->hasFile('sps_document')) {
                    $application->bpn_sps_document = $request->file('sps_document')->store('sps_docs', 'public');
                }

                $application->bpn_berkas_status = 'diterima';
                $application->bpn_berkas_approved_at = now();
                $application->user->update(['is_active' => true]);
                $msg = 'Berkas awal berhasil disetujui. Silakan tentukan jadwal cek lokasi.';
            } else {
                $application->bpn_berkas_status = 'tidak_sesuai';
                $msg = 'Berkas dinyatakan tidak sesuai. Pelaku usaha telah dinotifikasi untuk perbaikan.';
            }
            $application->save();
 
            // Kirim Notifikasi WhatsApp
            $this->sendNotificationWithMailbox($application, 'berkas_verifikasi', 'Pertimbangan Teknis Pertanahan Kebijakan', 'kebijakan.show', $request->input('custom_wa_message'));
 
            return redirect()->route('kebijakan.show', $id)->with('success', $msg);
        }
 
        // BPN Langkah 2: Input Jadwal Cek Lokasi Lapangan
        
        // BPN Langkah 2: Konfirmasi Pembayaran PNBP
        if ($user->isBpn() && $application->status === 'menunggu_bpn' && $application->bpn_berkas_status === 'diterima' && $application->bpn_pembayaran_status === 'menunggu' && $step === 'bpn_konfirmasi_bayar') {
            $request->validate(['no_berkas' => 'required|string|max:100'], ['no_berkas.required' => 'Nomor berkas wajib diisi.']);
            $application->no_berkas          = $request->input('no_berkas');
            $application->bpn_pembayaran_status = 'sudah_bayar';
            $application->bpn_pembayaran_approved_at = now();
            $application->credential_sent_at = now();
            $application->save();
            
            // Aktivasi Akun Pengguna
            $application->user->update(['is_active' => true]);

            // Kirim notifikasi WA kredensial
            $this->sendNotificationWithMailbox($application, 'credential', 'Pertimbangan Teknis Pertanahan Kebijakan', 'kebijakan.show', $request->input('custom_wa_message'));

            // Redirect route
            $routeName = $application instanceof \App\Models\KebijakanApplication ? 'kebijakan.show' : 'tanah-timbul.show';
            return redirect()->route($routeName, $id)->with('success', 'Pembayaran PNBP dikonfirmasi. Akun telah diaktifkan dan dikirim ke pemohon.');
        }

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
            $this->sendNotificationWithMailbox($application, $isReschedule ? 'cek_lokasi_ubah' : 'cek_lokasi', 'Layanan BPN', 'dashboard', $request->input('custom_wa_message'));
 
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
            $this->sendNotificationWithMailbox($application, $isReschedule ? 'rapat_ubah' : 'rapat', 'Layanan BPN', 'dashboard', $request->input('custom_wa_message'));
 
            return redirect()->route('kebijakan.show', $id)->with('success', 'Jadwal Rapat Koordinasi berhasil disimpan & di-blast ke WhatsApp pemohon.');
        }
 
        // BPN Langkah 4: Penerbitan Pertek Akhir
        if ($user->isBpn() && $application->status === 'menunggu_bpn' && $step === 'bpn_pertek') {
            $request->validate([
                'action' => 'required|in:approve,reject',
                'notes' => 'required|string|max:1000',
                'bpn_pertek_document' => 'nullable|file|mimes:pdf,doc,docx|max:102400',
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
                                $application->status = 'menunggu_satu_pintu';
                $msg = 'Dokumen Pertek Pertanahan berhasil diterbitkan. Berkas diteruskan ke Dinas PMPTSP (Satu Pintu).';
            } else {
                $application->status = 'ditolak';
                $msg = 'Permohonan ditolak pada tahap rekomendasi teknis BPN.';
            }
            $application->save();
 
            // Kirim Notifikasi WhatsApp khusus Pertek
            $this->sendNotificationWithMailbox($application, $action === 'approve' ? 'pertek_terbit' : 'pertek_tolak', 'Pertimbangan Teknis Pertanahan Kebijakan', 'kebijakan.show', $request->input('custom_wa_message'));
 
            return redirect()->route('kebijakan.show', $id)->with('success', $msg);
        }
 
        // SATU PINTU Langkah 6: Upload Sertifikat Akhir (Dinas PMPTSP)
        if ($user->isSatuPintu() && $application->status === 'menunggu_satu_pintu' && $step === 'satu_pintu_terbit') {
            $request->validate([
                'approval_document' => 'required|file|mimes:pdf,doc,docx|max:102400',
                'satu_pintu_no_pkkpr' => 'required|string|max:100',
                'satu_pintu_tanggal_terbit' => 'required|date',
                'notes' => 'nullable|string|max:1000'
            ], [
                'approval_document.required' => 'Dokumen PKKPR Final wajib diunggah.',
                'satu_pintu_no_pkkpr.required' => 'Nomor Surat PKKPR wajib diisi.',
                'satu_pintu_tanggal_terbit.required' => 'Tanggal Terbit wajib diisi.'
            ]);

            $path = $request->file('approval_document')->store('pkkpr_finals', 'public');
            
            $application->approval_document = $path;
            $application->satu_pintu_no_pkkpr = $request->input('satu_pintu_no_pkkpr');
            $application->satu_pintu_tanggal_terbit = $request->input('satu_pintu_tanggal_terbit');
            $application->satu_pintu_notes  = $request->input('notes', '');
            $application->status = 'disetujui';
            $application->save();

            // WA Notifikasi Selesai (Diterbitkan)
            $this->sendNotificationWithMailbox($application, 'pkkpr_terbit', 'Pertimbangan Teknis Pertanahan Kebijakan', 'kebijakan.show', $request->input('custom_wa_message'));

            $routeName = $application instanceof \App\Models\KebijakanApplication ? 'kebijakan.show' : 'tanah-timbul.show';
            return redirect()->route($routeName, $id)->with('success', 'PKKPR Final berhasil diterbitkan dan notifikasi telah dikirim ke pemohon.');
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
                    $application->$fileKey = $request->file($fileKey)->store('kebijakan_docs', 'public');
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
            $this->sendNotificationWithMailbox($application, 'berkas_revisi_bpn', 'Pertimbangan Teknis Pertanahan Kebijakan', 'kebijakan.show', $request->input('custom_wa_message'));
 
            return redirect()->route('kebijakan.show', $id)->with('success', 'Berkas perbaikan berhasil diunggah. Mohon tunggu verifikasi ulang dari BPN.');
        }
        // Resend Notifikasi WA (Admin Action)
        if ($step === 'resend_wa' && !$user->isPelakuUsaha()) {
            $type = $request->input('wa_type', 'berkas_verifikasi');
            $customMsg = $request->input('custom_wa_message');
            $this->sendNotificationWithMailbox($application, $type, 'Pertimbangan Teknis Pertanahan Kebijakan', 'kebijakan.show', $customMsg);
            return redirect()->back()->with('success', 'Tautan kirim ulang WhatsApp manual berhasil dimunculkan.');
        }

        abort(403, 'Aksi tidak diizinkan atau status permohonan tidak sesuai.');
    }
 
    // removed getWhatsappSettings
 

    
}

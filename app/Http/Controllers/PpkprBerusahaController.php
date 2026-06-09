<?php
 
namespace App\Http\Controllers;
 
use App\Models\PpkprBerusahaApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
 
class PpkprBerusahaController extends Controller
{
    use \App\Traits\WaBlastHelper;

    /**
     * Tampilkan daftar permohonan PPKPR Berusaha.
     */
    public function index()
    {
        $user = Auth::user();
 
        // Pelaku Usaha melihat miliknya sendiri
        if ($user->isPelakuUsaha()) {
            $applications = PpkprBerusahaApplication::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
            return view('berusaha.index', compact('applications'));
        }
 
        // Instansi lain melihat semua permohonan
        $applications = PpkprBerusahaApplication::orderBy('created_at', 'desc')->get();
        return view('berusaha.index', compact('applications'));
    }
 
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('ptp.create')->with('info', 'Silakan isi formulir Permohonan PTP terlebih dahulu.');
        }

        if (!Auth::user()->isPelakuUsaha()) {
            abort(403, 'Hanya Pelaku Usaha yang dapat membuat pengajuan permohonan.');
        }

        return view('berusaha.create');
    }
 
    /**
     * Simpan pengajuan permohonan baru.
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
            'hubungan_pengaju.required' => 'Hubungan pengaju wajib diisi.',
        ]);
 
        $data = $request->only([
            'nama_pemilik_usaha', 'nama_pengaju', 'hubungan_pengaju', 'kbli_kode'
        ]);
 
        $data['user_id'] = Auth::id();
        $data['status'] = 'menunggu_bpn';
        $data['bpn_berkas_status'] = 'menunggu';
        $data['bpn_pembayaran_status'] = 'belum_bayar';
        if (session()->has('ptp_form_data')) {
            $data['ptp_data'] = json_encode(session('ptp_form_data'));
        }
 
        // Generate nomor registrasi BERUSAHA
        $data['application_number'] = 'BERUSAHA-' . date('Ymd') . '-' . strtoupper(Str::random(5));
        
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
                $data[$fileKey] = $file->storeAs('berusaha_docs', $fileName, 'public');
            }
        }
 
        $app = PpkprBerusahaApplication::create($data);
        session()->forget('ptp_form_data');
 
        // Kirim Notifikasi Awal ke Pelaku Usaha
        $this->sendCustomWhatsappNotification($app, 'submit_berkas');
 
        Auth::logout();
        return redirect()->route('pengajuan.sukses');
    }
 
    /**
     * Tampilkan detail permohonan.
     */
    public function show($id)
    {
        $application = PpkprBerusahaApplication::where('id', $id)->orWhere('application_number', $id)->firstOrFail();
        $user = Auth::user();
 
        // Keamanan: Pelaku usaha hanya melihat berkas miliknya sendiri
        if ($user->isPelakuUsaha() && $application->user_id !== $user->id) {
            abort(403, 'Aksi tidak diizinkan.');
        }
 
        return view('berusaha.show', compact('application'));
    }
 
    /**
     * Download Formulir PTP dalam bentuk PDF.
     */
    public function ptpPdf($id)
    {
        $application = PpkprBerusahaApplication::where('id', $id)->orWhere('application_number', $id)->firstOrFail();
        
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
     * Aksi Verifikasi oleh Pihak Terkait (BPN, Dinas PU, Satu Pintu).
     */
    public function verify(Request $request, $id)
    {
        $application = PpkprBerusahaApplication::where('id', $id)->orWhere('application_number', $id)->firstOrFail();
        $user = Auth::user();
        $step = $request->input('step');
 
        // ==========================================
        // 1. TAHAP BPN (Verifikasi Dokumen, Pembayaran, Lokasi, Rapat, Pertek)
        // ==========================================
        if ($user->isBpn() && $application->status === 'menunggu_bpn') {
 
            // BPN Langkah 1: Verifikasi Dokumen Persyaratan
            if ($step === 'bpn_berkas') {
                $request->validate([
                    'action' => 'required|in:approve,reject',
                    'notes' => 'required|string|max:1000',
                ]);
 
                $action = $request->input('action');
                $notes = $request->input('notes');
 
                $application->bpn_notes = $notes;
                
                if ($action === 'approve') {
                    $application->bpn_berkas_status = 'diterima';
                    $application->bpn_berkas_approved_at = now();
                    // Alur berlanjut ke Validasi Permohonan oleh Dinas PUTR / Dinas PU
                    $application->status = 'menunggu_dinas_pu';
                    $application->dinas_pu_status = 'menunggu_validasi_awal';
                    $msg = 'Berkas persyaratan dinyatakan sesuai oleh BPN. Permohonan diteruskan ke Dinas PUTR untuk Validasi Awal.';
                } else {
                    $application->bpn_berkas_status = 'tidak_sesuai';
                    $msg = 'Berkas dinyatakan tidak sesuai. Pelaku usaha telah dinotifikasi.';
                }
                $application->save();
 
                // Kirim notifikasi WA ke Pelaku Usaha
                $this->sendCustomWhatsappNotification($application, 'berkas_verifikasi');
 
                return redirect()->route('berusaha.show', $id)->with('success', $msg);
            }
 
            // BPN Langkah 2: Validasi Pembayaran & Input No. Berkas & Blast Kredensial Login WA
            if ($step === 'bpn_pembayaran') {
                $request->validate([
                    'no_berkas' => 'required|string|max:100',
                ], [
                    'no_berkas.required' => 'Nomor Berkas wajib diisi sebelum mengkonfirmasi pembayaran.',
                ]);

                // Simpan no berkas dan konfirmasi pembayaran
                $application->no_berkas = $request->input('no_berkas');
                $application->bpn_pembayaran_status = 'sudah_bayar';
                    $application->bpn_pembayaran_approved_at = now();
                $application->save();
                $application->user->update(['is_active' => true]);

                // Kirim Notifikasi Blast WA Kredensial & Tautan Dashboard ke Pelaku Usaha
                $this->sendCustomWhatsappNotification($application, 'pembayaran_lunas');

                return redirect()->route('berusaha.show', $id)->with('success', "Pembayaran Retribusi terverifikasi LUNAS! No. Berkas: {$application->no_berkas}. Kredensial login dashboard telah di-blast ke WhatsApp pemohon.");
            }
 
            // BPN Langkah 3: Penjadwalan Cek Lokasi Lapangan
            if ($step === 'bpn_cek_lokasi') {
                $request->validate([
                    'bpn_cek_lokasi_dt' => 'required|date',
                    'bpn_cek_lokasi_cp' => 'required|string|max:100',
                ]);
 
                $dtInput = Carbon::parse($request->input('bpn_cek_lokasi_dt'));
                $dateLabel = $dtInput->locale('id')->translatedFormat('l, d F Y \J\a\m H:i \W\I\B');
                
                $application->bpn_cek_lokasi_dt = $dtInput;
                $application->bpn_cek_lokasi_date = $dateLabel;
                $application->bpn_cek_lokasi_cp = $request->input('bpn_cek_lokasi_cp');
                $application->save();
 
                // Kirim notifikasi ke Pelaku Usaha
                $this->sendCustomWhatsappNotification($application, 'cek_lokasi');
 
                return redirect()->route('berusaha.show', $id)->with('success', 'Jadwal peninjauan cek lokasi berhasil disimpan dan dikirim ke pemohon.');
            }
 
            // BPN Langkah 4: Penjadwalan Sidang / Rapat Koordinasi
            if ($step === 'bpn_rapat') {
                $request->validate([
                    'bpn_rapat_dt' => 'required|date',
                ]);
 
                $dtInput = Carbon::parse($request->input('bpn_rapat_dt'));
                $dateLabel = $dtInput->locale('id')->translatedFormat('l, d F Y \J\a\m H:i \W\I\B');
 
                $application->bpn_rapat_dt = $dtInput;
                $application->bpn_rapat_date = $dateLabel;
                $application->save();
 
                // Kirim notifikasi rapat ke Pelaku Usaha
                $this->sendCustomWhatsappNotification($application, 'rapat');
 
                return redirect()->route('berusaha.show', $id)->with('success', 'Jadwal rapat koordinasi berhasil disimpan.');
            }
 
            // BPN Langkah 5: Penerbitan Pertek Pertanahan
            if ($step === 'bpn_pertek') {
                $request->validate([
                    'action' => 'required|in:approve,reject',
                    'notes' => 'required|string|max:1000',
                    'bpn_pertek_document' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
                ]);
 
                $action = $request->input('action');
                $notes = $request->input('notes');
 
                $application->bpn_notes = $notes;
 
                if ($action === 'approve') {
                    if (!$request->hasFile('bpn_pertek_document')) {
                        return redirect()->back()->withErrors(['bpn_pertek_document' => 'Dokumen Pertek Pertanahan wajib diunggah saat menyetujui.']);
                    }
 
                    $path = $request->file('bpn_pertek_document')->store('bpn_perteks_berusaha', 'public');
                    $application->bpn_pertek_document = $path;
                    $application->bpn_pertek_uploaded_at = now();
                    
                    // Alur berlanjut ke Dinas PU (Tahap 8: Penilaian PKKPR)
                    $application->status = 'menunggu_dinas_pu';
                    $application->dinas_pu_status = 'menunggu_penilaian';
                    $msg = 'Rekomendasi Teknis (Pertek) berhasil diterbitkan. Permohonan diteruskan ke Dinas Pekerjaan Umum (PU) untuk Penilaian PKKPR.';
                } else {
                    $application->status = 'ditolak';
                    $msg = 'Permohonan ditolak oleh BPN pada tahap rekomendasi teknis.';
                }
                $application->save();
 
                // Kirim Notifikasi WA ke Pelaku Usaha dan Dinas PU
                $this->sendCustomWhatsappNotification($application, $action === 'approve' ? 'pertek_terbit' : 'pertek_tolak');
 
                return redirect()->route('berusaha.show', $id)->with('success', $msg);
            }
        }
 
        // ==========================================
        // 2. TAHAP DINAS PU / PUTR (Validasi Awal ATAU Penilaian Tata Ruang)
        // ==========================================
        if ($user->isDinasPu() && $application->status === 'menunggu_dinas_pu') {
            
            // KASUS A: Validasi Permohonan Awal (Stage 3)
            if ($application->dinas_pu_status === 'menunggu_validasi_awal') {
                $request->validate([
                    'action' => 'required|in:approve,reject',
                    'notes' => 'required|string|max:1000',
                ]);

                $action = $request->input('action');
                $notes = $request->input('notes');

                $application->dinas_pu_notes = $notes;

                if ($action === 'approve') {
                    // Validasi sukses, status kembali ke BPN menunggu pembayaran retribusi
                    $application->status = 'menunggu_bpn';
                    $application->dinas_pu_status = 'validasi_awal_diterima';
                    $application->bpn_pembayaran_status = 'belum_bayar';
                    $msg = 'Permohonan berhasil divalidasi oleh Dinas PUTR. Notifikasi tagihan pembayaran dikirim ke pemohon.';
                } else {
                    // Validasi ditolak, permohonan selesai/ditolak
                    $application->status = 'ditolak';
                    $application->dinas_pu_status = 'validasi_awal_ditolak';
                    $msg = 'Permohonan ditolak pada tahap validasi awal oleh Dinas PUTR.';
                }
                $application->save();

                // Kirim notifikasi WA blast
                $this->sendCustomWhatsappNotification($application, $action === 'approve' ? 'validasi_awal_setuju' : 'validasi_awal_tolak');

                return redirect()->route('berusaha.show', $id)->with('success', $msg);
            }

            // KASUS B: Penilaian PKKPR Akhir (Stage 8)
            if ($application->dinas_pu_status === 'menunggu_penilaian') {
                $request->validate([
                    'action' => 'required|in:sesuai,belum_sesuai',
                    'notes' => 'nullable|string|max:1000',
                    'dinas_pu_tanggal_penilaian' => 'required|date',
                    'dinas_pu_document' => 'nullable|file|mimes:pdf|max:10240',
                ]);
 
                $action = $request->input('action');
                $notes = $request->input('notes');
 
                $application->dinas_pu_status = $action === 'sesuai' ? 'penilaian_sesuai' : 'penilaian_belum_sesuai';
                $application->dinas_pu_notes = $notes;
                $application->dinas_pu_tanggal_penilaian = Carbon::parse($request->input('dinas_pu_tanggal_penilaian'));

                if ($request->hasFile('dinas_pu_document')) {
                    $path = $request->file('dinas_pu_document')->store('dinas_pu_penilaians', 'public');
                    $application->dinas_pu_document = $path;
                }
 
                if ($action === 'sesuai') {
                    // Alur berlanjut ke Satu Pintu (PTSP)
                    $application->status = 'menunggu_satu_pintu';
                    $msg = 'Penilaian disetujui (Sesuai Tata Ruang). Permohonan dilanjutkan ke Dinas Satu Pintu (PTSP).';
                } else {
                    // Status Belum Sesuai (kembali ke BPN / menunggu perbaikan)
                    $application->status = 'menunggu_bpn';
                    $msg = 'Penilaian diatur Belum Sesuai Tata Ruang. Catatan penilaian telah dikirim.';
                }
                $application->save();
 
                // Kirim Notifikasi WA ke PTSP (jika sesuai) atau Pelaku Usaha (jika belum sesuai)
                $this->sendCustomWhatsappNotification($application, $action === 'sesuai' ? 'pu_sesuai' : 'pu_belum_sesuai');
 
                return redirect()->route('berusaha.show', $id)->with('success', $msg);
            }
        }
 
        // ==========================================
        // 3. TAHAP SATU PINTU / PTSP (Penerbitan Produk Akhir - Stage 9)
        // ==========================================
        if ($user->isSatuPintu() && $application->status === 'menunggu_satu_pintu') {
            $request->validate([
                'satu_pintu_no_pkkpr' => 'required|string|max:100',
                'satu_pintu_tanggal_terbit' => 'required|date',
                'satu_pintu_document' => 'nullable|file|mimes:pdf|max:10240',
                'notes' => 'nullable|string|max:1000',
            ]);
 
            if ($request->hasFile('satu_pintu_document')) {
                $path = $request->file('satu_pintu_document')->store('pkkpr_berusaha_finals', 'public');
                $application->satu_pintu_document = $path;
            }
 
            $application->satu_pintu_no_pkkpr = $request->input('satu_pintu_no_pkkpr');
            $application->satu_pintu_tanggal_terbit = Carbon::parse($request->input('satu_pintu_tanggal_terbit'));
            $application->satu_pintu_notes = $request->input('notes');
            
            // Permohonan Selesai & Disetujui
            $application->status = 'disetujui';
            $application->save();
 
            // Kirim Notifikasi WA Final ke BPN dan Pelaku Usaha (Dinas PU tidak dikirimi)
            $this->sendCustomWhatsappNotification($application, 'final_disetujui');
 
            return redirect()->route('berusaha.show', $id)->with('success', 'Produk akhir PKKPR Berusaha berhasil diterbitkan! Seluruh alur permohonan telah selesai.');
        }
 
        // Pelaku Usaha mengupload ulang berkas jika tidak sesuai
        if ($user->isPelakuUsaha() && $application->status === 'menunggu_bpn' && $application->bpn_berkas_status === 'tidak_sesuai' && $step === 'reupload') {
            $request->validate([
                'peta_lokasi' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'surat_kuasa' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'fc_ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'fc_npwp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'fc_akta_pendirian' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
                'rencana_penggunaan_tanah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
                'nib' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'kbli_kode' => 'nullable|string|max:20',
                'kbli' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'proposal_kegiatan' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
                'persyaratan_lainnya' => 'nullable|file|mimes:pdf,jpg,jpeg,png,zip,rar|max:10240',
            ]);
 
            $filesToStore = [
                'peta_lokasi', 'surat_kuasa', 'fc_ktp', 'fc_npwp',
                'fc_akta_pendirian', 'rencana_penggunaan_tanah',
                'nib', 'kbli', 'proposal_kegiatan', 'persyaratan_lainnya'
            ];
 
            foreach ($filesToStore as $fileKey) {
                if ($request->hasFile($fileKey)) {
                    $application->$fileKey = $request->file($fileKey)->store('berusaha_docs', 'public');
                }
            }

            if ($request->filled('kbli_kode')) {
                $application->kbli_kode = $request->input('kbli_kode');
            }
            
            // Reset status berkas agar dicek ulang oleh BPN
            $application->bpn_berkas_status = 'menunggu';
            $application->save();
 
            // Notifikasi BPN ada berkas perbaikan masuk
            $this->sendCustomWhatsappNotification($application, 'reupload_berkas');
 
            return redirect()->route('berusaha.show', $id)->with('success', 'Berkas perbaikan berhasil diunggah. Mohon tunggu verifikasi ulang dari BPN.');
        }
 
        // Pelaku Usaha menekan tombol "kirim notifikasi" blast ke Pelaku Usaha & BPN (Image 2)
        if ($user->isPelakuUsaha() && $application->status === 'menunggu_bpn' && $application->bpn_berkas_status === 'diterima' && $step === 'blast_notif') {
            
            $this->sendCustomWhatsappNotification($application, 'pu_blast_notif');
            
            return redirect()->route('berusaha.show', $id)->with('success', 'Notifikasi WhatsApp blast berhasil dikirim ke Pelaku Usaha dan BPN!');
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
                'template' => "Halo {nama_pemohon}, permohonan Anda ({nomor_registrasi}) saat ini memasuki tahap: {status_sekarang}.\n\nCatatan: {catatan_terakhir}\n\nPantau di: {tautan_detail}",
            ];
            file_put_contents($path, json_encode($settings, JSON_PRETTY_PRINT));
        }
        return $settings;
    }
 
    /**
     * Kirim Notifikasi WhatsApp Kustom Berdasarkan Tahapan Berusaha.
     */
    private function sendCustomWhatsappNotification($application, $type)
    {
        $settings = $this->getWhatsappSettings();
        if (!($settings['connected'] ?? false)) return;

        $app = func_get_arg(0);
        $type = func_get_arg(1);
        
        $url = url('/dashboard'); // simplified
        if(method_exists($app, 'id')) {
            // Assume route names: berusaha.show, non_berusaha.show, psn.show, kebijakan.show, tanah_timbul.show
            $routeName = strtolower(str_replace('Controller', '', class_basename($this)));
            if ($routeName === 'ppkprberusaha') $routeName = 'berusaha';
            if ($routeName === 'ppkprnonberusaha') $routeName = 'non_berusaha';
            if ($routeName === 'tanahtimbul') $routeName = 'tanah_timbul';
            $url = route($routeName . '.show', $app->id);
        }

        $msg = $this->generateWaMessage($type, $app, 'PPKPR Berusaha', $url);
        
        $pemohon = $app->user->phone_number ?? '';

        if ($msg && $pemohon) {
            if (!empty($settings['cp_admin'])) {
                $msg .= "

_Jika ada pertanyaan, hubungi CP Admin: " . $settings['cp_admin'] . "_";
            }
            $this->executeFonnteSend($pemohon, $msg);
        }

        // Notifikasi Internal Antar Instansi
        $no_berkas_text = !empty($app->no_berkas) ? " (No. Berkas: {$app->no_berkas})" : "";
        $nama = $app->nama_pengaju ?: ($app->user->name ?? ($app->user->username ?? ''));
        
        $adminBpn = $settings['admin_bpn'] ?? '';
        $adminPutr = $settings['admin_putr'] ?? '';
        $adminPu = $settings['admin_dinas_pu'] ?? '';
        $adminPtsp = $settings['admin_satu_pintu'] ?? '';

        // 1. Pendaftaran Baru
        if (($type === 'submit' || $type === 'submit_berkas') && $adminBpn) {
            $this->executeFonnteSend($adminBpn, "Halo Admin Kantor Pertanahan Kota Sukabumi, ada pengajuan permohonan baru untuk PPKPR Berusaha atas nama {$nama}. Silakan login untuk melakukan verifikasi berkas awal di: {$url}");
        }
        // 2. Bukti Bayar PNBP
        if ($type === 'credential' && $adminBpn) {
            $this->executeFonnteSend($adminBpn, "Halo Admin Kantor Pertanahan Kota Sukabumi, pemohon atas nama {$nama} telah selesai melakukan pembayaran PNBP untuk layanan PPKPR Berusaha. Silakan login untuk verifikasi bayar dan aktifkan akun pemohon di: {$url}");
        }
        // 3. PUTR -> Saat BPN terbit Pertek
        if ($type === 'pertek_terbit' && $adminPutr) {
            $this->executeFonnteSend($adminPutr, "Notifikasi Dinas PUTR: Pertimbangan Teknis Pertanahan (PTP) untuk PPKPR Berusaha{$no_berkas_text} telah terbit dari Kantor Pertanahan Kota Sukabumi. Silakan lakukan penilaian PKKPR di: {$url}");
        }
        // 4. PTSP -> Saat PUTR Selesai
        if ($type === 'pu_selesai' && $adminPtsp) {
            $this->executeFonnteSend($adminPtsp, "Notifikasi Satu Pintu: Penilaian Dinas PUTR untuk PPKPR Berusaha{$no_berkas_text} selesai. Silakan proses penerbitan PKKPR di: {$url}");
        }
        // 5. Kembali ke BPN -> Tunggu PTSP
        if ($type === 'pu_selesai' && $adminBpn) {
            $this->executeFonnteSend($adminBpn, "Notifikasi Kantor Pertanahan Kota Sukabumi: Dinas PUTR telah selesai menilai PPKPR Berusaha{$no_berkas_text}. Menunggu penerbitan PKKPR oleh DPMPTSP / Satu Pintu.");
        }
    }

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


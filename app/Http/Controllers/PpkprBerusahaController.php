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
 
    /**
     * Tampilkan form pengajuan baru.
     */
    public function create()
    {
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
        if (!Auth::user()->isPelakuUsaha()) {
            abort(403, 'Aksi tidak diizinkan.');
        }
 
        $request->validate([
            'nama_pemilik_usaha' => 'required|string|max:100',
            'nama_pengaju' => 'required|string|max:100',
            'hubungan_pengaju' => 'required|string|max:100',
            'doc_persyaratan' => 'required|file|mimes:pdf,jpg,jpeg,png,zip,rar,doc,docx|max:10240',
        ], [
            'nama_pemilik_usaha.required' => 'Nama pemilik usaha wajib diisi.',
            'nama_pengaju.required' => 'Nama pengaju wajib diisi.',
            'hubungan_pengaju.required' => 'Hubungan pengaju wajib diisi.',
            'doc_persyaratan.required' => 'Dokumen persyaratan wajib diunggah.',
            'doc_persyaratan.max' => 'Ukuran berkas persyaratan maksimal 10MB.',
        ]);
 
        $data = $request->only([
            'nama_pemilik_usaha', 'nama_pengaju', 'hubungan_pengaju'
        ]);
 
        $data['user_id'] = Auth::id();
        $data['status'] = 'menunggu_bpn';
        $data['bpn_berkas_status'] = 'menunggu';
        $data['bpn_pembayaran_status'] = 'belum_bayar';
 
        // Generate nomor registrasi BERUSAHA
        $data['application_number'] = 'BERUSAHA-' . date('Ymd') . '-' . strtoupper(Str::random(5));
        $data['doc_persyaratan'] = $request->file('doc_persyaratan')->store('berusaha_docs', 'public');
 
        $app = PpkprBerusahaApplication::create($data);
 
        // Kirim Notifikasi Awal ke Pelaku Usaha
        $this->sendCustomWhatsappNotification($app, 'submit_berkas');
 
        return redirect()->route('berusaha.index')->with('success', 'Permohonan PPKPR Berusaha berhasil diajukan! Berkas Anda sedang diverifikasi oleh BPN.');
    }
 
    /**
     * Tampilkan detail permohonan.
     */
    public function show($id)
    {
        $application = PpkprBerusahaApplication::findOrFail($id);
        $user = Auth::user();
 
        // Keamanan: Pelaku usaha hanya melihat berkas miliknya sendiri
        if ($user->isPelakuUsaha() && $application->user_id !== $user->id) {
            abort(403, 'Aksi tidak diizinkan.');
        }
 
        return view('berusaha.show', compact('application'));
    }
 
    /**
     * Aksi Verifikasi oleh Pihak Terkait (BPN, Dinas PU, Satu Pintu).
     */
    public function verify(Request $request, $id)
    {
        $application = PpkprBerusahaApplication::findOrFail($id);
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
                $application->bpn_berkas_status = $action === 'approve' ? 'diterima' : 'tidak_sesuai';
                
                if ($action === 'reject') {
                    // Ditolak/tidak sesuai, pelaku usaha harus upload ulang
                    $msg = 'Berkas dinyatakan tidak sesuai. Pelaku usaha telah dinotifikasi.';
                } else {
                    $msg = 'Berkas persyaratan berhasil disetujui.';
                }
                $application->save();
 
                // Kirim notifikasi WA ke Pelaku Usaha
                $this->sendCustomWhatsappNotification($application, 'berkas_verifikasi');
 
                return redirect()->route('berusaha.show', $id)->with('success', $msg);
            }
 
            // BPN Langkah 2: Validasi Pembayaran
            if ($step === 'bpn_pembayaran') {
                $request->validate([
                    'action' => 'required|in:sudah_bayar,belum_bayar',
                    'notes' => 'nullable|string|max:1000',
                ]);
 
                $action = $request->input('action');
                $notes = $request->input('notes');
 
                $application->bpn_pembayaran_status = $action;
                if ($notes) {
                    $application->bpn_notes = $notes;
                }
                $application->save();
 
                if ($action === 'belum_bayar') {
                    $this->sendCustomWhatsappNotification($application, 'pembayaran_belum');
                    $msg = 'Status pembayaran diatur Belum Bayar. Notifikasi tagihan telah dikirim ke pemohon.';
                } else {
                    $this->sendCustomWhatsappNotification($application, 'pembayaran_lunas');
                    $msg = 'Pembayaran terverifikasi LUNAS. Silakan tentukan jadwal cek lokasi.';
                }
 
                return redirect()->route('berusaha.show', $id)->with('success', $msg);
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
                    
                    // Alur berlanjut ke Dinas PU
                    $application->status = 'menunggu_dinas_pu';
                    $application->dinas_pu_status = 'menunggu';
                    $msg = 'Rekomendasi Teknis (Pertek) berhasil diterbitkan. Permohonan diteruskan ke Dinas Pekerjaan Umum (PU).';
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
        // 2. TAHAP DINAS PU (Penilaian Tata Ruang)
        // ==========================================
        if ($user->isDinasPu() && $application->status === 'menunggu_dinas_pu') {
            $request->validate([
                'action' => 'required|in:sesuai,belum_sesuai',
                'notes' => 'required|string|max:1000',
            ]);
 
            $action = $request->input('action');
            $notes = $request->input('notes');
 
            $application->dinas_pu_status = $action;
            $application->dinas_pu_notes = $notes;
 
            if ($action === 'sesuai') {
                // Alur berlanjut ke Satu Pintu (PTSP)
                $application->status = 'menunggu_satu_pintu';
                $msg = 'Penilaian disetujui (Sesuai Tata Ruang). Permohonan dilanjutkan ke Dinas Satu Pintu (PTSP).';
            } else {
                // Status Belum Sesuai (kembali ke BPN / menunggu perbaikan)
                $msg = 'Penilaian diatur Belum Sesuai Tata Ruang. Catatan penilaian telah dikirim.';
            }
            $application->save();
 
            // Kirim Notifikasi WA ke PTSP (jika sesuai) atau Pelaku Usaha (jika belum sesuai)
            $this->sendCustomWhatsappNotification($application, $action === 'sesuai' ? 'pu_sesuai' : 'pu_belum_sesuai');
 
            return redirect()->route('berusaha.show', $id)->with('success', $msg);
        }
 
        // ==========================================
        // 3. TAHAP SATU PINTU / PTSP (Penerbitan Produk Akhir)
        // ==========================================
        if ($user->isSatuPintu() && $application->status === 'menunggu_satu_pintu') {
            $request->validate([
                'satu_pintu_no_pkkpr' => 'required|string|max:100',
                'satu_pintu_tanggal_terbit' => 'required|date',
                'satu_pintu_document' => 'required|file|mimes:pdf|max:10240',
                'notes' => 'nullable|string|max:1000',
            ]);
 
            $path = $request->file('satu_pintu_document')->store('pkkpr_berusaha_finals', 'public');
 
            $application->satu_pintu_no_pkkpr = $request->input('satu_pintu_no_pkkpr');
            $application->satu_pintu_tanggal_terbit = Carbon::parse($request->input('satu_pintu_tanggal_terbit'));
            $application->satu_pintu_document = $path;
            $application->satu_pintu_notes = $request->input('notes');
            
            // Permohonan Selesai & Disetujui
            $application->status = 'disetujui';
            $application->save();
 
            // Kirim Notifikasi WA Final ke BPN, Pelaku Usaha, dan Dinas PU
            $this->sendCustomWhatsappNotification($application, 'final_disetujui');
 
            return redirect()->route('berusaha.show', $id)->with('success', 'Produk akhir PKKPR Berusaha berhasil diterbitkan! Seluruh alur permohonan telah selesai.');
        }
 
        // Pelaku Usaha mengupload ulang berkas jika tidak sesuai
        if ($user->isPelakuUsaha() && $application->status === 'menunggu_bpn' && $application->bpn_berkas_status === 'tidak_sesuai' && $step === 'reupload') {
            $request->validate([
                'doc_persyaratan' => 'required|file|mimes:pdf,jpg,jpeg,png,zip,rar,doc,docx|max:10240',
            ]);
 
            $path = $request->file('doc_persyaratan')->store('berusaha_docs', 'public');
            $application->doc_persyaratan = $path;
            
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
        if (!$settings['connected']) {
            return;
        }
 
        $url = route('berusaha.show', $application->id);
        $namaPemohon = $application->nama_pengaju ?: ($application->user->name ?? $application->user->username);
        $noReg = $application->application_number;
 
        // Ambil Kontak Masing-masing Instansi untuk Blast
        $bpnUser = User::where('role', 'bpn')->first();
        $dinasPuUser = User::where('role', 'dinas_pu')->first();
        $satuPintuUser = User::where('role', 'satu_pintu')->first();
 
        $bpnPhone = $bpnUser ? $bpnUser->phone_number : '081234567891';
        $puDinasPhone = $dinasPuUser ? $dinasPuUser->phone_number : '081234567892';
        $satuPintuPhone = $satuPintuUser ? $satuPintuUser->phone_number : '081234567893';
        $pemohonPhone = $application->user->phone_number;
 
        switch ($type) {
            case 'submit_berkas':
                // Notifikasi Awal ke Pelaku Usaha
                $message = "Halo {$namaPemohon}, permohonan PPKPR Berusaha Anda dengan nomor {$noReg} telah sukses diajukan.\n\nBerkas persyaratan Anda sedang dalam tahap verifikasi awal oleh BPN. Silakan pantau detail di: {$url}";
                $this->executeFonnteSend($pemohonPhone, $message);
                break;
 
            case 'berkas_verifikasi':
                if ($application->bpn_berkas_status === 'diterima') {
                    // Berkas Valid -> Blast WA ke Pelaku Usaha (Image 2)
                    $message = "Halo {$namaPemohon}, berkas permohonan PPKPR Berusaha Anda ({$noReg}) dinyatakan VALID oleh BPN.\n\nSilakan masuk ke dashboard dan tekan tombol \"Kirim Notifikasi\" untuk melanjutkan proses ke verifikasi pembayaran. Lacak detail di: {$url}";
                    $this->executeFonnteSend($pemohonPhone, $message);
                } else {
                    // Berkas Tidak Sesuai -> Pesan Kesalahan ke Pelaku Usaha
                    $message = "Halo {$namaPemohon}, berkas permohonan PPKPR Berusaha Anda ({$noReg}) dinyatakan TIDAK SESUAI oleh BPN dengan alasan:\n"
                             . "\"{$application->bpn_notes}\"\n\nMohon lakukan unggah ulang berkas perbaikan melalui tautan detail berikut: {$url}";
                    $this->executeFonnteSend($pemohonPhone, $message);
                }
                break;
 
            case 'reupload_berkas':
                // Notifikasi ke BPN bahwa pemohon telah upload perbaikan
                $message = "Notifikasi BPN: Pelaku Usaha {$namaPemohon} telah mengunggah ulang berkas perbaikan untuk permohonan PPKPR Berusaha {$noReg}.\n\nSilakan cek & verifikasi ulang dokumen di: {$url}";
                $this->executeFonnteSend($bpnPhone, $message);
                break;
 
            case 'pu_blast_notif':
                // Pelaku Usaha menekan tombol "Kirim Notifikasi" -> Blast ke Pelaku Usaha & BPN
                $msgPU = "Halo {$namaPemohon}, notifikasi pengajuan verifikasi pembayaran untuk permohonan {$noReg} telah berhasil dikirimkan ke petugas BPN.";
                $msgBPN = "Notifikasi BPN: Pemohon {$namaPemohon} mengajukan verifikasi pembayaran untuk PPKPR Berusaha {$noReg}.\n\nSilakan periksa pembayaran pemohon di: {$url}";
                
                $this->executeFonnteSend($pemohonPhone, $msgPU);
                $this->executeFonnteSend($bpnPhone, $msgBPN);
                break;
 
            case 'pembayaran_belum':
                // Belum Bayar -> Notifikasi ke Pelaku Usaha untuk segera membayar
                $message = "Halo {$namaPemohon}, pembayaran untuk permohonan PPKPR Berusaha {$noReg} belum terdeteksi/valid.\n\nMohon segera melakukan pembayaran retribusi pertanahan sesuai instruksi. Lacak detail pembayaran di: {$url}";
                $this->executeFonnteSend($pemohonPhone, $message);
                break;
 
            case 'pembayaran_lunas':
                // Pembayaran Lunas -> Notifikasi ke Pelaku Usaha
                $message = "Halo {$namaPemohon}, pembayaran untuk permohonan PPKPR Berusaha {$noReg} telah diverifikasi LUNAS oleh BPN. Petugas akan segera menyusun jadwal cek lokasi lapangan. Detail: {$url}";
                $this->executeFonnteSend($pemohonPhone, $message);
                break;
 
            case 'cek_lokasi':
                // Jadwal Cek Lokasi -> Blast ke Pelaku Usaha berisi Jadwal & CP Admin
                $message = "Halo {$namaPemohon}, permohonan PPKPR Berusaha Anda ({$noReg}) dijadwalkan untuk peninjauan lokasi offline.\n\n"
                         . "Waktu: {$application->bpn_cek_lokasi_date}\n"
                         . "CP Lapangan/Admin: {$application->bpn_cek_lokasi_cp}\n\n"
                         . "Harap berada di lokasi pada waktu tersebut. Detail: {$url}";
                $this->executeFonnteSend($pemohonPhone, $message);
                break;
 
            case 'rapat':
                // Jadwal Rapat -> Notifikasi ke Pelaku Usaha
                $message = "Halo {$namaPemohon}, sidang / rapat koordinasi pertanahan BPN untuk permohonan PPKPR Berusaha Anda ({$noReg}) dijadwalkan pada:\n\n"
                         . "Waktu: {$application->bpn_rapat_date}\n\n"
                         . "Pantau detail permohonan di: {$url}";
                $this->executeFonnteSend($pemohonPhone, $message);
                break;
 
            case 'pertek_terbit':
                // Pertek Terbit -> Blast ke Pelaku Usaha & Dinas PU (Tata Ruang)
                $msgPU = "Halo {$namaPemohon}, Rekomendasi Teknis / Pertek Pertanahan untuk permohonan {$noReg} telah DITERBITKAN oleh BPN. Proses dilanjutkan ke Dinas Pekerjaan Umum (PU) untuk penilaian tata ruang. Detail: {$url}";
                $msgPU_Dinas = "Notifikasi Dinas PU: Pertek Pertanahan untuk permohonan PPKPR Berusaha {$noReg} telah diterbitkan oleh BPN.\n\nSilakan lakukan penilaian tata ruang atas permohonan ini di: {$url}";
                
                $this->executeFonnteSend($pemohonPhone, $msgPU);
                $this->executeFonnteSend($puDinasPhone, $msgPU_Dinas);
                break;
 
            case 'pertek_tolak':
                $message = "Halo {$namaPemohon}, permohonan PPKPR Berusaha Anda ({$noReg}) ditolak oleh BPN dengan catatan:\n"
                         . "\"{$application->bpn_notes}\"\n\nLacak detail di: {$url}";
                $this->executeFonnteSend($pemohonPhone, $message);
                break;
 
            case 'pu_sesuai':
                // Penilaian Sesuai -> Blast ke Dinas Satu Pintu (PTSP)
                $msgPTSP = "Notifikasi Dinas 1 Pintu (PTSP): Permohonan PPKPR Berusaha {$noReg} telah dinilai SESUAI oleh Dinas PU.\n\nSilakan lakukan input nomor PKKPR, tanggal terbit, dan unggah dokumen produk akhir (PKKPR Berusaha) di: {$url}";
                $this->executeFonnteSend($satuPintuPhone, $msgPTSP);
                break;
 
            case 'pu_belum_sesuai':
                // Penilaian Belum Sesuai -> Blast ke Pelaku Usaha
                $message = "Halo {$namaPemohon}, peninjauan tata ruang oleh Dinas PU untuk permohonan {$noReg} dinyatakan BELUM SESUAI dengan catatan:\n"
                         . "\"{$application->dinas_pu_notes}\"\n\nSilakan koordinasikan atau lacak detail perbaikan di: {$url}";
                $this->executeFonnteSend($pemohonPhone, $message);
                break;
 
            case 'final_disetujui':
                // Final Disetujui -> Blast ke Pelaku Usaha, BPN, dan Dinas PU
                $msgPU = "Selamat! Dokumen PKKPR Berusaha Anda ({$noReg}) telah DITERBITKAN oleh Dinas Satu Pintu (PTSP).\n\n"
                       . "No. PKKPR: {$application->satu_pintu_no_pkkpr}\n"
                       . "Silakan buka dashboard untuk mengunduh produk akhir Anda di: {$url}";
                       
                $msgBPN = "Notifikasi BPN: Dokumen PKKPR Berusaha {$noReg} telah diterbitkan oleh Dinas Satu Pintu (PTSP). Alur permohonan selesai.";
                $msgPU_Dinas = "Notifikasi Dinas PU: Dokumen PKKPR Berusaha {$noReg} telah diterbitkan oleh Dinas Satu Pintu (PTSP). Alur permohonan selesai.";
 
                $this->executeFonnteSend($pemohonPhone, $msgPU);
                $this->executeFonnteSend($bpnPhone, $msgBPN);
                $this->executeFonnteSend($puDinasPhone, $msgPU_Dinas);
                break;
        }
    }
 
    /**
     * Kirim notifikasi WA riil ke Fonnte API dan catat ke JSON log.
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

<?php

namespace App\Http\Controllers;

use App\Models\PsnApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PsnController extends Controller
{
    // â”€â”€â”€ INDEX â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    public function index()
    {
        $user = Auth::user();

        if ($user->isPelakuUsaha()) {
            $applications = PsnApplication::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')->get();
        } elseif ($user->isDinasPutr()) {
            $applications = PsnApplication::where('status', 'menunggu_putr')
                ->orderBy('created_at', 'asc')->get();
        } elseif ($user->isBpn() || $user->isDpn() || $user->isDinasPu() || $user->isSatuPintu()) {
            $applications = PsnApplication::orderBy('created_at', 'desc')->get();
        } else {
            abort(403, 'Peran akun Anda tidak terdaftar dalam sistem.');
        }

        return view('psn.index', compact('applications'));
    }

    // â”€â”€â”€ CREATE â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('ptp.create')->with('info', 'Silakan isi formulir Permohonan PTP terlebih dahulu.');
        }
        if (!Auth::user()->isPelakuUsaha()) {
            abort(403, 'Hanya Pelaku Usaha yang dapat membuat pengajuan.');
        }
        return view('psn.create');
    }

    // â”€â”€â”€ STORE â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
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
            'nama_pemilik_usaha'       => 'required|string|max:100',
            'nama_pengaju'             => 'required|string|max:100',
            'hubungan_pengaju'         => 'required|string|max:100',
            'peta_lokasi'              => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'surat_kuasa'              => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'fc_ktp'                   => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'fc_npwp'                  => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'fc_akta_pendirian'        => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'rencana_penggunaan_tanah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'kbli_kode'                => 'required|string|max:20',
            'proposal_kegiatan'        => 'required|file|mimes:pdf,doc,docx|max:10240',
            'persyaratan_lainnya'      => 'nullable|file|mimes:pdf,jpg,jpeg,png,zip,rar|max:10240',
        ]);

        $data = $request->only(['nama_pemilik_usaha', 'nama_pengaju', 'hubungan_pengaju', 'kbli_kode']);
        $data['user_id']            = Auth::id();
        $data['status']             = 'menunggu_bpn';
        $data['bpn_berkas_status']  = 'menunggu';
        $data['application_number'] = 'PSN-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        if (session()->has('ptp_form_data')) {
            $data['ptp_data'] = json_encode(session('ptp_form_data'));
        }

        $pemilik   = Str::slug($data['nama_pemilik_usaha'], '_');
        $timestamp = date('Ymd_His');

        $filesToStore = [
            'peta_lokasi', 'surat_kuasa', 'fc_ktp', 'fc_npwp',
            'fc_akta_pendirian', 'rencana_penggunaan_tanah',
            'proposal_kegiatan', 'persyaratan_lainnya',
        ];

        foreach ($filesToStore as $fileKey) {
            if ($request->hasFile($fileKey)) {
                $file      = $request->file($fileKey);
                $ext       = $file->getClientOriginalExtension();
                $fileName  = "{$pemilik}_{$fileKey}_{$timestamp}.{$ext}";
                $data[$fileKey] = $file->storeAs('psn_docs', $fileName, 'public');
            }
        }

        $app = PsnApplication::create($data);
        session()->forget('ptp_form_data');

        // WA Notifikasi ke pemohon
        $this->sendCustomWa($app, 'submit');

        return redirect()->route('psn.show', $app->application_number)
            ->with('success', 'Permohonan PSN Anda berhasil diajukan! Silakan pantau proses verifikasi.');
    }

    // â”€â”€â”€ SHOW â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    public function show($id)
    {
        $application = PsnApplication::where('id', $id)->orWhere('application_number', $id)->firstOrFail();
        $user        = Auth::user();

        if ($user->isPelakuUsaha() && $application->user_id !== $user->id) {
            abort(403, 'Anda tidak diizinkan mengakses permohonan ini.');
        }

        return view('psn.show', compact('application'));
    }

    // â”€â”€â”€ VERIFY â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    public function ptpPdf($id)
    {
        $application = PsnApplication::where('id', $id)->orWhere('application_number', $id)->firstOrFail();
        
        if (!$application->ptp_data) {
            return back()->with('error', 'Data Formulir PTP tidak ditemukan untuk permohonan ini.');
        }

        $ptp = json_decode($application->ptp_data, true);
        $ptp['app_number'] = $application->application_number;

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('berkas.ptp_pdf', $ptp);
        
        return $pdf->stream('Formulir_PTP_' . $application->application_number . '.pdf');
    }

    public function verify(Request $request, $id)
    {
        $application = PsnApplication::where('id', $id)->orWhere('application_number', $id)->firstOrFail();
        $user        = Auth::user();
        $step        = $request->input('step');
        $action      = $request->input('action');
        $notes       = $request->input('notes', '');

        // BPN Langkah 1 â€” Verifikasi Berkas
        if ($user->isBpn() && $application->status === 'menunggu_bpn' && $step === 'bpn_berkas') {
            $request->validate([
                'action' => 'required|in:approve,reject',
                'notes'  => 'required|string|max:1000',
            ]);

            $application->bpn_notes        = $notes;
            $application->bpn_berkas_status = $action === 'approve' ? 'diterima' : 'ditolak';

            if ($action === 'reject') {
                $application->status = 'ditolak';
                $msg = 'Permohonan ditolak pada verifikasi berkas awal.';
            } else {
                $application->status = 'menunggu_putr'; // Lanjut ke PUTR untuk validasi pembayaran
                $msg = 'Berkas awal disetujui. Permohonan diteruskan ke Dinas PUTR untuk validasi pembayaran.';
            }

            $application->save();
            $this->sendCustomWa($application, 'berkas_verifikasi');
            return redirect()->route('psn.show', $id)->with('success', $msg);
        }

        // PUTR â€” Validasi Permohonan â†’ notif ke pemohon (cek pembayaran) & ke BPN
        if ($user->isDinasPutr() && $application->status === 'menunggu_putr' && $step === 'putr_validasi') {
            $request->validate(['action' => 'required|in:approve,reject', 'putr_notes' => 'nullable|string|max:1000']);
            $putrNotes = $request->input('putr_notes');

            if ($action === 'approve') {
                $application->putr_validated_at = now();
                $application->putr_notes        = $putrNotes;
                $application->save();
                $this->sendCustomWa($application, 'putr_notif_payment');
                $this->sendCustomWa($application, 'putr_notif_bpn');
                return redirect()->route('psn.show', $id)
                    ->with('success', 'Permohonan divalidasi PUTR. Notif pembayaran terkirim ke pemohon dan BPN.');
            } else {
                $application->status     = 'ditolak';
                $application->putr_notes = $putrNotes;
                $application->save();
                $this->sendCustomWa($application, 'putr_tolak');
                return redirect()->route('psn.show', $id)->with('success', 'Permohonan PSN ditolak oleh Dinas PUTR.');
            }
        }

        // BPN â€” Konfirmasi Pembayaran + No. Berkas â†’ Blast Credentials ke pemohon
        if ($user->isBpn() && $application->status === 'menunggu_putr' && $step === 'bpn_konfirmasi_bayar') {
            $request->validate(['no_berkas' => 'required|string|max:100'], ['no_berkas.required' => 'Nomor berkas wajib diisi.']);
            $application->no_berkas          = $request->input('no_berkas');
            $application->credential_sent_at = now();
            $application->status             = 'menunggu_bpn'; // lanjut cek lokasi dst
            $application->save();
            $this->sendCustomWa($application, 'credential_blast');
            return redirect()->route('psn.show', $id)
                ->with('success', 'Pembayaran dikonfirmasi. Kredensial dikirim ke WA pemohon. No. Berkas: ' . $application->no_berkas);
        }

        // BPN Langkah 2 â€” Jadwal Cek Lokasi
        if ($user->isBpn() && $application->status === 'menunggu_bpn' && $step === 'bpn_cek_lokasi') {
            $request->validate([
                'bpn_cek_lokasi_dt' => 'required|date',
                'bpn_cek_lokasi_cp' => 'required|string|max:100',
            ]);

            $dt        = Carbon::parse($request->input('bpn_cek_lokasi_dt'));
            $dateLabel = $dt->locale('id')->translatedFormat('l, d F Y \J\a\m H:i \W\I\B');
            $isReschedule = !empty($application->bpn_cek_lokasi_dt);

            $application->bpn_cek_lokasi_dt   = $dt;
            $application->bpn_cek_lokasi_date  = $dateLabel;
            $application->bpn_cek_lokasi_cp    = $request->input('bpn_cek_lokasi_cp');
            $application->save();

            $this->sendCustomWa($application, $isReschedule ? 'cek_lokasi_ubah' : 'cek_lokasi');
            return redirect()->route('psn.show', $id)->with('success', 'Jadwal cek lokasi disimpan & di-blast ke WA pemohon.');
        }

        // BPN Langkah 3 â€” Jadwal Rapat
        if ($user->isBpn() && $application->status === 'menunggu_bpn' && $step === 'bpn_rapat') {
            $request->validate(['bpn_rapat_dt' => 'required|date']);

            $dt        = Carbon::parse($request->input('bpn_rapat_dt'));
            $dateLabel = $dt->locale('id')->translatedFormat('l, d F Y \J\a\m H:i \W\I\B');
            $isReschedule = !empty($application->bpn_rapat_dt);

            $application->bpn_rapat_dt   = $dt;
            $application->bpn_rapat_date = $dateLabel;
            $application->save();

            $this->sendCustomWa($application, $isReschedule ? 'rapat_ubah' : 'rapat');
            return redirect()->route('psn.show', $id)->with('success', 'Jadwal rapat disimpan & di-blast ke WA pemohon.');
        }

        // BPN Langkah 4 â€” Penerbitan Pertek â†’ Teruskan ke Dinas PU
        if ($user->isBpn() && $application->status === 'menunggu_bpn' && $step === 'bpn_pertek') {
            $request->validate([
                'action'              => 'required|in:approve,reject',
                'notes'               => 'required|string|max:1000',
                'bpn_pertek_document' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            ]);

            $application->bpn_notes = $notes;

            if ($action === 'approve') {
                if (!$request->hasFile('bpn_pertek_document')) {
                    return redirect()->back()->withErrors(['bpn_pertek_document' => 'Dokumen Pertek wajib diunggah saat menyetujui.']);
                }
                $path = $request->file('bpn_pertek_document')->store('psn_perteks', 'public');
                $application->bpn_pertek_document = $path;
                $application->bpn_pertek_uploaded_at = now();
                $application->status = 'menunggu_dinas_pu'; // PSN lanjut ke Dinas PU
                $msg = 'Pertek berhasil diterbitkan. Permohonan PSN diteruskan ke Dinas PU.';
            } else {
                $application->status = 'ditolak';
                $msg = 'Permohonan ditolak pada tahap Pertek BPN.';
            }

            $application->save();
            $this->sendCustomWa($application, $action === 'approve' ? 'pertek_terbit' : 'pertek_tolak');
            return redirect()->route('psn.show', $id)->with('success', $msg);
        }

        // Dinas PU â€” Penilaian PKKPR
        if ($user->isDinasPu() && $application->status === 'menunggu_dinas_pu' && $step === 'dinas_pu_penilaian') {
            $request->validate([
                'action'                    => 'required|in:approve,reject',
                'dinas_pu_tanggal_penilaian'=> 'required|date',
                'dinas_pu_document'         => 'nullable|file|mimes:pdf,doc,docx|max:10240',
                'notes'                     => 'nullable|string|max:1000',
            ], [
                'dinas_pu_tanggal_penilaian.required' => 'Tanggal penilaian wajib diisi.',
            ]);

            $dt = Carbon::parse($request->input('dinas_pu_tanggal_penilaian'));
            $application->dinas_pu_tanggal_penilaian = $dt->format('d-m-Y');
            $application->dinas_pu_notes             = $notes;

            if ($request->hasFile('dinas_pu_document')) {
                $path = $request->file('dinas_pu_document')->store('psn_pu_docs', 'public');
                $application->dinas_pu_document = $path;
            }

            if ($action === 'approve') {
                $application->status = 'menunggu_satu_pintu';
                $msg = 'Penilaian PKKPR selesai. Permohonan PSN diteruskan ke Satu Pintu/PTSP.';
            } else {
                $application->status = 'ditolak';
                $msg = 'Permohonan ditolak oleh Dinas PU pada tahap penilaian PKKPR.';
            }

            $application->save();
            $this->sendCustomWa($application, $action === 'approve' ? 'pu_selesai' : 'pu_tolak');
            return redirect()->route('psn.show', $id)->with('success', $msg);
        }

        // Satu Pintu / PTSP â€” Penerbitan PKKPR
        if ($user->isSatuPintu() && $application->status === 'menunggu_satu_pintu' && $step === 'satu_pintu') {
            $request->validate([
                'action'                    => 'required|in:approve,reject',
                'satu_pintu_no_pkkpr'       => 'required_if:action,approve|nullable|string|max:100',
                'satu_pintu_tanggal_terbit' => 'required_if:action,approve|nullable|date',
                'approval_document'         => 'nullable|file|mimes:pdf|max:10240',
                'notes'                     => 'nullable|string|max:1000',
            ], [
                'satu_pintu_no_pkkpr.required_if'       => 'Nomor PKKPR wajib diisi saat menerbitkan.',
                'satu_pintu_tanggal_terbit.required_if' => 'Tanggal terbit PKKPR wajib diisi.',
            ]);

            $application->satu_pintu_notes = $notes;

            if ($action === 'approve') {
                $application->satu_pintu_no_pkkpr       = $request->input('satu_pintu_no_pkkpr');
                $application->satu_pintu_tanggal_terbit = $request->input('satu_pintu_tanggal_terbit');

                if ($request->hasFile('approval_document')) {
                    $path = $request->file('approval_document')->store('psn_pkkpr', 'public');
                    $application->approval_document = $path;
                }

                $application->status = 'disetujui';
                $msg = 'PKKPR PSN berhasil diterbitkan! Permohonan dinyatakan selesai.';
            } else {
                $application->status = 'ditolak';
                $msg = 'Permohonan ditolak oleh Dinas Satu Pintu.';
            }

            $application->save();
            $this->sendCustomWa($application, $action === 'approve' ? 'pkkpr_terbit' : 'pkkpr_tolak');
            return redirect()->route('psn.show', $id)->with('success', $msg);
        }

        abort(403, 'Aksi tidak diizinkan atau status permohonan tidak sesuai.');
    }

    // â”€â”€â”€ WA HELPER â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    private function getWhatsappSettings(): array
    {
        $path = storage_path('app/whatsapp_settings.json');
        if (!file_exists($path)) {
            return ['connected' => false, 'fonnte_token' => '', 'admin_bpn' => '', 'admin_putr' => '', 'admin_dinas_pu' => '', 'admin_satu_pintu' => ''];
        }
        $s = json_decode(file_get_contents($path), true);
        foreach (['fonnte_token', 'admin_bpn', 'admin_putr', 'admin_dinas_pu', 'admin_satu_pintu'] as $k) {
            if (!isset($s[$k])) $s[$k] = '';
        }
        return $s;
    }

    private function sendCustomWa(PsnApplication $app, string $type): void
    {
        $settings = $this->getWhatsappSettings();
        if (!($settings['connected'] ?? false)) return;

        $url        = route('psn.show', $app->id);
        $nama       = $app->nama_pengaju ?: ($app->user->name ?? $app->user->username);
        $noReg      = $app->application_number;
        $pemohon    = $app->user->phone_number;
        $bpnPhone   = !empty($settings['admin_bpn'])        ? $settings['admin_bpn']        : '';
        $puPhone    = !empty($settings['admin_dinas_pu'])   ? $settings['admin_dinas_pu']   : '';
        $spPhone    = !empty($settings['admin_satu_pintu']) ? $settings['admin_satu_pintu'] : '';

        $msg = match ($type) {
            'submit' =>
                "Halo {$nama}, permohonan PKKPR PSN (Proyek Strategis Nasional) Anda dengan nomor {$noReg} berhasil diajukan.\n\nBerkas Anda sedang dalam verifikasi awal BPN. Kami akan mengirimkan pembaruan status selanjutnya melalui WhatsApp.",

            'berkas_verifikasi' => $app->bpn_berkas_status === 'diterima'
                ? "Halo {$nama}, berkas PSN {$noReg} dinyatakan VALID oleh BPN. Permohonan diteruskan ke Dinas PUTR untuk validasi pembayaran. Kami akan menghubungi Anda kembali."
                : "Halo {$nama}, berkas PSN {$noReg} dinyatakan TIDAK SESUAI oleh BPN.\nAlasan: \"{$app->bpn_notes}\"\n\nMohon siapkan perbaikan berkas sesuai arahan petugas atau hubungi admin BPN.",

            'cek_lokasi' => (function() use ($app, $nama, $noReg) {
                $waktu = \Carbon\Carbon::parse($app->bpn_cek_lokasi_date)->locale('id')->translatedFormat('l, d F Y \J\a\m H:i \W\I\B');
                return "Halo {$nama}, permohonan PPKPR PSN Anda ({$noReg}) dijadwalkan untuk peninjauan lapangan pada :\n\n"
                     . "Waktu: {$waktu}\n"
                     . "CP Lapangan/Admin: (atas nama) {$app->bpn_cek_lokasi_cp}\n\n"
                     . "Harap konfirmasi kesediaan anda dengan menghubungi Contact Person petugas lapangan diatas.";
            })(),

            'cek_lokasi_ubah' =>
                "Halo {$nama}, [PERUBAHAN JADWAL] Peninjauan lokasi PSN {$noReg} diubah.\n\nJadwal Baru: {$app->bpn_cek_lokasi_date}\nCP Petugas: {$app->bpn_cek_lokasi_cp}\n\nDetail: {$url}",

            'rapat' => (function() use ($app, $nama, $noReg, $url) {
                $waktu = \Carbon\Carbon::parse($app->bpn_rapat_date)->locale('id')->translatedFormat('l, d F Y \J\a\m H:i \W\I\B');
                return "Halo {$nama}, sidang / rapat pembahasan pertimbangan teknis pertanahan untuk permohonan PKKPR PSN Anda ({$noReg}) dijadwalkan pada:\n\n"
                     . "Waktu: {$waktu}\n\n"
                     . "Pantau detail permohonan di: {$url}";
            })(),

            'rapat_ubah' =>
                "Halo {$nama}, [PERUBAHAN] Jadwal rapat PSN {$noReg} diubah.\n\nJadwal Baru: {$app->bpn_rapat_date}\n\nPantau di: {$url}",

            'pertek_terbit' =>
                "Halo {$nama}, Pertimbangan Teknis Pertanahan untuk PKKPR dengan no berkas... {$noReg} telah DITERBITKAN oleh kantor pertanahan kota sukabumi. Proses selanjutnya di Dinas Pekerjaan Umum (PU) dan (PUTR) untuk dilakukan penilaian PKKPR PSN. informasi detail dapat diakases di {$url}",

            'pertek_tolak' =>
                "Halo {$nama}, permohonan PSN {$noReg} DITOLAK oleh BPN pada tahap Pertek.\nCatatan BPN: {$app->bpn_notes}\n\nDetail: {$url}",

            'putr_notif_payment' =>
                "Halo {$nama}, permohonan PKKPR PSN {$noReg} telah divalidasi Dinas PUTR.\n\nSilakan cek instruksi pembayaran retribusi (di email atau melalui petugas). Jika pembayaran sudah diselesaikan, Anda akan menerima detail Kredensial Akun (Username & Password) untuk memantau progress di sistem.",

            'putr_tolak' =>
                "Halo {$nama}, permohonan PSN {$noReg} DITOLAK oleh Dinas PUTR.\nCatatan: {$app->putr_notes}\n\nHarap hubungi petugas untuk informasi lebih lanjut.",

            'credential_blast' => (function() use ($app, $nama, $noReg) {
                $ptpData  = json_decode($app->ptp_data, true) ?? [];
                $nik      = $ptpData['nik'] ?? '';
                $username = $app->user->username ?? '-';
                $password = $nik ?: 'NIK Anda';
                return "Halo {$nama}, pembayaran PSN {$noReg} telah dikonfirmasi.\n\n"
                     . "Akun login portal PATEN PAK MIKO Anda:\n"
                     . "Username : {$username}\n"
                     . "Password : {$password}\n"
                     . "No. Berkas : {$app->no_berkas}\n\n"
                     . "Login dan pantau permohonan di:\n" . url('/dashboard') . "\n\nBantuan: hubungi petugas BPN.";
            })(),

            'putr_notif_bpn' => null, // Ditangani di bawah (kirim ke BPN, bukan pemohon)

            'pu_selesai' =>
                "Halo {$nama}, penilaian PKKPR PSN {$noReg} oleh Dinas PU selesai. Permohonan diteruskan ke Dinas Satu Pintu untuk penerbitan PKKPR resmi. Pantau di: {$url}",

            'pu_tolak' =>
                "Halo {$nama}, permohonan PSN {$noReg} DITOLAK oleh Dinas PU pada tahap penilaian PKKPR.\nCatatan: {$app->dinas_pu_notes}\n\nDetail: {$url}",

            'pkkpr_terbit' =>
                "Selamat! Dokumen PKKPR PSN Anda ({$noReg}) telah DITERBITKAN oleh Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (PTSP).\n\nNo. PKKPR: {$app->satu_pintu_no_pkkpr}\nSilakan buka dashboard untuk mengunduh produk akhir Anda di: {$url}",

            'pkkpr_tolak' =>
                "Halo {$nama}, permohonan PSN {$noReg} DITOLAK oleh Dinas Satu Pintu.\nCatatan: {$app->satu_pintu_notes}\n\nDetail: {$url}",

            default => null,
        };

        if ($msg) {
            if (!empty($settings['cp_admin'])) {
                $msg .= "\n\n_Jika ada pertanyaan, hubungi CP Admin: " . $settings['cp_admin'] . "_";
            }
            $this->executeFonnteSend($pemohon, $msg);
        }

        // Notif ke admin instansi sesuai tahap
        if ($type === 'berkas_verifikasi' && $app->bpn_berkas_status === 'diterima' && !empty($settings['admin_putr'])) {
            $this->executeFonnteSend($settings['admin_putr'],
                "[PUTR] Berkas awal BPN untuk PSN {$noReg} telah valid. Silakan lakukan validasi pembayaran di: {$url}");
        }
        if ($type === 'putr_notif_bpn' && !empty($settings['admin_bpn'])) {
            $this->executeFonnteSend($settings['admin_bpn'],
                "[BPN] PSN {$noReg} telah divalidasi PUTR. Menunggu konfirmasi pembayaran pemohon. Detail: {$url}");
        }
        if ($type === 'pertek_terbit' && $puPhone) {
            $this->executeFonnteSend($puPhone, "Notifikasi Dinas PU: Pertek BPN untuk PSN {$noReg} telah terbit. Silakan lakukan penilaian PKKPR di: {$url}");
        }
        if ($type === 'pu_selesai' && $spPhone) {
            $this->executeFonnteSend($spPhone, "Notifikasi Satu Pintu: Penilaian Dinas PU untuk PSN {$noReg} selesai. Silakan proses penerbitan PKKPR di: {$url}");
        }
        if ($type === 'pu_selesai' && $bpnPhone) {
            $this->executeFonnteSend($bpnPhone, "Notifikasi BPN: Dinas PU telah selesai menilai PSN {$noReg}. Menunggu penerbitan PKKPR oleh Satu Pintu.");
        }
    }

    private function executeFonnteSend(string $phone, string $message): void
    {
        $settings   = $this->getWhatsappSettings();
        $statusText = 'Simulasi';

        if (!empty($settings['fonnte_token'])) {
            $clean = preg_replace('/[^0-9]/', '', $phone);
            if (str_starts_with($clean, '0')) $clean = '62' . substr($clean, 1);

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL            => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT        => 20,
                CURLOPT_CUSTOMREQUEST  => 'POST',
                CURLOPT_POSTFIELDS     => ['target' => $clean, 'message' => $message],
                CURLOPT_HTTPHEADER     => ['Authorization: ' . $settings['fonnte_token']],
            ]);
            $response = curl_exec($curl);
            $err      = curl_error($curl);
            curl_close($curl);

            if (!$err) {
                $decoded    = json_decode($response, true);
                $statusText = ($decoded['status'] ?? false) ? 'Terkirim (Fonnte API)' : 'Gagal (Fonnte: ' . ($decoded['reason'] ?? 'Token Error') . ')';
            } else {
                $statusText = 'Gagal (Koneksi API Error)';
            }
        }

        $logPath = storage_path('app/whatsapp_logs.json');
        $logs    = file_exists($logPath) ? (json_decode(file_get_contents($logPath), true) ?: []) : [];

        array_unshift($logs, [
            'id'        => uniqid(),
            'recipient' => $phone,
            'message'   => $message,
            'timestamp' => now()->format('d M Y, H:i:s'),
            'status'    => $statusText,
        ]);

        file_put_contents($logPath, json_encode($logs, JSON_PRETTY_PRINT));
    }
}


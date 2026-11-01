<?php

namespace App\Traits;

use App\Services\WhatsappService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

trait WaBlastHelper
{
    /**
     * Helper untuk mengenerate pesan WhatsApp Blast secara seragam untuk semua Modul.
     * Bebas dari {no_reg} dan disesuaikan dengan template terbaru.
     */
    public static function generateWaMessage(string $type, $app, string $layanan, string $url): ?string
    {
        $nama = $app->nama_pengaju ?: ($app->user->name ?? $app->user->username);
        // Mengambil nomor berkas jika ada, jika tidak, kosongkan.
        $no_berkas_text = !empty($app->no_berkas) ? " (No. Berkas: {$app->no_berkas})" : "";
        
        $dokumenFinal = (stripos($layanan, 'PPKPR') !== false || stripos($layanan, 'PKKPR') !== false) 
                        ? str_replace('PPKPR', 'PKKPR', $layanan) 
                        : "Dokumen {$layanan}";

        return match ($type) {
            'rollback' => (function() use ($app, $nama, $layanan, $no_berkas_text, $url) {
                $statusNama = match ($app->status) {
                    'menunggu_bpn' => 'Pemeriksaan Kantor Pertanahan (BPN)',
                    'menunggu_putr', 'menunggu_dinas_pu' => 'Validasi / Penilaian Dinas PU',
                    'menunggu_satu_pintu' => 'Verifikasi Dinas DPMPTSP (Satu Pintu)',
                    default => 'Verifikasi Berkas Awal'
                };
                return "Halo {$nama}, permohonan {$layanan}{$no_berkas_text} Anda dikembalikan (rollback) ke tahap *{$statusNama}* untuk dilakukan pemeriksaan/penyesuaian kembali.\n\nDetail permohonan: {$url}";
            })(),

            'submit', 'submit_berkas' =>
                "Halo {$nama}, permohonan {$layanan} Anda berhasil diajukan.\n\nBerkas Anda sedang dalam verifikasi awal Kantor Pertanahan Kota Sukabumi.",

            'berkas_verifikasi' => (function() use ($app, $nama, $layanan, $no_berkas_text) {
                if ($app->bpn_berkas_status === 'diterima') {
                    $spsLink = '';
                    if (!empty($app->bpn_sps_document)) {
                        $spsLink = "\n\n*Surat Perintah Setor (Tagihan PNBP):*\n" . route('file.view', ['path' => $app->bpn_sps_document]);
                    }
                    if ($app instanceof \App\Models\PpkprBerusahaApplication || empty($app->bpn_sps_document)) {
                        return "Halo {$nama}, berkas Permohonan {$layanan}{$no_berkas_text} Anda dinyatakan *LENGKAP* oleh Kantor Pertanahan Kota Sukabumi.\n\nSilakan lakukan pembayaran PNBP ke Kantor Pertanahan Kota Sukabumi. Setelah melakukan pembayaran, mohon konfirmasi ke kontak WhatsApp ini atau ke Kantor Pertanahan Kota Sukabumi. Setelah pembayaran dikonfirmasi lunas, Anda akan menerima detail akun login dashboard.";
                    }
                    return "Halo {$nama}, berkas Permohonan {$layanan}{$no_berkas_text} Anda dinyatakan *LENGKAP* oleh Kantor Pertanahan Kota Sukabumi.{$spsLink}\n\nSilakan lakukan pembayaran PNBP sesuai tagihan pada dokumen di atas. Setelah melakukan pembayaran, mohon balas/kirimkan bukti pembayaran Anda ke kontak WhatsApp ini atau ke Kantor Pertanahan Kota Sukabumi untuk verifikasi. Setelah pembayaran dikonfirmasi lunas, Anda akan menerima detail akun login dashboard.";
                } else {
                    $settings = self::getWhatsappSettingsStatic();
                    $cpContact = !empty($settings['cp_admin']) ? $settings['cp_admin'] : ($settings['admin_bpn'] ?? '');
                    $cpText = !empty($cpContact) ? " (Hubungi WA Admin BPN: {$cpContact})" : "";
                    return "Halo {$nama}, berkas Permohonan {$layanan}{$no_berkas_text} Anda dinyatakan TIDAK LENGKAP oleh Kantor Pertanahan Kota Sukabumi.\nAlasan: \"{$app->bpn_notes}\"\n\nMohon siapkan perbaikan berkas sesuai arahan petugas atau hubungi admin Kantor Pertanahan Kota Sukabumi{$cpText}.\n\nSilakan klik link berikut untuk mengunggah ulang perbaikan berkas Anda:\n" . url('/revisi-berkas');
                }
            })(),

            'berkas_revisi_bpn' =>
                "Notifikasi Kantor Pertanahan Kota Sukabumi: Pelaku Usaha {$nama} telah mengunggah ulang berkas revisi/perbaikan untuk permohonan {$layanan}. Silakan cek & verifikasi ulang dokumen di: {$url}",

            'putr_notif_payment', 'putr_validasi' =>
                "Halo {$nama}, permohonan {$layanan}{$no_berkas_text} Anda Telah selesai di Verifikasi oleh Dinas PUTR. Silakan cek instruksi pembayaran PNBP layanan pertimbangan teknis pertanahan pada alamat email yang anda daftarkan di aplikasi oss. Jika pembayaran sudah diselesaikan, Anda akan menerima detail Akun.",

            'putr_tolak' =>
                "Halo {$nama}, permohonan {$layanan}{$no_berkas_text} Anda dinyatakan BELUM TERVALIDASI oleh Dinas PUTR.\nCatatan: {$app->putr_notes}\n\nDetail: {$url}",

            'credential_blast', 'credential' => (function() use ($app, $nama, $layanan, $url) {
                $ptpData  = json_decode($app->ptp_data, true) ?? [];
                $nik      = $ptpData['nik'] ?? '';
                $username = $app->user->username ?? '-';
                
                $passwordText = $nik ?: "(NIK pendaftaran Anda)";
                
                $msg = "Halo {$nama}, pembayaran {$layanan} Anda telah dikonfirmasi.\n\n"
                     . "Akun login portal PATEN PAK MIKO Anda:\n"
                     . "Username : {$username}\n"
                     . "Password : {$passwordText}\n"
                     . "No. Berkas : {$app->no_berkas}\n\n"
                     . "Login dan pantau permohonan di: {$url}";
                
                return $msg;
            })(),

            'cek_lokasi' => (function() use ($app, $nama, $layanan, $no_berkas_text) {
                $waktu = $app->bpn_cek_lokasi_date ?: ($app->bpn_cek_lokasi_dt ? Carbon::parse($app->bpn_cek_lokasi_dt)->locale('id')->translatedFormat('l, d F Y \J\a\m H:i \W\I\B') : '-');
                return "Halo {$nama}, permohonan {$layanan} Anda{$no_berkas_text} dijadwalkan untuk peninjauan lapangan pada:\n\n"
                     . "Waktu: {$waktu}\n\n"
                     . "Harap konfirmasi kesediaan Anda dengan menghubungi Contact Person di bawah:\n"
                     . "Contact Person Petugas Lapang: {$app->bpn_cek_lokasi_cp}";
            })(),

            'cek_lokasi_ubah' =>
                "Halo {$nama}, [PERUBAHAN JADWAL] Peninjauan lapangan {$layanan}{$no_berkas_text} diubah.\n\nJadwal Baru: {$app->bpn_cek_lokasi_date}\n\nHarap konfirmasi kesediaan Anda dengan menghubungi Contact Person di bawah:\nContact Person Petugas Lapang: {$app->bpn_cek_lokasi_cp}",

            'rapat' => (function() use ($app, $nama, $layanan, $no_berkas_text) {
                $waktu = $app->bpn_rapat_date ?: ($app->bpn_rapat_dt ? Carbon::parse($app->bpn_rapat_dt)->locale('id')->translatedFormat('l, d F Y \J\a\m H:i \W\I\B') : '-');
                return "Halo {$nama}, rapat pembahasan pertimbangan teknis pertanahan untuk permohonan {$layanan}{$no_berkas_text} dijadwalkan pada:\n\n"
                     . "Waktu: {$waktu}";
            })(),

            'rapat_ubah' =>
                "Halo {$nama}, [PERUBAHAN] Jadwal rapat {$layanan}{$no_berkas_text} diubah menjadi: {$app->bpn_rapat_date}.",

            'pertek_terbit' =>
                "Halo {$nama}, untuk permohonan {$layanan}{$no_berkas_text} telah DITERBITKAN oleh Kantor Pertanahan Kota Sukabumi.",

            'pertek_tolak' =>
                "Halo {$nama}, permohonan {$layanan}{$no_berkas_text} DITOLAK oleh Kantor Pertanahan Kota Sukabumi pada tahap Pertimbangan Teknis Pertanahan.\nCatatan: {$app->bpn_notes}\n\nDetail: {$url}",

            'pu_selesai' =>
                "Halo {$nama}, penilaian {$layanan}{$no_berkas_text} Telah selesai di Verifikasi oleh Dinas PUTR. Selanjutnya permohonan diteruskan ke Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) Kota Sukabumi untuk dilakukan penerbitan {$dokumenFinal}. Pantau di: {$url}",

            'pu_tolak' =>
                "Halo {$nama}, permohonan {$layanan}{$no_berkas_text} DITOLAK oleh Dinas PUTR.\nCatatan: {$app->dinas_pu_notes}\n\nDetail: {$url}",

            'pkkpr_terbit' =>
                "Halo {$nama}, Permohonan {$layanan} Anda{$no_berkas_text} telah diterbitkan oleh Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) Kota Sukabumi.\n\n"
              . "Selanjutnya Anda dapat mencetak {$dokumenFinal} pada Aplikasi OSS atau Website PATEN PAK MIKO dengan link sebagai berikut:\n{$url}\n\n"
              . "Bantu kami menjadi lebih baik dengan memberikan ulasan pelayanan kami melalui tautan berikut:\n" . url('/lapolpa'),

            'pkkpr_tolak' =>
                "Halo {$nama}, permohonan {$layanan}{$no_berkas_text} DITOLAK oleh DPMPTSP.\nCatatan: {$app->satu_pintu_notes}\n\nDetail: {$url}",

            default => null,
        };
    }

    /**
     * Helper untuk mengeksekusi pengiriman Twilio Template resmi Meta secara aman (graceful).
     */
    public static function dispatchTwilioAdminTemplate(string $phone, string $templateKey, array $variables): void
    {
        try {
            $settings = self::getWhatsappSettingsStatic();
            $templateSid = $settings[$templateKey] ?? env(strtoupper($templateKey), '');
            
            if (!empty($templateSid) && !empty($phone)) {
                $waService = app(WhatsappService::class);
                $waService->sendTemplateMessage($phone, $templateSid, $variables);
            }
        } catch (\Throwable $e) {
            Log::warning("[WaBlastHelper] Gagal dispatch Twilio Admin Template ({$templateKey}): " . $e->getMessage());
        }
    }

    public function sendNotificationWithMailbox($app, $type, $layananTitle, $routeName, $customMsg = null)
    {
        if ($app->exists) {
            $app->refresh();
        }
        $settings = $this->getWhatsappSettings();
        $url = route($routeName, $app->id);
        $msg = $customMsg ?: $this->generateWaMessage($type, $app, $layananTitle, $url);
        $pemohon = $app->user->phone_number ?? '';

        $wa_links = [];
        $mailboxes = [];

        $formatPhone = function($phone) {
            $phone = preg_replace('/[^0-9]/', '', $phone);
            if (str_starts_with($phone, '0')) {
                $phone = '62' . substr($phone, 1);
            }
            return $phone;
        };

        $cpNumber = !empty($settings['cp_admin']) ? $settings['cp_admin'] : ($settings['admin_bpn'] ?? '083861669565');

        if ($msg && $pemohon) {
            $postPnbpTypes = [
                'cek_lokasi', 'cek_lokasi_ubah', 'rapat', 'rapat_ubah',
                'pertek_terbit', 'pertek_tolak', 'pu_selesai', 'pu_tolak',
                'pkkpr_terbit', 'pkkpr_tolak'
            ];

            if (in_array($type, $postPnbpTypes)) {
                $ptpData  = json_decode($app->ptp_data, true) ?? [];
                $nik      = $ptpData['nik'] ?? '';
                $username = $app->user->username ?? '-';
                
                $isPasswordNik = false;
                if ($nik && \Illuminate\Support\Facades\Hash::check($nik, $app->user->password)) {
                    $isPasswordNik = true;
                }
                
                $passwordText = $isPasswordNik ? $nik : "(Gunakan NIK pendaftaran pertama atau password yang Anda buat)";
                
                $msg .= "\n\n*Informasi Akun Anda:*\nUsername : {$username}\nPassword : {$passwordText}";
            }

            $msg .= "\n\nKami akan menghubungi Anda untuk informasi selanjutnya.";
            $msg .= "\n\nWebsite Resmi: https://patenpakmiko.com/";
            
            if (!empty($cpNumber)) {
                $msg .= "\n\n_Jika ada pertanyaan, hubungi CP Admin WA: " . $cpNumber . "_";
            }
            $wa_links[] = [
                'target' => 'Pemohon',
                'url' => 'https://wa.me/' . $formatPhone($pemohon) . '?text=' . urlencode($msg)
            ];
            $titlePemohon = 'Notifikasi Pemohon - ' . $layananTitle;
            if ($type === 'berkas_verifikasi') {
                $titlePemohon = ($app->bpn_berkas_status === 'diterima')
                    ? 'Berkas Persyaratan Lengkap - ' . $layananTitle
                    : 'Berkas Tidak Lengkap / Perlu Revisi - ' . $layananTitle;
            }

            $mailboxes[] = [
                'target_user_id' => $app->user_id,
                'target_role' => null,
                'title' => $titlePemohon,
                'message' => $msg,
                'link' => $url,
            ];
        }

        $no_berkas_text = !empty($app->no_berkas) ? " (No. Berkas: {$app->no_berkas})" : "";
        $nama = $app->nama_pengaju ?: ($app->user->name ?? ($app->user->username ?? ''));
        
        $adminBpn = $settings['admin_bpn'] ?? '';
        $adminPutr = $settings['admin_putr'] ?? ($settings['admin_dinas_pu'] ?? '');
        $adminPtsp = $settings['admin_satu_pintu'] ?? '';

        $infoPemohon = "Pemohon: {$nama}\nLayanan: {$layananTitle}";
        if (!empty($app->no_berkas)) {
            $infoPemohon .= "\nNo. Berkas: {$app->no_berkas}";
        }

        $dokumenFinalAdmin = (stripos($layananTitle, 'PPKPR') !== false || stripos($layananTitle, 'PKKPR') !== false) 
                             ? str_replace('PPKPR', 'PKKPR', $layananTitle) 
                             : "Dokumen {$layananTitle}";

        // 1. Pengajuan Baru Masuk -> Notifikasi ke Admin BPN
        if (($type === 'submit' || $type === 'submit_berkas') && $adminBpn) {
            $text = "Halo Admin Kantor Pertanahan Kota Sukabumi, ada pengajuan permohonan baru untuk {$layananTitle} atas nama {$nama}. Silakan login untuk melakukan verifikasi berkas awal di: {$url}";
            $text .= "\n\nWebsite Resmi: https://patenpakmiko.com/";
            $wa_links[] = [
                'target' => 'Admin BPN',
                'url' => 'https://wa.me/' . $formatPhone($adminBpn) . '?text=' . urlencode($text)
            ];
            $mailboxes[] = [
                'target_user_id' => null,
                'target_role' => 'bpn',
                'title' => 'Pengajuan Baru Masuk',
                'message' => "Ada pengajuan permohonan baru yang memerlukan verifikasi berkas awal.\n\n{$infoPemohon}",
                'link' => $url,
            ];

            // Auto Twilio Template Admin
            self::dispatchTwilioAdminTemplate($adminBpn, 'twilio_tpl_admin_pengajuan_baru', [
                '1' => 'Kota Sukabumi',
                '2' => $layananTitle,
                '3' => $nama,
                '4' => $url,
                '5' => $cpNumber,
            ]);
        }

        // 2. Berkas Revisi Diunggah Pemohon -> Notifikasi ke Admin BPN
        if ($type === 'berkas_revisi_bpn' && $adminBpn) {
            $text = "Notifikasi Kantor Pertanahan Kota Sukabumi: Pelaku Usaha {$nama} telah mengunggah ulang berkas revisi/perbaikan untuk permohonan {$layananTitle}. Silakan cek dan verifikasi ulang dokumen di: {$url}";
            $text .= "\n\nWebsite Resmi: https://patenpakmiko.com/";
            $wa_links[] = [
                'target' => 'Admin BPN',
                'url' => 'https://wa.me/' . $formatPhone($adminBpn) . '?text=' . urlencode($text)
            ];
            $mailboxes[] = [
                'target_user_id' => null,
                'target_role' => 'bpn',
                'title' => 'Berkas Revisi Diunggah',
                'message' => "Pelaku Usaha telah mengunggah ulang berkas revisi/perbaikan. Silakan cek dan verifikasi ulang.\n\n{$infoPemohon}",
                'link' => $url,
            ];

            // Auto Twilio Template Admin (Approved)
            self::dispatchTwilioAdminTemplate($adminBpn, 'twilio_tpl_admin_berkas_revisi', [
                '1' => 'Kota Sukabumi',
                '2' => $nama,
                '3' => $layananTitle,
                '4' => $url,
                '5' => $cpNumber,
            ]);
        }

        $isBpnOnly = ($app instanceof \App\Models\KebijakanApplication 
            || $app instanceof \App\Models\TanahTimbulApplication 
            || stripos($layananTitle, 'Kebijakan') !== false 
            || stripos($layananTitle, 'Tanah Timbul') !== false);

        // 3. Berkas Diterima BPN -> Validasi Tata Ruang Awal Masuk ke PUTR
        if ($type === 'berkas_verifikasi' && $app->bpn_berkas_status === 'diterima' && $adminPutr && !$isBpnOnly) {
            $text = "Notifikasi Dinas PUTR: Berkas permohonan {$no_berkas_text} atas nama {$nama} telah selesai divalidasi awal oleh Kantor Pertanahan Kota Sukabumi. Silakan lakukan Validasi Awal Tata Ruang di: {$url}";
            $text .= "\n\nWebsite Resmi: https://patenpakmiko.com/";
            $wa_links[] = [
                'target' => 'Admin PUTR',
                'url' => 'https://wa.me/' . $formatPhone($adminPutr) . '?text=' . urlencode($text)
            ];
            $mailboxes[] = [
                'target_user_id' => null,
                'target_role' => 'dinas_pu',
                'title' => 'Berkas Masuk PUTR',
                'message' => "Berkas permohonan telah selesai divalidasi awal oleh BPN. Menunggu Validasi Awal Tata Ruang.\n\n{$infoPemohon}",
                'link' => $url,
            ];

            // Auto Twilio Template Admin
            self::dispatchTwilioAdminTemplate($adminPutr, 'twilio_tpl_admin_validasi_putr', [
                '1' => 'PUTR Kota Sukabumi',
                '2' => !empty($app->no_berkas) ? $app->no_berkas : $layananTitle,
                '3' => $nama,
                '4' => $url,
                '5' => $cpNumber,
            ]);
        }
        
        // 4. Validasi PUTR Selesai -> Notifikasi ke BPN
        if ($type === 'putr_validasi' && $adminBpn) {
            $text = "Notifikasi Dinas PUTR: Berkas permohonan {$layananTitle}{$no_berkas_text} atas nama {$nama} telah selesai divalidasi awal oleh Dinas PUTR Kota Sukabumi. Silakan cek sistem untuk pendaftaran / tagihan PNBP di: {$url}";
            $text .= "\n\nWebsite Resmi: https://patenpakmiko.com/";
            $wa_links[] = [
                'target' => 'Admin BPN',
                'url' => 'https://wa.me/' . $formatPhone($adminBpn) . '?text=' . urlencode($text)
            ];
            $mailboxes[] = [
                'target_user_id' => null,
                'target_role' => 'bpn',
                'title' => 'Validasi PUTR Selesai',
                'message' => "Permohonan telah divalidasi tata ruangnya oleh PUTR. Silakan buat pendaftaran / tagihan PNBP.\n\n{$infoPemohon}",
                'link' => $url,
            ];

            // Auto Twilio Template Admin
            self::dispatchTwilioAdminTemplate($adminBpn, 'twilio_tpl_admin_putr_selesai', [
                '1' => 'PUTR Kota Sukabumi',
                '2' => $layananTitle,
                '3' => !empty($app->no_berkas) ? $app->no_berkas : '-',
                '4' => $nama,
                '5' => $url,
                '6' => $cpNumber,
            ]);
        }

        if ($type === 'pkkpr_terbit') {
            if ($adminBpn) {
                $text = "Notifikasi DPMPTSP: {$dokumenFinalAdmin}{$no_berkas_text} atas nama {$nama} telah diterbitkan. Proses permohonan selesai. Cek di: {$url}";
                $text .= "\n\nWebsite Resmi: https://patenpakmiko.com/";
                $wa_links[] = [
                    'target' => 'Admin BPN',
                    'url' => 'https://wa.me/' . $formatPhone($adminBpn) . '?text=' . urlencode($text)
                ];
                $mailboxes[] = [
                    'target_user_id' => null,
                    'target_role' => 'bpn',
                    'title' => 'Dokumen Diterbitkan',
                    'message' => "{$dokumenFinalAdmin} telah diterbitkan oleh DPMPTSP. Proses permohonan selesai.\n\n{$infoPemohon}",
                    'link' => $url,
                ];
            }
        }

        if ($type === 'pertek_terbit' && $adminPutr && !$isBpnOnly) {
            $text = "Notifikasi Dinas PUTR: Pertimbangan Teknis Pertanahan (PTP) untuk {$layananTitle}{$no_berkas_text} telah terbit dari Kantor Pertanahan Kota Sukabumi. Silakan lakukan penilaian PKKPR di: {$url}";
            $text .= "\n\nWebsite Resmi: https://patenpakmiko.com/";
            $wa_links[] = [
                'target' => 'Admin PUTR',
                'url' => 'https://wa.me/' . $formatPhone($adminPutr) . '?text=' . urlencode($text)
            ];
            $mailboxes[] = [
                'target_user_id' => null,
                'target_role' => 'dinas_pu',
                'title' => 'PTP Terbit (Penilaian PUTR)',
                'message' => "Pertimbangan Teknis Pertanahan (PTP) telah terbit dari BPN. Menunggu penilaian PKKPR.\n\n{$infoPemohon}",
                'link' => $url,
            ];
        }
        
        // 5. Penilaian PU Selesai -> Notifikasi ke DPMPTSP (Siap Terbit)
        if ($type === 'pu_selesai' && $adminPtsp && !$isBpnOnly) {
            $text = "Notifikasi DPMPTSP: {$layananTitle}{$no_berkas_text} Telah selesai di Verifikasi oleh Dinas PUTR. Silakan proses penerbitan {$dokumenFinalAdmin} di: {$url}";
            $text .= "\n\nWebsite Resmi: https://patenpakmiko.com/";
            $wa_links[] = [
                'target' => 'Admin DPMPTSP',
                'url' => 'https://wa.me/' . $formatPhone($adminPtsp) . '?text=' . urlencode($text)
            ];
            $mailboxes[] = [
                'target_user_id' => null,
                'target_role' => 'satu_pintu',
                'title' => 'Penilaian PUTR Selesai',
                'message' => "Telah selesai di Verifikasi oleh Dinas PUTR. Menunggu proses penerbitan {$dokumenFinalAdmin}.\n\n{$infoPemohon}",
                'link' => $url,
            ];

            // Auto Twilio Template Admin
            self::dispatchTwilioAdminTemplate($adminPtsp, 'twilio_tpl_admin_siap_terbit', [
                '1' => 'DPMPTSP Kota Sukabumi',
                '2' => $layananTitle,
                '3' => !empty($app->no_berkas) ? $app->no_berkas : '-',
                '4' => $url,
                '5' => $cpNumber,
            ]);
        }
        
        if ($type === 'pu_selesai' && $adminBpn) {
            $text = "Notifikasi Kantor Pertanahan Kota Sukabumi: {$layananTitle}{$no_berkas_text} Telah selesai di Verifikasi oleh Dinas PUTR. Menunggu penerbitan {$dokumenFinalAdmin} oleh DPMPTSP.";
            $text .= "\n\nWebsite Resmi: https://patenpakmiko.com/";
            $wa_links[] = [
                'target' => 'Admin BPN',
                'url' => 'https://wa.me/' . $formatPhone($adminBpn) . '?text=' . urlencode($text)
            ];
            $mailboxes[] = [
                'target_user_id' => null,
                'target_role' => 'bpn',
                'title' => 'Penilaian PUTR Selesai',
                'message' => "Telah selesai di Verifikasi oleh Dinas PUTR. Menunggu penerbitan {$dokumenFinalAdmin} oleh DPMPTSP.\n\n{$infoPemohon}",
                'link' => $url,
            ];
        }
        
        $isBpnPemohonOnly = (
            stripos($layananTitle, 'Kebijakan') !== false ||
            stripos($layananTitle, 'Tanah Timbul') !== false ||
            $app instanceof \App\Models\KebijakanApplication ||
            $app instanceof \App\Models\TanahTimbulApplication
        );

        if ($isBpnPemohonOnly) {
            $wa_links = array_values(array_filter($wa_links, function ($link) {
                $target = $link['target'] ?? '';
                return $target === 'Pemohon' || stripos($target, 'BPN') !== false;
            }));

            $mailboxes = array_values(array_filter($mailboxes, function ($box) {
                return $box['target_user_id'] !== null || ($box['target_role'] ?? '') === 'bpn';
            }));
        }

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

    public function getWhatsappSettings()
    {
        return self::getWhatsappSettingsStatic();
    }

    public static function getWhatsappSettingsStatic()
    {
        $settings = [];
        if (\Illuminate\Support\Facades\Storage::disk('local')->exists('whatsapp_settings.json')) {
            $settings = json_decode(\Illuminate\Support\Facades\Storage::disk('local')->get('whatsapp_settings.json'), true) ?? [];
        }
        if (empty($settings)) {
            $path = storage_path('app/whatsapp_settings.json');
            if (file_exists($path)) {
                $settings = json_decode(file_get_contents($path), true) ?? [];
            }
        }
        if (empty($settings)) {
            $settings = [
                'connected' => true,
                'fonnte_token' => '',
                'template' => "Halo {nama_pemohon}, permohonan Anda ({nomor_registrasi}) saat ini memasuki tahap: {status_sekarang}.\n\nCatatan: {catatan_terakhir}\n\nPantau di: {tautan_detail}",
            ];
            \Illuminate\Support\Facades\Storage::disk('local')->put('whatsapp_settings.json', json_encode($settings, JSON_PRETTY_PRINT));
            @file_put_contents(storage_path('app/whatsapp_settings.json'), json_encode($settings, JSON_PRETTY_PRINT));
        }
        return $settings;
    }
}

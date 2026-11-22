<?php

namespace App\Traits;

use App\Services\WhatsappService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

trait WaBlastHelper
{
    /**
     * Helper untuk mengenerate pesan WhatsApp Blast secara seragam untuk semua Modul.
     * Disesuaikan dengan template resmi Meta dan format terbaru.
     */
    public static function generateWaMessage(string $type, $app, string $layanan, string $url): ?string
    {
        $nama = $app->nama_pengaju ?: ($app->user->name ?? $app->user->username);
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
                return "Halo {$nama},\n\nPermohonan {$layanan}{$no_berkas_text} Anda dikembalikan (rollback) ke tahap *{$statusNama}* untuk dilakukan pemeriksaan/penyesuaian kembali.\n\nDetail permohonan: {$url}\n\nAbaikan Pesan Jika Anda Sudah Melewati Proses Ini.";
            })(),

            'submit', 'submit_berkas' =>
                "Halo {$nama},\n\nPermohonan *{$layanan}* Anda berhasil diajukan ke sistem *PATEN PAK MIKO* Kantor Pertanahan Kota Sukabumi.\n\nSaat ini berkas permohonan Anda sedang dalam proses verifikasi oleh petugas Kantor Pertanahan.\n\nPantau perkembangan berkas Anda melalui tautan:\n{$url}\n\nAbaikan Pesan Jika Anda Sudah Melewati Proses Ini.",

            'berkas_verifikasi' => (function() use ($app, $nama, $layanan, $no_berkas_text, $url) {
                if ($app->bpn_berkas_status === 'diterima') {
                    $spsLink = $url;
                    if (!empty($app->bpn_sps_document) && !($app instanceof \App\Models\PpkprBerusahaApplication)) {
                        $spsLink = route('file.view', ['path' => $app->bpn_sps_document]);
                    }
                    return "Halo {$nama},\n\nBerkas permohonan *{$layanan}* Anda telah diverifikasi dan dinyatakan *LENGKAP* oleh Kantor Pertanahan Kota Sukabumi.\n\nSilakan lakukan pembayaran biaya PNBP sesuai tagihan pada surat perintah store (SPS), pada link berikut:\n{$spsLink}\n\nAbaikan Pesan Jika Anda Sudah Melewati Proses Ini.";
                } else {
                    $settings = self::getWhatsappSettingsStatic();
                    $rawCp = !empty($settings['cp_admin']) ? $settings['cp_admin'] : ($settings['admin_bpn'] ?? '');
                    $cpContact = is_array($rawCp) ? ($rawCp[0] ?? '') : $rawCp;
                    $cpText = !empty($cpContact) ? " (Hubungi WA Admin BPN: {$cpContact})" : "";
                    return "Halo {$nama},\n\nBerkas permohonan *{$layanan}*{$no_berkas_text} Anda dinyatakan TIDAK LENGKAP oleh Kantor Pertanahan Kota Sukabumi.\nAlasan: \"{$app->bpn_notes}\"\n\nMohon siapkan perbaikan berkas sesuai arahan petugas atau hubungi admin Kantor Pertanahan Kota Sukabumi{$cpText}.\n\nSilakan klik link berikut untuk mengunggah ulang perbaikan berkas Anda:\n" . url('/revisi-berkas');
                }
            })(),

            'berkas_revisi_bpn' =>
                "Notifikasi Kantor Pertanahan Kota Sukabumi: Pelaku Usaha {$nama} telah mengunggah ulang berkas revisi/perbaikan untuk permohonan {$layanan}. Silakan cek & verifikasi ulang dokumen di: {$url}",

            'putr_notif_payment', 'putr_validasi' =>
                "Notifikasi Kantor Pertanahan Kota Sukabumi: Permohonan layanan {$layanan}{$no_berkas_text} atas nama {$nama} telah selesai divalidasi oleh Dinas PUTR. Silakan cek untuk memeriksa tagihan PNBP melalui email yang anda daftarkan pada sistem OSS.",

            'putr_tolak' =>
                "Halo {$nama},\n\nPermohonan {$layanan}{$no_berkas_text} Anda dinyatakan BELUM TERVALIDASI oleh Dinas PUTR.\nCatatan: {$app->putr_notes}\n\nDetail: {$url}",

            'credential_blast', 'credential' => (function() use ($app, $nama, $layanan, $url) {
                $ptpData  = json_decode($app->ptp_data, true) ?? [];
                $nik      = $ptpData['nik'] ?? '';
                $username = $app->user->username ?? '-';
                
                $passwordText = $nik ?: "(NIK pendaftaran Anda)";
                
                $msg = "Halo {$nama},\n\nPembayaran PNBP untuk {$layanan} Anda telah dikonfirmasi lunas.\n\n"
                     . "Akun login portal PATEN PAK MIKO Anda:\n"
                     . "Username : {$username}\n"
                     . "Password : {$passwordText}\n"
                     . "No. Berkas : {$app->no_berkas}\n\n"
                     . "Login dan pantau permohonan di: {$url}\n\n"
                     . "Abaikan Pesan Jika Anda Sudah Melewati Proses Ini.";
                
                return $msg;
            })(),

            'cek_lokasi' => (function() use ($app, $nama, $layanan) {
                $waktu = $app->bpn_cek_lokasi_date ?: ($app->bpn_cek_lokasi_dt ? Carbon::parse($app->bpn_cek_lokasi_dt)->locale('id')->translatedFormat('l, d F Y \J\a\m H:i \W\I\B') : '-');
                $cpLapang = !empty($app->bpn_cek_lokasi_cp) ? $app->bpn_cek_lokasi_cp : '-';
                return "Halo {$nama},\n\nPermohonan *{$layanan}* Anda di Kantor Pertanahan Kota Sukabumi telah dijadwalkan untuk peninjauan lapangan pada:\n\n*Jadwal Lapangan:*\n{$waktu}\n\nHarap siapkan berkas fisik persyaratan pertimbangan teknis pertanahan dalam format kertas F4 untuk disampaikan ketika petugas ke lapangan. Untuk kesediaan dan kehadiran Anda dapat menghubungi Petugas Lapang di nomor {$cpLapang}.\n\nAbaikan Pesan Jika Anda Sudah Melewati Proses Ini.";
            })(),

            'cek_lokasi_ubah' => (function() use ($app, $nama, $layanan) {
                $jadwalBaru = $app->bpn_cek_lokasi_date ?: '-';
                $cpLapang = !empty($app->bpn_cek_lokasi_cp) ? $app->bpn_cek_lokasi_cp : '-';
                return "Halo {$nama},\n\n[PERUBAHAN JADWAL] Peninjauan lapangan *{$layanan}* diubah.\n\nJadwal Baru:\n{$jadwalBaru}\n\nHarap siapkan berkas fisik persyaratan dalam format kertas F4. Hubungi Petugas Lapang di nomor {$cpLapang}.\n\nAbaikan Pesan Jika Anda Sudah Melewati Proses Ini.";
            })(),

            'rapat' => (function() use ($app, $nama, $layanan, $no_berkas_text) {
                $waktu = $app->bpn_rapat_date ?: ($app->bpn_rapat_dt ? Carbon::parse($app->bpn_rapat_dt)->locale('id')->translatedFormat('l, d F Y \J\a\m H:i \W\I\B') : '-');
                return "Halo {$nama},\n\nRapat pembahasan pertimbangan teknis pertanahan untuk permohonan {$layanan}{$no_berkas_text} dijadwalkan pada:\n\nWaktu: {$waktu}\n\nAbaikan Pesan Jika Anda Sudah Melewati Proses Ini.";
            })(),

            'rapat_ubah' =>
                "Halo {$nama},\n\n[PERUBAHAN] Jadwal rapat {$layanan}{$no_berkas_text} diubah menjadi: {$app->bpn_rapat_date}.\n\nAbaikan Pesan Jika Anda Sudah Melewati Proses Ini.",

            'pertek_terbit' =>
                "Halo {$nama},\n\nKabar baik! Seluruh proses permohonan *{$layanan}* Anda telah selesai dan dokumen Pertimbangan Teknis Pertanahan telah *DITERBITKAN* oleh Kantor Pertanahan Kota Sukabumi.\n\nSilakan unduh atau cetak dokumen perizinan Anda melalui tautan portal resmi, selanjutnya akan dilakukan penilaian PKKPR oleh dinas PUTR Kota Sukabumi:\n{$url}\n\nBantu kami meningkatkan kualitas pelayanan dengan memberikan ulasan di " . url('/lapolpa'),

            'pertek_tolak' =>
                "Halo {$nama},\n\nPermohonan {$layanan}{$no_berkas_text} DITOLAK oleh Kantor Pertanahan Kota Sukabumi pada tahap Pertimbangan Teknis Pertanahan.\nCatatan: {$app->bpn_notes}\n\nDetail: {$url}",

            'pu_selesai' =>
                "Notifikasi DPMPTSP: Berkas permohonan {$layanan}{$no_berkas_text} telah selesai dilakukan penilaian PKKPR oleh Dinas PUTR. Silakan login dan proses penerbitan dokumen PKKPR melalui tautan {$url}",

            'pu_tolak' =>
                "Halo {$nama},\n\nPermohonan {$layanan}{$no_berkas_text} DITOLAK oleh Dinas PUTR.\nCatatan: {$app->dinas_pu_notes}\n\nDetail: {$url}",

            'pkkpr_terbit' => (function() use ($app, $nama, $no_berkas_text, $url) {
                $noBerkasClean = !empty($app->no_berkas) ? $app->no_berkas : '-';
                return "Halo {$nama},\n\nKabar baik! dokumen PKKPR dengan nomor berkas *{$noBerkasClean}* Anda telah selesai *DITERBITKAN* oleh Dinas Penanaman Modal Pelayanan Terpadu Satu Pintu (DPMPTSP) Kota Sukabumi.\n\nSilakan unduh atau cetak dokumen perizinan Anda melalui tautan portal:\n{$url}\n\nBantu kami meningkatkan kualitas pelayanan dengan memberikan ulasan di " . url('/lapolpa');
            })(),

            'pkkpr_tolak' =>
                "Halo {$nama},\n\nPermohonan {$layanan}{$no_berkas_text} DITOLAK oleh DPMPTSP.\nCatatan: {$app->satu_pintu_notes}\n\nDetail: {$url}",

            default => null,
        };
    }

    /**
     * Helper untuk mengeksekusi pengiriman Twilio Template resmi Meta secara aman (graceful).
     */
    public static function dispatchTwilioAdminTemplate(string $phone, string $templateKey, array $variables): void
    {
        try {
            $defaultSids = [
                'twilio_tpl_admin_pengajuan_baru'      => 'HXeccac524892a91f01dcd527587d15e31',
                'twilio_tpl_admin_berkas_revisi'       => 'HXad0b9226baeee84b83f570b3e593ac23',
                'twilio_tpl_admin_validasi_putr'       => 'HXdc99ecf35094b0b6592e1b96c352b397',
                'twilio_tpl_admin_putr_selesai'        => 'HX53a265e1ec89801d42a1f8b976dc04a4',
                'twilio_tpl_admin_siap_terbit'         => 'HX78a8512b2ea6fece5ce30354252b019c',
                'twilio_tpl_pemohon_pengajuan_masuk'   => 'HXe91d3b5a333f8306333da1a6b3b2eaea',
                'twilio_tpl_pemohon_berkas_lengkap'    => 'HXd4cf0f70cc390af6ab97098d97e74e26',
                'twilio_tpl_pemohon_berkas_revisi'     => 'HX160b664130c735c3a1248c74da06d8b1',
                'twilio_tpl_pemohon_pnbp_lunas'        => 'HX2e8ed627c7fa242d5a6003da25ea1741',
                'twilio_tpl_pemohon_jadwal_lokasi'     => 'HX684c771751cd781ffab92bbbb376eb57',
                'twilio_tpl_pemohon_jadwal_rapat'      => 'HXdde8c3f0e34351b71406cc00dfd39962',
                'twilio_tpl_pemohon_dokumen_terbit'    => 'HXf35e5e6fcd396a7f459fff381ba5f758',
                'twilio_tpl_pemohon_pkkpr_terbit'      => 'HXbf46daa68dfe5857b1b573e169bd49f6',
                'twilio_tpl_pemohon_informasi_layanan' => 'HX7e4005d5350a49c703d8c61f8cde8cc3',
            ];

            $settings = self::getWhatsappSettingsStatic();
            $templateSid = $settings[$templateKey] ?? ($defaultSids[$templateKey] ?? env(strtoupper($templateKey), ''));
            
            if (!empty($templateSid) && !empty($phone)) {
                $waService = app(WhatsappService::class);
                $waService->sendTemplateMessage($phone, $templateSid, $variables);
            }
        } catch (\Throwable $e) {
            Log::warning("[WaBlastHelper] Gagal dispatch Twilio Admin Template ({$templateKey}): " . $e->getMessage());
        }
    }

    /**
     * Helper otomatis blasting WhatsApp ke Pemohon menggunakan Twilio Template Resmi Meta.
     */
    public static function dispatchTwilioPemohonTemplate(string $phone, string $type, $app, string $layananTitle, string $url, string $cpNumber, ?string $customMsg = null): void
    {
        if (empty($phone)) {
            return;
        }

        $nama = $app->nama_pengaju ?: ($app->user->name ?? ($app->user->username ?? 'Pemohon'));
        $cpContact = !empty($cpNumber) ? $cpNumber : '085724455503';

        try {
            // Jika ada pesan kustom khusus, gunakan template dinamis pemohon_informasi_layanan
            if (!empty($customMsg)) {
                $customClean = trim(preg_replace('/\s+/', ' ', $customMsg));
                self::dispatchTwilioAdminTemplate($phone, 'twilio_tpl_pemohon_informasi_layanan', [
                    '1' => $nama,
                    '2' => $layananTitle,
                    '3' => $customClean,
                    '4' => $url,
                    '5' => $cpContact,
                ]);
                return;
            }

            switch ($type) {
                case 'submit':
                case 'submit_berkas':
                    // pemohon_pengajuan_masuk
                    self::dispatchTwilioAdminTemplate($phone, 'twilio_tpl_pemohon_pengajuan_masuk', [
                        '1' => $nama,
                        '2' => $layananTitle,
                        '3' => $url,
                        '4' => $cpContact,
                    ]);
                    break;

                case 'berkas_verifikasi':
                    if ($app->bpn_berkas_status === 'diterima') {
                        // pemohon_berkas_lengkap (Link Dokumen SPS untuk selain Berusaha)
                        $linkTagihan = $url;
                        if (!($app instanceof \App\Models\PpkprBerusahaApplication) && !empty($app->bpn_sps_document)) {
                            $linkTagihan = route('file.view', ['path' => $app->bpn_sps_document]);
                        }
                        self::dispatchTwilioAdminTemplate($phone, 'twilio_tpl_pemohon_berkas_lengkap', [
                            '1' => $nama,
                            '2' => $layananTitle,
                            '3' => $linkTagihan,
                            '4' => $cpContact,
                        ]);
                    } else {
                        // pemohon_berkas_revisi
                        $notes = !empty($app->bpn_notes) ? $app->bpn_notes : 'Mohon lengkapi dan perbaiki dokumen persyaratan Anda.';
                        $notesClean = trim(preg_replace('/\s+/', ' ', $notes));
                        self::dispatchTwilioAdminTemplate($phone, 'twilio_tpl_pemohon_berkas_revisi', [
                            '1' => $nama,
                            '2' => $layananTitle,
                            '3' => $notesClean,
                            '4' => url('/revisi-berkas'),
                            '5' => $cpContact,
                        ]);
                    }
                    break;

                case 'credential':
                case 'credential_blast':
                    // Kirim Kredensial Akun & No. Berkas menggunakan template dinamis pemohon_informasi_layanan
                    $noBerkas = !empty($app->no_berkas) ? $app->no_berkas : '-';
                    $ptpData  = json_decode($app->ptp_data, true) ?? [];
                    $nik      = $ptpData['nik'] ?? '';
                    $username = $app->user->username ?? ($app->user->name ?? '-');

                    $isPasswordNik = false;
                    if ($nik && !empty($app->user->password) && \Illuminate\Support\Facades\Hash::check($nik, $app->user->password)) {
                        $isPasswordNik = true;
                    }
                    $passwordText = $isPasswordNik ? $nik : 'Gunakan NIK Anda';

                    $rincianAkun = "No. Berkas: {$noBerkas} | Username: {$username} | Sandi: {$passwordText} | Status: Akun Aktif";

                    self::dispatchTwilioAdminTemplate($phone, 'twilio_tpl_pemohon_informasi_layanan', [
                        '1' => $nama,
                        '2' => 'Konfirmasi Pembayaran PNBP & Akun Login',
                        '3' => $rincianAkun,
                        '4' => 'https://patenpakmiko.com/login',
                        '5' => $cpContact,
                    ]);
                    break;

                case 'cek_lokasi':
                case 'cek_lokasi_ubah':
                    // pemohon_jadwal_lokasi (Peninjauan Lapangan F4)
                    $waktu = $app->bpn_cek_lokasi_date ?: ($app->bpn_cek_lokasi_dt ? \Carbon\Carbon::parse($app->bpn_cek_lokasi_dt)->locale('id')->translatedFormat('l, d F Y Jam H:i WIB') : '-');
                    $cpLapang = !empty($app->bpn_cek_lokasi_cp) ? $app->bpn_cek_lokasi_cp : $cpContact;
                    self::dispatchTwilioAdminTemplate($phone, 'twilio_tpl_pemohon_jadwal_lokasi', [
                        '1' => $nama,
                        '2' => $layananTitle,
                        '3' => $waktu,
                        '4' => $cpLapang,
                        '5' => $cpContact,
                    ]);
                    break;

                case 'rapat':
                case 'rapat_ubah':
                    // pemohon_jadwal_rapat
                    $waktuRapat = $app->bpn_rapat_date ?: ($app->bpn_rapat_dt ? \Carbon\Carbon::parse($app->bpn_rapat_dt)->locale('id')->translatedFormat('l, d F Y Jam H:i WIB') : '-');
                    self::dispatchTwilioAdminTemplate($phone, 'twilio_tpl_pemohon_jadwal_rapat', [
                        '1' => $nama,
                        '2' => $layananTitle,
                        '3' => $waktuRapat,
                        '4' => $url,
                        '5' => $cpContact,
                    ]);
                    break;

                case 'pertek_terbit':
                    // pemohon_dokumen_terbit (Dokumen PTP BPN Selesai Diterbitkan)
                    self::dispatchTwilioAdminTemplate($phone, 'twilio_tpl_pemohon_dokumen_terbit', [
                        '1' => $nama,
                        '2' => $layananTitle,
                        '3' => $url,
                        '4' => 'https://patenpakmiko.com/lapolpa',
                        '5' => $cpContact,
                    ]);
                    break;

                case 'pkkpr_terbit':
                    // pemohon_pkkpr_terbit (Dokumen PKKPR DPMPTSP Selesai Diterbitkan)
                    $noBerkasFinal = !empty($app->no_berkas) ? $app->no_berkas : $layananTitle;
                    self::dispatchTwilioAdminTemplate($phone, 'twilio_tpl_pemohon_pkkpr_terbit', [
                        '1' => $nama,
                        '2' => $noBerkasFinal,
                        '3' => $url,
                        '4' => 'https://patenpakmiko.com/lapolpa',
                        '5' => $cpContact,
                    ]);
                    break;
            }
        } catch (\Throwable $e) {
            Log::warning("[WaBlastHelper] Gagal dispatch Twilio Pemohon Template ({$type}): " . $e->getMessage());
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
        
        // Deteksi nomor telepon pemohon dengan fallback cerdas ke ptp_data / no_hp_pengaju
        $ptpData = json_decode($app->ptp_data, true) ?? [];
        $pemohon = !empty($app->user->phone_number) 
            ? $app->user->phone_number 
            : ($ptpData['no_hp'] ?? ($ptpData['telepon'] ?? ($ptpData['no_telp'] ?? ($app->no_hp_pengaju ?? ''))));

        $wa_links = [];
        $mailboxes = [];

        $formatPhone = function($phone) {
            $phone = preg_replace('/[^0-9]/', '', $phone);
            if (str_starts_with($phone, '0')) {
                $phone = '62' . substr($phone, 1);
            }
            return $phone;
        };

        $rawCp = !empty($settings['cp_admin']) ? $settings['cp_admin'] : ($settings['admin_bpn'] ?? '083861669565');
        $cpNumber = is_array($rawCp) ? ($rawCp[0] ?? '083861669565') : $rawCp;

        if ($msg && $pemohon) {
            $postPnbpTypes = [
                'cek_lokasi', 'cek_lokasi_ubah', 'rapat', 'rapat_ubah',
                'pertek_terbit', 'pertek_tolak', 'pu_selesai', 'pu_tolak',
                'pkkpr_terbit', 'pkkpr_tolak'
            ];

            if (in_array($type, $postPnbpTypes)) {
                $nik      = $ptpData['nik'] ?? '';
                $username = $app->user->username ?? '-';
                
                $isPasswordNik = false;
                if ($nik && !empty($app->user->password) && \Illuminate\Support\Facades\Hash::check($nik, $app->user->password)) {
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

            // Auto Twilio Template Pemohon (WhatsApp Business Resmi)
            self::dispatchTwilioPemohonTemplate($pemohon, $type, $app, $layananTitle, $url, $cpNumber, $customMsg);
        }

        $no_berkas_text = !empty($app->no_berkas) ? " (No. Berkas: {$app->no_berkas})" : "";
        $nama = $app->nama_pengaju ?: ($app->user->name ?? ($app->user->username ?? ''));
        
        $adminBpnList = self::normalizePhoneList($settings['admin_bpn'] ?? []);
        $adminPutrList = self::normalizePhoneList($settings['admin_putr'] ?? ($settings['admin_dinas_pu'] ?? []));
        $adminPtspList = self::normalizePhoneList($settings['admin_satu_pintu'] ?? []);

        $infoPemohon = "Pemohon: {$nama}\nLayanan: {$layananTitle}";
        if (!empty($app->no_berkas)) {
            $infoPemohon .= "\nNo. Berkas: {$app->no_berkas}";
        }

        $dokumenFinalAdmin = (stripos($layananTitle, 'PPKPR') !== false || stripos($layananTitle, 'PKKPR') !== false) 
                             ? str_replace('PPKPR', 'PKKPR', $layananTitle) 
                             : "Dokumen {$layananTitle}";

        // 1. Pengajuan Baru Masuk -> Notifikasi ke Admin BPN
        if (($type === 'submit' || $type === 'submit_berkas') && !empty($adminBpnList)) {
            $text = "Halo Admin Kantor Pertanahan Kota Sukabumi, ada pengajuan permohonan baru untuk {$layananTitle} atas nama {$nama}. Silakan login untuk melakukan verifikasi berkas awal di: {$url}";
            $text .= "\n\nWebsite Resmi: https://patenpakmiko.com/";
            foreach ($adminBpnList as $bpnPhone) {
                $wa_links[] = [
                    'target' => 'Admin BPN (' . $bpnPhone . ')',
                    'url' => 'https://wa.me/' . $formatPhone($bpnPhone) . '?text=' . urlencode($text)
                ];
                // Auto Twilio Template Admin
                self::dispatchTwilioAdminTemplate($bpnPhone, 'twilio_tpl_admin_pengajuan_baru', [
                    '1' => 'Kota Sukabumi',
                    '2' => $layananTitle,
                    '3' => $nama,
                    '4' => $url,
                    '5' => $cpNumber,
                ]);
            }
            $mailboxes[] = [
                'target_user_id' => null,
                'target_role' => 'bpn',
                'title' => 'Pengajuan Baru Masuk',
                'message' => "Ada pengajuan permohonan baru yang memerlukan verifikasi berkas awal.\n\n{$infoPemohon}",
                'link' => $url,
            ];
        }

        // 2. Berkas Revisi Diunggah Pemohon -> Notifikasi ke Admin BPN
        if ($type === 'berkas_revisi_bpn' && !empty($adminBpnList)) {
            $text = "Notifikasi Kantor Pertanahan Kota Sukabumi: Pelaku Usaha {$nama} telah mengunggah ulang berkas revisi/perbaikan untuk permohonan {$layananTitle}. Silakan cek dan verifikasi ulang dokumen di: {$url}";
            $text .= "\n\nWebsite Resmi: https://patenpakmiko.com/";
            foreach ($adminBpnList as $bpnPhone) {
                $wa_links[] = [
                    'target' => 'Admin BPN (' . $bpnPhone . ')',
                    'url' => 'https://wa.me/' . $formatPhone($bpnPhone) . '?text=' . urlencode($text)
                ];
                // Auto Twilio Template Admin (Approved)
                self::dispatchTwilioAdminTemplate($bpnPhone, 'twilio_tpl_admin_berkas_revisi', [
                    '1' => 'Kota Sukabumi',
                    '2' => $nama,
                    '3' => $layananTitle,
                    '4' => $url,
                    '5' => $cpNumber,
                ]);
            }
            $mailboxes[] = [
                'target_user_id' => null,
                'target_role' => 'bpn',
                'title' => 'Berkas Revisi Diunggah',
                'message' => "Pelaku Usaha telah mengunggah ulang berkas revisi/perbaikan. Silakan cek dan verifikasi ulang.\n\n{$infoPemohon}",
                'link' => $url,
            ];
        }

        // Layanan yang melibatkan Validasi Awal PUTR (Hanya Berusaha & PSN)
        $isPutrAwal = ($app instanceof \App\Models\PpkprBerusahaApplication || $app instanceof \App\Models\PsnApplication || stripos($layananTitle, 'Berusaha') !== false || stripos($layananTitle, 'PSN') !== false);

        // 3. Berkas Diterima BPN -> Validasi Tata Ruang Awal Masuk ke PUTR (Khusus Berusaha & PSN)
        if ($type === 'berkas_verifikasi' && $app->bpn_berkas_status === 'diterima' && !empty($adminPutrList) && $isPutrAwal) {
            $text = "Notifikasi Dinas PUTR: Berkas permohonan {$no_berkas_text} atas nama {$nama} telah selesai diverifikasi oleh Kantor Pertanahan Kota Sukabumi. Silakan lakukan Validasi Oleh Dinas PUTR di: {$url}";
            $text .= "\n\nWebsite Resmi: https://patenpakmiko.com/";
            foreach ($adminPutrList as $putrPhone) {
                $wa_links[] = [
                    'target' => 'Admin PUTR (' . $putrPhone . ')',
                    'url' => 'https://wa.me/' . $formatPhone($putrPhone) . '?text=' . urlencode($text)
                ];
                // Auto Twilio Template Admin
                self::dispatchTwilioAdminTemplate($putrPhone, 'twilio_tpl_admin_validasi_putr', [
                    '1' => 'PUTR Kota Sukabumi',
                    '2' => !empty($app->no_berkas) ? $app->no_berkas : $layananTitle,
                    '3' => $nama,
                    '4' => $url,
                    '5' => $cpNumber,
                ]);
            }
            $mailboxes[] = [
                'target_user_id' => null,
                'target_role' => 'dinas_pu',
                'title' => 'Berkas Masuk PUTR',
                'message' => "Berkas permohonan telah selesai divalidasi awal oleh BPN. Menunggu Validasi Awal Tata Ruang.\n\n{$infoPemohon}",
                'link' => $url,
            ];
        }
        
        // 4. Validasi PUTR Selesai -> Notifikasi ke BPN (Siap Tagihan PNBP OSS)
        if ($type === 'putr_validasi' && !empty($adminBpnList)) {
            $text = "Notifikasi Dinas PUTR: Berkas permohonan {$layananTitle}{$no_berkas_text} atas nama {$nama} telah selesai divalidasi oleh Dinas PUTR. Silakan cek untuk memeriksa tagihan PNBP melalui email yang anda daftarkan pada sistem OSS di: {$url}";
            $text .= "\n\nWebsite Resmi: https://patenpakmiko.com/";
            
            $linkTagihanAdmin = $url;
            if (!($app instanceof \App\Models\PpkprBerusahaApplication) && !empty($app->bpn_sps_document)) {
                $linkTagihanAdmin = route('file.view', ['path' => $app->bpn_sps_document]);
            }

            foreach ($adminBpnList as $bpnPhone) {
                $wa_links[] = [
                    'target' => 'Admin BPN (' . $bpnPhone . ')',
                    'url' => 'https://wa.me/' . $formatPhone($bpnPhone) . '?text=' . urlencode($text)
                ];
                // Auto Twilio Template Admin
                self::dispatchTwilioAdminTemplate($bpnPhone, 'twilio_tpl_admin_putr_selesai', [
                    '1' => 'Kantor Pertanahan Kota Sukabumi',
                    '2' => $layananTitle,
                    '3' => !empty($app->no_berkas) ? $app->no_berkas : '-',
                    '4' => $nama,
                    '5' => $linkTagihanAdmin,
                    '6' => $cpNumber,
                ]);
            }
            $mailboxes[] = [
                'target_user_id' => null,
                'target_role' => 'bpn',
                'title' => 'Validasi PUTR Selesai',
                'message' => "Permohonan telah divalidasi tata ruangnya oleh PUTR. Silakan buat pendaftaran / tagihan PNBP.\n\n{$infoPemohon}",
                'link' => $url,
            ];
        }

        // 5. Dokumen Final PKKPR Terbit -> Notifikasi ke Admin BPN
        if ($type === 'pkkpr_terbit') {
            if (!empty($adminBpnList)) {
                $text = "Notifikasi DPMPTSP: {$dokumenFinalAdmin}{$no_berkas_text} atas nama {$nama} telah diterbitkan. Proses permohonan selesai. Cek di: {$url}";
                $text .= "\n\nWebsite Resmi: https://patenpakmiko.com/";
                $noBerkasAdmin = !empty($app->no_berkas) ? $app->no_berkas : $layananTitle;
                foreach ($adminBpnList as $bpnPhone) {
                    $wa_links[] = [
                        'target' => 'Admin BPN (' . $bpnPhone . ')',
                        'url' => 'https://wa.me/' . $formatPhone($bpnPhone) . '?text=' . urlencode($text)
                    ];
                    // Auto Twilio Template
                    self::dispatchTwilioAdminTemplate($bpnPhone, 'twilio_tpl_pemohon_pkkpr_terbit', [
                        '1' => 'Kantor Pertanahan Kota Sukabumi',
                        '2' => $noBerkasAdmin,
                        '3' => $url,
                        '4' => 'https://patenpakmiko.com/lapolpa',
                        '5' => $cpNumber,
                    ]);
                }
                $mailboxes[] = [
                    'target_user_id' => null,
                    'target_role' => 'bpn',
                    'title' => 'Dokumen Diterbitkan',
                    'message' => "{$dokumenFinalAdmin} telah diterbitkan oleh DPMPTSP. Proses permohonan selesai.\n\n{$infoPemohon}",
                    'link' => $url,
                ];
            }
        }

        $isBpnOnly = ($app instanceof \App\Models\KebijakanApplication 
            || $app instanceof \App\Models\TanahTimbulApplication 
            || stripos($layananTitle, 'Kebijakan') !== false 
            || stripos($layananTitle, 'Tanah Timbul') !== false);

        // 6. Dokumen PTP Terbit dari BPN -> Notifikasi ke Admin Dinas PUTR (untuk penilaian PKKPR)
        if ($type === 'pertek_terbit' && !empty($adminPutrList) && !$isBpnOnly) {
            $text = "Notifikasi Dinas PUTR: Pertimbangan Teknis Pertanahan (PTP) untuk {$layananTitle}{$no_berkas_text} telah terbit dari Kantor Pertanahan Kota Sukabumi. Silakan lakukan penilaian PKKPR di: {$url}";
            $text .= "\n\nWebsite Resmi: https://patenpakmiko.com/";
            foreach ($adminPutrList as $putrPhone) {
                $wa_links[] = [
                    'target' => 'Admin PUTR (' . $putrPhone . ')',
                    'url' => 'https://wa.me/' . $formatPhone($putrPhone) . '?text=' . urlencode($text)
                ];
            }
            $mailboxes[] = [
                'target_user_id' => null,
                'target_role' => 'dinas_pu',
                'title' => 'PTP Terbit (Penilaian PUTR)',
                'message' => "Pertimbangan Teknis Pertanahan (PTP) telah terbit dari BPN. Menunggu penilaian PKKPR.\n\n{$infoPemohon}",
                'link' => $url,
            ];
        }
        
        // 7. Penilaian PUTR Selesai -> Notifikasi ke DPMPTSP (Siap Terbit PKKPR)
        if ($type === 'pu_selesai' && !empty($adminPtspList) && !$isBpnOnly) {
            $text = "Notifikasi DPMPTSP: Berkas permohonan {$layananTitle}{$no_berkas_text} telah selesai dilakukan penilaian PKKPR oleh Dinas PUTR. Silakan proses penerbitan dokumen PKKPR di: {$url}";
            $text .= "\n\nWebsite Resmi: https://patenpakmiko.com/";
            foreach ($adminPtspList as $ptspPhone) {
                $wa_links[] = [
                    'target' => 'Admin DPMPTSP (' . $ptspPhone . ')',
                    'url' => 'https://wa.me/' . $formatPhone($ptspPhone) . '?text=' . urlencode($text)
                ];
                // Auto Twilio Template Admin
                self::dispatchTwilioAdminTemplate($ptspPhone, 'twilio_tpl_admin_siap_terbit', [
                    '1' => 'DPMPTSP Kota Sukabumi',
                    '2' => $layananTitle,
                    '3' => !empty($app->no_berkas) ? $app->no_berkas : '-',
                    '4' => $url,
                    '5' => $cpNumber,
                ]);
            }
            $mailboxes[] = [
                'target_user_id' => null,
                'target_role' => 'satu_pintu',
                'title' => 'Penilaian PUTR Selesai',
                'message' => "Telah selesai di Verifikasi oleh Dinas PUTR. Menunggu proses penerbitan {$dokumenFinalAdmin}.\n\n{$infoPemohon}",
                'link' => $url,
            ];
        }
        
        if ($type === 'pu_selesai' && !empty($adminBpnList)) {
            $text = "Notifikasi Kantor Pertanahan Kota Sukabumi: {$layananTitle}{$no_berkas_text} Telah selesai di Verifikasi oleh Dinas PUTR. Menunggu penerbitan {$dokumenFinalAdmin} oleh DPMPTSP.";
            $text .= "\n\nWebsite Resmi: https://patenpakmiko.com/";
            foreach ($adminBpnList as $bpnPhone) {
                $wa_links[] = [
                    'target' => 'Admin BPN (' . $bpnPhone . ')',
                    'url' => 'https://wa.me/' . $formatPhone($bpnPhone) . '?text=' . urlencode($text)
                ];
            }
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

    public static function normalizePhoneList($val): array
    {
        if (is_array($val)) {
            return array_values(array_filter(array_map('trim', $val), function($item) {
                return $item !== '' && $item !== null;
            }));
        }
        if (is_string($val) && trim($val) !== '') {
            $parts = preg_split('/[\r\n,;]+/', trim($val));
            return array_values(array_filter(array_map('trim', $parts), function($item) {
                return $item !== '' && $item !== null;
            }));
        }
        return [];
    }
}

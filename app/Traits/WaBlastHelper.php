<?php

namespace App\Traits;

use Carbon\Carbon;

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
            'submit', 'submit_berkas' =>
                "Halo {$nama}, permohonan {$layanan} Anda berhasil diajukan.\n\nBerkas Anda sedang dalam verifikasi awal Kantor Pertanahan Kota Sukabumi. Kami akan mengirimkan pembaruan status selanjutnya melalui WhatsApp.",

            'berkas_verifikasi' => $app->bpn_berkas_status === 'diterima'
                ? "Halo {$nama}, berkas {$layanan} Anda dinyatakan LENGKAP oleh Kantor Pertanahan Kota Sukabumi. Permohonan diteruskan ke Dinas PUTR untuk validasi pembayaran. Kami akan menghubungi Anda kembali."
                : "Halo {$nama}, berkas {$layanan} Anda dinyatakan TIDAK LENGKAP oleh Kantor Pertanahan Kota Sukabumi.\nAlasan: \"{$app->bpn_notes}\"\n\nMohon siapkan perbaikan berkas sesuai arahan petugas atau hubungi admin Kantor Pertanahan Kota Sukabumi.\n\nSilakan klik link berikut untuk mengunggah ulang perbaikan berkas Anda:\n" . url('/revisi-berkas'),

            'berkas_revisi_bpn' =>
                "Notifikasi Kantor Pertanahan Kota Sukabumi: Pelaku Usaha {$nama} telah mengunggah ulang berkas revisi/perbaikan untuk permohonan {$layanan}. Silakan cek & verifikasi ulang dokumen di: {$url}",

            'putr_notif_payment', 'putr_validasi' =>
                "Halo {$nama}, permohonan {$layanan} Anda dinyatakan TERVALIDASI oleh Dinas PUTR.\n\nSilakan cek instruksi pembayaran PNBP. Jika pembayaran sudah diselesaikan, Anda akan menerima detail Akun.",

            'putr_tolak' =>
                "Halo {$nama}, permohonan {$layanan} Anda dinyatakan BELUM TERVALIDASI oleh Dinas PUTR.\nCatatan: {$app->putr_notes}\n\nDetail: {$url}",

            'credential_blast', 'credential' => (function() use ($app, $nama, $layanan, $url) {
                $ptpData  = json_decode($app->ptp_data, true) ?? [];
                $nik      = $ptpData['nik'] ?? '';
                $username = $app->user->username ?? '-';
                $password = $nik ?: 'NIK Anda';
                return "Halo {$nama}, pembayaran {$layanan} Anda telah dikonfirmasi.\n\n"
                     . "Akun login portal PATEN PAK MIKO Anda:\n"
                     . "Username : {$username}\n"
                     . "Password : {$password}\n"
                     . "No. Berkas : {$app->no_berkas}\n\n"
                     . "Login dan pantau permohonan di: {$url}";
            })(),

            'cek_lokasi' => (function() use ($app, $nama, $layanan, $no_berkas_text) {
                $waktu = $app->bpn_cek_lokasi_date ?: ($app->bpn_cek_lokasi_dt ? Carbon::parse($app->bpn_cek_lokasi_dt)->locale('id')->translatedFormat('l, d F Y \J\a\m H:i \W\I\B') : '-');
                return "Halo {$nama}, permohonan {$layanan} Anda{$no_berkas_text} dijadwalkan untuk peninjauan lapangan pada:\n\n"
                     . "Waktu: {$waktu}\n"
                     . "CP Lapangan/Admin: (atas nama) {$app->bpn_cek_lokasi_cp}\n\n"
                     . "Harap konfirmasi kesediaan anda dengan menghubungi CP di atas.";
            })(),

            'cek_lokasi_ubah' =>
                "Halo {$nama}, [PERUBAHAN JADWAL] Peninjauan lapangan {$layanan}{$no_berkas_text} diubah.\n\nJadwal Baru: {$app->bpn_cek_lokasi_date}\nCP Petugas: {$app->bpn_cek_lokasi_cp}",

            'rapat' => (function() use ($app, $nama, $layanan, $no_berkas_text) {
                $waktu = $app->bpn_rapat_date ?: ($app->bpn_rapat_dt ? Carbon::parse($app->bpn_rapat_dt)->locale('id')->translatedFormat('l, d F Y \J\a\m H:i \W\I\B') : '-');
                return "Halo {$nama}, rapat pembahasan pertimbangan teknis pertanahan untuk permohonan {$layanan}{$no_berkas_text} dijadwalkan pada:\n\n"
                     . "Waktu: {$waktu}";
            })(),

            'rapat_ubah' =>
                "Halo {$nama}, [PERUBAHAN] Jadwal rapat {$layanan}{$no_berkas_text} diubah menjadi: {$app->bpn_rapat_date}.",

            'pertek_terbit' =>
                "Halo {$nama}, Pertimbangan Teknis Pertanahan untuk permohonan {$layanan}{$no_berkas_text} telah DITERBITKAN oleh Kantor Pertanahan Kota Sukabumi. Proses selanjutnya di Dinas Pekerjaan Umum (PUTR) untuk dilakukan penilaian.",

            'pertek_tolak' =>
                "Halo {$nama}, permohonan {$layanan}{$no_berkas_text} DITOLAK oleh Kantor Pertanahan Kota Sukabumi pada tahap Pertek.\nCatatan: {$app->bpn_notes}\n\nDetail: {$url}",

            'pu_selesai' =>
                "Halo {$nama}, penilaian {$layanan}{$no_berkas_text} oleh Dinas PUTR telah selesai dilakukan. Selanjutnya permohonan diteruskan ke Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) Kota Sukabumi untuk dilakukan penerbitan {$dokumenFinal}. Pantau di: {$url}",

            'pu_tolak' =>
                "Halo {$nama}, permohonan {$layanan}{$no_berkas_text} DITOLAK oleh Dinas PUTR.\nCatatan: {$app->dinas_pu_notes}\n\nDetail: {$url}",

            'pkkpr_terbit' =>
                "Halo {$nama}, Permohonan {$layanan} Anda{$no_berkas_text} telah diterbitkan oleh Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) Kota Sukabumi.\n\n"
              . "Selanjutnya Anda dapat mencetak {$dokumenFinal} pada Aplikasi OSS atau Website PATEN PAK MIKO dengan link sebagai berikut:\n{$url}",

            'pkkpr_tolak' =>
                "Halo {$nama}, permohonan {$layanan}{$no_berkas_text} DITOLAK oleh DPMPTSP.\nCatatan: {$app->satu_pintu_notes}\n\nDetail: {$url}",

            default => null,
        };
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

        if ($msg && $pemohon) {
            if (!empty($settings['cp_admin'])) {
                $msg .= "\n\n_Jika ada pertanyaan, hubungi CP Admin: " . $settings['cp_admin'] . "_";
            }
            $wa_links[] = [
                'target' => 'Pemohon',
                'url' => 'https://wa.me/' . $formatPhone($pemohon) . '?text=' . urlencode($msg)
            ];
            $mailboxes[] = [
                'target_user_id' => $app->user_id,
                'target_role' => null,
                'title' => 'Notifikasi Pemohon - ' . $layananTitle,
                'message' => $msg,
                'link' => $url,
            ];
        }

        $no_berkas_text = !empty($app->no_berkas) ? " (No. Berkas: {$app->no_berkas})" : "";
        $nama = $app->nama_pengaju ?: ($app->user->name ?? ($app->user->username ?? ''));
        
        $adminBpn = $settings['admin_bpn'] ?? '';
        $adminPutr = $settings['admin_putr'] ?? '';
        $adminPu = $settings['admin_dinas_pu'] ?? '';
        $adminPtsp = $settings['admin_satu_pintu'] ?? '';

        $infoPemohon = "Pemohon: {$nama}\nLayanan: {$layananTitle}";
        if (!empty($app->no_berkas)) {
            $infoPemohon .= "\nNo. Berkas: {$app->no_berkas}";
        }

        $dokumenFinalAdmin = (stripos($layananTitle, 'PPKPR') !== false || stripos($layananTitle, 'PKKPR') !== false) 
                             ? str_replace('PPKPR', 'PKKPR', $layananTitle) 
                             : "Dokumen {$layananTitle}";

        if (($type === 'submit' || $type === 'submit_berkas') && $adminBpn) {
            $text = "Halo Admin Kantor Pertanahan Kota Sukabumi, ada pengajuan permohonan baru untuk {$layananTitle} atas nama {$nama}. Silakan login untuk melakukan verifikasi berkas awal di: {$url}";
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
        }

        if ($type === 'berkas_revisi_bpn' && $adminBpn) {
            $text = "Notifikasi Kantor Pertanahan Kota Sukabumi: Pelaku Usaha {$nama} telah mengunggah ulang berkas revisi/perbaikan untuk permohonan {$layananTitle}. Silakan cek dan verifikasi ulang dokumen di: {$url}";
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
        }
        
        if ($type === 'berkas_verifikasi' && $app->bpn_berkas_status === 'diterima' && $adminPutr) {
            $text = "Notifikasi Dinas PUTR: Berkas permohonan {$no_berkas_text} atas nama {$nama} telah selesai divalidasi awal oleh Kantor Pertanahan Kota Sukabumi. Silakan lakukan Validasi Awal Tata Ruang di: {$url}";
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
        }
        
        if ($type === 'credential' && $adminBpn) {
            $text = "Halo Admin Kantor Pertanahan Kota Sukabumi, pemohon atas nama {$nama} telah selesai melakukan pembayaran PNBP untuk layanan {$layananTitle}. Silakan login untuk verifikasi bayar dan aktifkan akun pemohon di: {$url}";
            $wa_links[] = [
                'target' => 'Admin BPN',
                'url' => 'https://wa.me/' . $formatPhone($adminBpn) . '?text=' . urlencode($text)
            ];
            $mailboxes[] = [
                'target_user_id' => null,
                'target_role' => 'bpn',
                'title' => 'Pembayaran Selesai',
                'message' => "Pemohon telah selesai melakukan pembayaran PNBP. Silakan verifikasi bayar dan aktifkan akun.\n\n{$infoPemohon}",
                'link' => $url,
            ];
        }
        
        if ($type === 'putr_validasi' && $adminBpn) {
            $text = "Notifikasi Dinas PUTR: Berkas permohonan {$layananTitle}{$no_berkas_text} atas nama {$nama} telah selesai divalidasi awal oleh Dinas PUTR Kota Sukabumi. Silakan cek sistem untuk pendaftaran / tagihan PNBP di: {$url}";
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
        }

        if ($type === 'pkkpr_terbit') {
            // Already sent to Pemohon via $msg block above.
            if ($adminBpn) {
                $text = "Notifikasi DPMPTSP: {$dokumenFinalAdmin}{$no_berkas_text} atas nama {$nama} telah diterbitkan. Proses permohonan selesai. Cek di: {$url}";
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

        if ($type === 'pertek_terbit' && $adminPutr) {
            $text = "Notifikasi Dinas PUTR: Pertimbangan Teknis Pertanahan (PTP) untuk {$layananTitle}{$no_berkas_text} telah terbit dari Kantor Pertanahan Kota Sukabumi. Silakan lakukan penilaian PKKPR di: {$url}";
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
        
        if ($type === 'pu_selesai' && $adminPtsp) {
            $text = "Notifikasi DPMPTSP: Penilaian Dinas PUTR untuk {$layananTitle}{$no_berkas_text} selesai. Silakan proses penerbitan {$dokumenFinalAdmin} di: {$url}";
            $wa_links[] = [
                'target' => 'Admin DPMPTSP',
                'url' => 'https://wa.me/' . $formatPhone($adminPtsp) . '?text=' . urlencode($text)
            ];
            $mailboxes[] = [
                'target_user_id' => null,
                'target_role' => 'satu_pintu',
                'title' => 'Penilaian PUTR Selesai',
                'message' => "Penilaian Dinas PUTR telah selesai. Menunggu proses penerbitan {$dokumenFinalAdmin}.\n\n{$infoPemohon}",
                'link' => $url,
            ];
        }
        
        if ($type === 'pu_selesai' && $adminBpn) {
            $text = "Notifikasi Kantor Pertanahan Kota Sukabumi: Dinas PUTR telah selesai menilai {$layananTitle}{$no_berkas_text}. Menunggu penerbitan {$dokumenFinalAdmin} oleh DPMPTSP.";
            $wa_links[] = [
                'target' => 'Admin BPN',
                'url' => 'https://wa.me/' . $formatPhone($adminBpn) . '?text=' . urlencode($text)
            ];
            $mailboxes[] = [
                'target_user_id' => null,
                'target_role' => 'bpn',
                'title' => 'Penilaian PUTR Selesai',
                'message' => "Dinas PUTR telah selesai melakukan penilaian. Menunggu penerbitan {$dokumenFinalAdmin} oleh DPMPTSP.\n\n{$infoPemohon}",
                'link' => $url,
            ];
        }
        
        if (count($wa_links) > 0) {
            session()->flash('wa_links', $wa_links);
        }

        // Insert into Mailboxes
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
        $path = storage_path('app/whatsapp_settings.json');
        if (file_exists($path)) {
            $settings = json_decode(file_get_contents($path), true);
        } else {
            $settings = [
                'connected' => true,
                'fonnte_token' => '',
                'template' => 'Halo {nama_pemohon}, permohonan Anda ({nomor_registrasi}) saat ini memasuki tahap: {status_sekarang}.

Catatan: {catatan_terakhir}

Pantau di: {tautan_detail}',
            ];
            file_put_contents($path, json_encode($settings, JSON_PRETTY_PRINT));
        }
        return $settings;
    }
}

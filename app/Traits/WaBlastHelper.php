<?php

namespace App\Traits;

use Carbon\Carbon;

trait WaBlastHelper
{
    /**
     * Helper untuk mengenerate pesan WhatsApp Blast secara seragam untuk semua Modul.
     * Bebas dari {no_reg} dan disesuaikan dengan template terbaru.
     */
    protected function generateWaMessage(string $type, $app, string $layanan, string $url): ?string
    {
        $nama = $app->nama_pengaju ?: ($app->user->name ?? $app->user->username);
        // Mengambil nomor berkas jika ada, jika tidak, kosongkan.
        $no_berkas_text = !empty($app->no_berkas) ? " (No. Berkas: {$app->no_berkas})" : "";

        return match ($type) {
            'submit', 'submit_berkas' =>
                "Halo {$nama}, permohonan {$layanan} Anda berhasil diajukan.\n\nBerkas Anda sedang dalam verifikasi awal Kantor Pertanahan Kota Sukabumi. Kami akan mengirimkan pembaruan status selanjutnya melalui WhatsApp.",

            'berkas_verifikasi' => $app->bpn_berkas_status === 'diterima'
                ? "Halo {$nama}, berkas {$layanan} Anda dinyatakan VALID oleh Kantor Pertanahan Kota Sukabumi. Permohonan diteruskan ke Dinas PUTR untuk validasi pembayaran. Kami akan menghubungi Anda kembali."
                : "Halo {$nama}, berkas {$layanan} Anda dinyatakan TIDAK SESUAI / DITOLAK oleh Kantor Pertanahan Kota Sukabumi.\nAlasan: \"{$app->bpn_notes}\"\n\nMohon siapkan perbaikan berkas sesuai arahan petugas atau hubungi admin Kantor Pertanahan Kota Sukabumi.",

            'berkas_revisi_bpn' =>
                "Notifikasi Kantor Pertanahan Kota Sukabumi: Pelaku Usaha {$nama} telah mengunggah ulang berkas revisi/perbaikan untuk permohonan {$layanan}. Silakan cek & verifikasi ulang dokumen di: {$url}",

            'putr_notif_payment', 'putr_validasi' =>
                "Halo {$nama}, permohonan {$layanan} Anda telah divalidasi Dinas PUTR.\n\nSilakan cek instruksi pembayaran retribusi. Jika pembayaran sudah diselesaikan, Anda akan menerima detail Akun.",

            'putr_tolak' =>
                "Halo {$nama}, permohonan {$layanan} Anda DITOLAK oleh Dinas PUTR.\nCatatan: {$app->putr_notes}",

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
                $waktu = Carbon::parse($app->bpn_cek_lokasi_date)->locale('id')->translatedFormat('l, d F Y \J\a\m H:i \W\I\B');
                return "Halo {$nama}, permohonan {$layanan} Anda{$no_berkas_text} dijadwalkan untuk peninjauan lapangan pada:\n\n"
                     . "Waktu: {$waktu}\n"
                     . "CP Lapangan/Admin: (atas nama) {$app->bpn_cek_lokasi_cp}\n\n"
                     . "Harap konfirmasi kesediaan anda dengan menghubungi CP di atas.";
            })(),

            'cek_lokasi_ubah' =>
                "Halo {$nama}, [PERUBAHAN JADWAL] Peninjauan lokasi {$layanan}{$no_berkas_text} diubah.\n\nJadwal Baru: {$app->bpn_cek_lokasi_date}\nCP Petugas: {$app->bpn_cek_lokasi_cp}",

            'rapat' => (function() use ($app, $nama, $layanan, $no_berkas_text) {
                $waktu = Carbon::parse($app->bpn_rapat_date)->locale('id')->translatedFormat('l, d F Y \J\a\m H:i \W\I\B');
                return "Halo {$nama}, rapat pembahasan pertimbangan teknis pertanahan untuk permohonan {$layanan}{$no_berkas_text} dijadwalkan pada:\n\n"
                     . "Waktu: {$waktu}";
            })(),

            'rapat_ubah' =>
                "Halo {$nama}, [PERUBAHAN] Jadwal rapat {$layanan}{$no_berkas_text} diubah menjadi: {$app->bpn_rapat_date}.",

            'pertek_terbit' =>
                "Halo {$nama}, Pertimbangan Teknis Pertanahan untuk permohonan {$layanan}{$no_berkas_text} telah DITERBITKAN oleh Kantor Pertanahan Kota Sukabumi. Proses selanjutnya di Dinas Pekerjaan Umum (PUTR) untuk dilakukan penilaian.",

            'pertek_tolak' =>
                "Halo {$nama}, permohonan {$layanan}{$no_berkas_text} DITOLAK oleh Kantor Pertanahan Kota Sukabumi pada tahap Pertek.\nCatatan: {$app->bpn_notes}",

            'pu_selesai' =>
                "Halo {$nama}, penilaian {$layanan}{$no_berkas_text} oleh Dinas PU selesai. Permohonan diteruskan ke Dinas Satu Pintu. Pantau di: {$url}",

            'pu_tolak' =>
                "Halo {$nama}, permohonan {$layanan}{$no_berkas_text} DITOLAK oleh Dinas PU.\nCatatan: {$app->dinas_pu_notes}",

            'pkkpr_terbit' =>
                "Selamat! Dokumen Pertimbangan Teknis Pertanahan {$layanan} Anda{$no_berkas_text} telah DITERBITKAN oleh Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (PTSP).\n\n"
              . "No. PKKPR: {$app->satu_pintu_no_pkkpr}\n"
              . "Silakan unduh produk akhir Anda di: {$url}",

            'pkkpr_tolak' =>
                "Halo {$nama}, permohonan {$layanan}{$no_berkas_text} DITOLAK oleh Dinas Satu Pintu.\nCatatan: {$app->satu_pintu_notes}",

            default => null,
        };
    }
}

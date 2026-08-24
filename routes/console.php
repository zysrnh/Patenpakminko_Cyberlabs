<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

use App\Models\PpkprBerusahaApplication;
use Illuminate\Support\Facades\Schedule;

// Hapus permohonan yang belum membayar dalam 7 hari setelah divalidasi awal
Schedule::call(function () {
    $deletedCount = PpkprBerusahaApplication::where('status', 'menunggu_bpn')
        ->where('dinas_pu_status', 'validasi_awal_diterima')
        ->where('bpn_pembayaran_status', 'belum_bayar')
        ->where('updated_at', '<=', now()->subDays(7))
        ->delete();

    logger()->info("Auto-cleanup: Berhasil menghapus {$deletedCount} permohonan PKKPR Berusaha yang tidak membayar dalam 7 hari.");
})->daily();

// Command Artisan manual untuk pembersihan permohonan belum bayar
Artisan::command('cleanup:unpaid', function () {
    $deletedCount = PpkprBerusahaApplication::where('status', 'menunggu_bpn')
        ->where('dinas_pu_status', 'validasi_awal_diterima')
        ->where('bpn_pembayaran_status', 'belum_bayar')
        ->where('updated_at', '<=', now()->subDays(7))
        ->delete();

    $this->info("Berhasil menghapus {$deletedCount} permohonan PKKPR Berusaha yang tidak membayar dalam 7 hari.");
})->purpose('Hapus permohonan PKKPR Berusaha yang belum membayar setelah 7 hari divalidasi awal.');

// Auto Schedule Backup Sistem & Seluruh Dokumen (Harian jam 01:00 Malam)
Schedule::call(function () {
    \App\Services\BackupService::cleanOldBackups(30);
    $zipPath = \App\Services\BackupService::createFullZipBackup();
    logger()->info("Auto-backup: Berhasil membuat full backup sistem & seluruh dokumen di: {$zipPath}");
})->dailyAt('01:00');

// Command Artisan manual untuk Full Backup Sistem & Seluruh Dokumen
Artisan::command('backup:full', function () {
    $this->info("Sedang memproses full backup database & seluruh berkas dokumen...");
    \App\Services\BackupService::cleanOldBackups(30);
    $zipPath = \App\Services\BackupService::createFullZipBackup();
    $this->info("SELESAI! File ZIP backup lengkap berhasil disimpan di: {$zipPath}");
})->purpose('Buat file ZIP full backup sistem (Database SQL + Seluruh Berkas Dokumen Upload).');

// Auto Schedule Email Backup Database SQL Setiap 3 Hari Sekali (Jam 02:00 Pagi)
Schedule::call(function () {
    \App\Services\BackupService::sendDatabaseBackupEmail();
    logger()->info("Auto-backup-email: Berhasil mengirim salinan DB SQL 3 harian via Email.");
})->cron('0 2 */3 * *');

// Command Artisan manual untuk Pengiriman Email Backup Database SQL
Artisan::command('backup:email', function () {
    $this->info("Sedang mengirimkan email backup database SQL...");
    $success = \App\Services\BackupService::sendDatabaseBackupEmail();
    if ($success) {
        $this->info("SELESAI! Email backup database SQL berhasil terkirim.");
    } else {
        $this->error("GAGAL! Gagal mengirim email backup. Cek log / SMTP.");
    }
})->purpose('Kirim salinan database SQL via Email.');

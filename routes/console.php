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

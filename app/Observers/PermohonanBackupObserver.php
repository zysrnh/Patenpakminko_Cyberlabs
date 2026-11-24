<?php

namespace App\Observers;

use App\Services\BackupService;
use App\Services\GoogleDriveBackupService;
use Illuminate\Database\Eloquent\Model;

class PermohonanBackupObserver
{
    /**
     * Handle the Model "created" event.
     * Dijalankan secara otomatis setiap ada permohonan baru yang berhasil dibuat/disubmit.
     */
    public function created(Model $model): void
    {
        $appNumber = $model->application_number ?? ('ID #' . $model->id);
        $modelName = class_basename($model);

        $typeNames = [
            'PpkprApplication'         => 'PKKPR Non-Berusaha',
            'PpkprBerusahaApplication' => 'PKKPR Berusaha',
            'KebijakanApplication'     => 'Kebijakan Khusus',
            'PsnApplication'           => 'Proyek Strategis Nasional (PSN)',
            'TanahTimbulApplication'   => 'Tanah Timbul',
        ];

        $friendlyType = $typeNames[$modelName] ?? $modelName;
        $label = "Permohonan Baru: {$friendlyType} ({$appNumber})";

        // Dispatch background backup setelah HTTP response selesai dikirim ke pemohon
        // Pemohon sama sekali tidak mengalami delay/loading tambahan
        app()->terminating(function () use ($label, $model) {
            // 1. Cadangan SQL Database ke Rak Arsip & Email Blast
            try {
                BackupService::createTriggeredBackup($label);
            } catch (\Throwable $e) {
                logger()->error("Gagal menjalankan Auto-Backup Database pada event permohonan baru: " . $e->getMessage());
            }

            // 2. Sinkronkan seluruh berkas fisik (PDF/KTP/Peta/NIB) ke subfolder rapi di Google Drive
            try {
                GoogleDriveBackupService::syncApplicationFilesToDrive($model);
            } catch (\Throwable $e) {
                logger()->error("Gagal auto-sync berkas pemohon ke Google Drive: " . $e->getMessage());
            }
        });
    }

    /**
     * Handle the Model "updated" event.
     * Dijalankan otomatis jika ada penambahan dokumen lanjutan (Pertek BPN, SK PKKPR, Berkas Revisi).
     */
    public function updated(Model $model): void
    {
        app()->terminating(function () use ($model) {
            try {
                GoogleDriveBackupService::syncApplicationFilesToDrive($model);
            } catch (\Throwable $e) {
                logger()->error("Gagal auto-sync update dokumen pemohon ke Google Drive: " . $e->getMessage());
            }
        });
    }
}

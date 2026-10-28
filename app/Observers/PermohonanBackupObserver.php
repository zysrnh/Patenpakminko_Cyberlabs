<?php

namespace App\Observers;

use App\Services\BackupService;
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
            'PpkprApplication' => 'PKKPR Non-Berusaha',
            'PpkprBerusahaApplication' => 'PKKPR Berusaha',
            'KebijakanApplication' => 'Kebijakan Khusus',
            'PsnApplication' => 'Proyek Strategis Nasional (PSN)',
            'TanahTimbulApplication' => 'Tanah Timbul',
        ];

        $friendlyType = $typeNames[$modelName] ?? $modelName;
        $label = "Permohonan Baru: {$friendlyType} ({$appNumber})";

        // Dispatch background backup setelah HTTP response selesai dikirim ke pemohon
        // Pemohon sama sekali tidak mengalami delay/loading tambahan
        app()->terminating(function () use ($label) {
            try {
                BackupService::createTriggeredBackup($label);
            } catch (\Throwable $e) {
                logger()->error("Gagal menjalankan Auto-Backup pada event permohonan baru: " . $e->getMessage());
            }
        });
    }
}

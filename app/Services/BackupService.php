<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use ZipArchive;

class BackupService
{
    /**
     * Generate SQL dump of the database.
     */
    public static function generateSqlDump(): string
    {
        try {
            $tables = DB::select('SHOW TABLES');
            $dbName = config('database.connections.' . config('database.default') . '.database');
            $tablesKey = 'Tables_in_' . $dbName;

            $sqlContent = "-- ========================================================\n";
            $sqlContent .= "-- PATEN PAK MIKO - FULL DATABASE BACKUP DUMP\n";
            $sqlContent .= "-- Generated: " . now()->format('Y-m-d H:i:s') . " WIB\n";
            $sqlContent .= "-- ========================================================\n\n";
            $sqlContent .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

            foreach ($tables as $tableObj) {
                $tableName = property_exists($tableObj, $tablesKey) ? $tableObj->$tablesKey : current((array) $tableObj);

                // Get Create Table query
                $createTable = DB::select("SHOW CREATE TABLE `{$tableName}`");
                if (!empty($createTable)) {
                    $createSql = ((array)$createTable[0])['Create Table'] ?? '';
                    $sqlContent .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
                    $sqlContent .= $createSql . ";\n\n";
                }

                // Get Records
                $rows = DB::table($tableName)->get();
                if ($rows->count() > 0) {
                    foreach ($rows as $row) {
                        $rowArray = (array) $row;
                        $keys = array_map(fn($k) => "`{$k}`", array_keys($rowArray));
                        $values = array_map(function($v) {
                            if (is_null($v)) return 'NULL';
                            return "'" . addslashes((string) $v) . "'";
                        }, array_values($rowArray));

                        $sqlContent .= "INSERT INTO `{$tableName}` (" . implode(', ', $keys) . ") VALUES (" . implode(', ', $values) . ");\n";
                    }
                    $sqlContent .= "\n";
                }
            }

            $sqlContent .= "SET FOREIGN_KEY_CHECKS=1;\n";

            return $sqlContent;
        } catch (\Throwable $e) {
            return "-- DATABASE DUMP EXCEPTION: " . $e->getMessage() . "\n";
        }
    }

    public static function createFullZipBackup(?string $outputZipPath = null, array $categories = []): string
    {
        @ini_set('memory_limit', '512M');
        @ini_set('max_execution_time', '300');

        $timestamp = now()->format('Y-m-d_H-i-s');
        
        if (!$outputZipPath) {
            $tempDir = storage_path('app/temp_backups');
            if (!File::exists($tempDir)) {
                File::makeDirectory($tempDir, 0755, true);
            }
            $outputZipPath = $tempDir . '/patenpakminko_backup_' . $timestamp . '.zip';
        }

        $zip = new ZipArchive();
        if ($zip->open($outputZipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new \Exception("Gagal membuat file ZIP di lokasi: {$outputZipPath}");
        }

        // Mapping kategori berkas
        $categoryFolderMap = [
            'berusaha' => ['berusaha_docs', 'bpn_perteks_berusaha', 'pkkpr_berusaha_finals'],
            'non_berusaha' => ['ppkpr_docs', 'bpn_perteks', 'pkkpr_finals', 'ppkpr_approvals'],
            'kebijakan' => ['kebijakan_docs'],
            'tanah_timbul' => ['tanah-timbul_docs'],
            'psn' => ['psn_docs'],
            'templates_media' => ['Contoh_Format', 'doc', 'kbli2025', 'templates', 'dinas_pu_penilaians', 'ptp_forms', 'revisi_docs', 'shp_bpn', 'sps_docs', 'aset', 'berita', 'logo', 'profile_photos', 'ico', 'svg'],
        ];

        $includeAll = empty($categories);
        $includeSql = $includeAll || in_array('database_sql', $categories);

        // 1. Add Database SQL dump if requested
        if ($includeSql) {
            $sqlContent = static::generateSqlDump();
            $zip->addFromString('database/database_dump.sql', $sqlContent);
        }

        // 2. Add System Info text file
        $info = "PATEN PAK MIKO - CUSTOM SYSTEM & DOCUMENT BACKUP\n";
        $info .= "===============================================\n";
        $info .= "Backup Created: " . now()->format('Y-m-d H:i:s') . " WIB\n";
        $info .= "Laravel Version: " . app()->version() . "\n";
        $info .= "PHP Version: " . PHP_VERSION . "\n";
        $info .= "App URL: " . config('app.url') . "\n";
        $info .= "Kategori Terpilih: " . ($includeAll ? "SEMUA (Full Backup)" : implode(', ', $categories)) . "\n";
        $zip->addFromString('config_backup/system_info.txt', $info);

        // 3. Add uploaded files inside storage/app/public matching selected categories
        $publicStoragePath = storage_path('app/public');
        if (File::exists($publicStoragePath)) {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($publicStoragePath, \RecursiveDirectoryIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $name => $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    
                    if (str_contains($filePath, 'temp_backups') || str_ends_with($filePath, '.zip')) {
                        continue;
                    }

                    $relFromStorage = ltrim(substr($filePath, strlen($publicStoragePath)), '/\\');
                    $relParts = explode(DIRECTORY_SEPARATOR, ltrim($relFromStorage, '/\\'));
                    if (count($relParts) === 1) {
                        $relParts = explode('/', ltrim($relFromStorage, '/\\'));
                    }
                    $topFolder = $relParts[0] ?? '';

                    if (!$includeAll) {
                        $shouldInclude = false;
                        foreach ($categories as $catKey) {
                            if (isset($categoryFolderMap[$catKey]) && in_array($topFolder, $categoryFolderMap[$catKey])) {
                                $shouldInclude = true;
                                break;
                            }
                        }
                        if (!$shouldInclude && count($relParts) == 1) {
                            $shouldInclude = true;
                        }
                        if (!$shouldInclude) {
                            continue;
                        }
                    }

                    $relativePath = 'storage_uploads/' . str_replace('\\', '/', $relFromStorage);
                    $zip->addFile($filePath, $relativePath);
                    
                    if (method_exists($zip, 'setCompressionName')) {
                        $zip->setCompressionName($relativePath, ZipArchive::CM_STORE);
                    }
                }
            }
        }

        $zip->close();

        return $outputZipPath;
    }

    /**
     * Clean old backup files older than specified days.
     */
    public static function cleanOldBackups(int $days = 30): int
    {
        $backupDir = storage_path('app/temp_backups');
        if (!File::exists($backupDir)) return 0;

        $files = File::files($backupDir);
        $deleted = 0;

        foreach ($files as $file) {
            if ($file->getMTime() < now()->subDays($days)->timestamp) {
                File::delete($file->getRealPath());
                $deleted++;
            }
        }

        return $deleted;
    }

    /**
     * Send Database SQL Dump via Email.
     */
    public static function sendDatabaseBackupEmail(string|array|null $targetEmail = null): bool
    {
        $sqlContent = static::generateSqlDump();
        $fileName = 'patenpakminko_db_backup_' . now()->format('Y-m-d_H-i-s') . '.sql';

        if (empty($targetEmail)) {
            $recipients = ['penataanpertanahanmiko@gmail.com'];
        } elseif (is_array($targetEmail)) {
            $recipients = array_values(array_filter(array_unique($targetEmail)));
        } else {
            $recipients = array_values(array_filter(array_unique(array_map('trim', explode(',', $targetEmail)))));
        }

        try {
            \Illuminate\Support\Facades\Mail::raw(
                "Yth. Tim Penataan Pertanahan PATEN PAK MIKO,\n\nTerlampir adalah salinan cadangan Database SQL sistem PATEN PAK MIKO.\n\nTanggal Backup: " . now()->format('d F Y, H:i') . " WIB\nFile: " . $fileName . "\n\nHarap simpan berkas ini di tempat aman.\n\nSalam,\nSistem PATEN PAK MIKO",
                function ($message) use ($recipients, $sqlContent, $fileName) {
                    $message->to($recipients)
                        ->subject('[PATEN PAK MIKO] Salinan Database SQL - ' . now()->format('d/m/Y'))
                        ->attachData($sqlContent, $fileName, [
                            'mime' => 'text/x-sql',
                        ]);
                }
            );

            return true;
        } catch (\Throwable $e) {
            logger()->error("Gagal mengirim email backup database: " . $e->getMessage());
            return false;
        }
    }
}

<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleDriveBackupService
{
    /**
     * Bersihkan dan ambil ID folder dari string atau link Google Drive.
     * Contoh: https://drive.google.com/drive/folders/1A2B3C... -> 1A2B3C...
     */
    public static function extractFolderId(?string $input): ?string
    {
        if (empty($input)) {
            return null;
        }

        $trimmed = trim($input);
        if (preg_match('#/folders/([a-zA-Z0-9_-]+)#', $trimmed, $matches)) {
            return $matches[1];
        }

        if (preg_match('#id=([a-zA-Z0-9_-]+)#', $trimmed, $matches)) {
            return $matches[1];
        }

        return $trimmed;
    }

    /**
     * Ambil Google Drive Folder ID yang tersimpan.
     */
    public static function getFolderId(): ?string
    {
        $raw = SiteSetting::get('gdrive_folder_id');
        return static::extractFolderId($raw);
    }

    /**
     * Ambil array credentials Service Account Google.
     */
    public static function getCredentials(): ?array
    {
        // 1. Cek dari database SiteSetting
        $rawJson = SiteSetting::get('gdrive_credentials');
        if (!empty($rawJson)) {
            $decoded = json_decode($rawJson, true);
            if (is_array($decoded) && !empty($decoded['client_email']) && !empty($decoded['private_key'])) {
                return $decoded;
            }
        }

        // 2. Cek dari file storage lokal jika ada
        $filePath = storage_path('app/google_drive_credentials.json');
        if (File::exists($filePath)) {
            $decoded = json_decode(File::get($filePath), true);
            if (is_array($decoded) && !empty($decoded['client_email']) && !empty($decoded['private_key'])) {
                return $decoded;
            }
        }

        return null;
    }

    /**
     * Cek apakah konfigurasi Google Drive sudah lengkap.
     */
    public static function isConfigured(): bool
    {
        return !empty(static::getCredentials()) && !empty(static::getFolderId());
    }

    /**
     * Generate OAuth2 Access Token menggunakan Google Service Account JWT (RFC 7523).
     * Tanpa dependensi pihak ketiga (pure PHP openssl).
     */
    public static function getAccessToken(): string
    {
        $creds = static::getCredentials();
        if (!$creds) {
            throw new \Exception('Kredensial Google Service Account JSON belum dikonfigurasi.');
        }

        $now = time();
        $jwtHeader = [
            'alg' => 'RS256',
            'typ' => 'JWT',
        ];

        $jwtClaim = [
            'iss'   => $creds['client_email'],
            'scope' => 'https://www.googleapis.com/auth/drive.file https://www.googleapis.com/auth/drive',
            'aud'   => $creds['token_uri'] ?? 'https://oauth2.googleapis.com/token',
            'exp'   => $now + 3600,
            'iat'   => $now,
        ];

        $base64UrlHeader = static::base64UrlEncode(json_encode($jwtHeader));
        $base64UrlPayload = static::base64UrlEncode(json_encode($jwtClaim));
        $dataToSign = $base64UrlHeader . '.' . $base64UrlPayload;

        $privateKey = $creds['private_key'];
        $signature = '';

        $signSuccess = openssl_sign($dataToSign, $signature, $privateKey, OPENSSL_ALGO_SHA256);
        if (!$signSuccess) {
            throw new \Exception('Gagal menandatangani JWT Service Account: ' . openssl_error_string());
        }

        $jwt = $dataToSign . '.' . static::base64UrlEncode($signature);

        $tokenUri = $creds['token_uri'] ?? 'https://oauth2.googleapis.com/token';

        $response = Http::asForm()->timeout(20)->post($tokenUri, [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion'  => $jwt,
        ]);

        if (!$response->successful()) {
            $errorDetail = $response->json('error_description') ?? $response->body();
            throw new \Exception('Gagal mendapatkan Access Token dari Google: ' . $errorDetail);
        }

        $accessToken = $response->json('access_token');
        if (empty($accessToken)) {
            throw new \Exception('Google tidak mengembalikan access token yang valid.');
        }

        return $accessToken;
    }

    /**
     * Test koneksi ke Google Drive & verifikasi folder tujuan.
     */
    public static function testConnection(): array
    {
        try {
            $creds = static::getCredentials();
            if (!$creds) {
                return [
                    'success' => false,
                    'message' => 'Credentials Service Account JSON belum diisi atau tidak valid.',
                ];
            }

            $folderId = static::getFolderId();
            if (!$folderId) {
                return [
                    'success' => false,
                    'message' => 'Google Drive Folder ID belum diatur.',
                ];
            }

            $accessToken = static::getAccessToken();

            // Request cek metadata folder Google Drive
            $response = Http::withToken($accessToken)
                ->timeout(15)
                ->get("https://www.googleapis.com/drive/v3/files/{$folderId}?fields=id,name,mimeType,capabilities,driveId");

            if (!$response->successful()) {
                $status = $response->status();
                $err = $response->json('error.message') ?? $response->body();

                if ($status === 404) {
                    return [
                        'success' => false,
                        'message' => "Folder Google Drive tidak ditemukan (404). Pastikan Folder ID benar dan Service Account ({$creds['client_email']}) sudah diberi izin Editor pada folder tersebut.",
                    ];
                }

                return [
                    'success' => false,
                    'message' => "Google Drive API Error ({$status}): {$err}",
                ];
            }

            $data = $response->json();
            $folderName = $data['name'] ?? 'Folder Terpilih';
            $canAddChildren = $data['capabilities']['canAddChildren'] ?? true;

            return [
                'success' => true,
                'message' => "Koneksi berhasil! Terhubung ke folder '{$folderName}' (ID: {$folderId}). Service Account: {$creds['client_email']}.",
                'folder_name' => $folderName,
                'client_email' => $creds['client_email'],
                'can_upload' => $canAddChildren,
            ];

        } catch (\Throwable $e) {
            return [
                'success' => false,
                'message' => 'Kesalahan saat menguji koneksi Google Drive: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Upload berkas ke Google Drive menggunakan Resumable Upload API.
     * Sangat tangguh untuk berkas kecil (SQL 2MB) hingga berkas besar (ZIP dokumen > 500MB).
     */
    public static function uploadFile(string $filePath, ?string $customFileName = null, ?string $targetFolderId = null): array
    {
        @ini_set('memory_limit', '1024M');
        @ini_set('max_execution_time', '600');

        if (!File::exists($filePath)) {
            throw new \Exception("Berkas fisik tidak ditemukan di path: {$filePath}");
        }

        $folderId = $targetFolderId ?: static::getFolderId();
        if (empty($folderId)) {
            throw new \Exception('Folder ID Google Drive tujuan belum disetel.');
        }

        $accessToken = static::getAccessToken();
        $fileName = $customFileName ?: basename($filePath);
        $fileSize = File::size($filePath);
        $mimeType = File::mimeType($filePath) ?: 'application/octet-stream';

        // 1. Inisiasi Resumable Upload Session
        $metadata = [
            'name'    => $fileName,
            'parents' => [$folderId],
        ];

        $initResponse = Http::withToken($accessToken)
            ->withHeaders([
                'X-Upload-Content-Type'   => $mimeType,
                'X-Upload-Content-Length' => $fileSize,
                'Content-Type'            => 'application/json; charset=UTF-8',
            ])
            ->timeout(30)
            ->post('https://www.googleapis.com/upload/drive/v3/files?uploadType=resumable', $metadata);

        if (!$initResponse->successful()) {
            $err = $initResponse->json('error.message') ?? $initResponse->body();
            throw new \Exception("Gagal menginisiasi upload ke Google Drive: {$err}");
        }

        $uploadUrl = $initResponse->header('Location');
        if (empty($uploadUrl)) {
            throw new \Exception('Google Drive tidak mengembalikan URL upload resumable.');
        }

        // 2. Upload file data via PUT stream
        $fileHandle = fopen($filePath, 'rb');
        if (!$fileHandle) {
            throw new \Exception("Gagal membuka file stream: {$filePath}");
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $uploadUrl);
        curl_setopt($ch, CURLOPT_PUT, true);
        curl_setopt($ch, CURLOPT_INFILE, $fileHandle);
        curl_setopt($ch, CURLOPT_INFILESIZE, $fileSize);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 600);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: {$mimeType}",
            "Content-Length: {$fileSize}",
        ]);

        $curlResult = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);
        fclose($fileHandle);

        if (!empty($curlError)) {
            throw new \Exception("cURL upload error: {$curlError}");
        }

        if ($httpCode !== 200 && $httpCode !== 201) {
            throw new \Exception("Gagal mengunggah berkas ke Google Drive (HTTP {$httpCode}): {$curlResult}");
        }

        $resultJson = json_decode($curlResult, true) ?? [];
        $fileId = $resultJson['id'] ?? null;
        $fileSizeBytes = $fileSize;
        $fileSizeMb = round($fileSizeBytes / (1024 * 1024), 2);

        // Catat ke log
        Log::info("Backup berhasil diunggah ke Google Drive: {$fileName} ({$fileSizeMb} MB), File ID: {$fileId}");

        return [
            'success'        => true,
            'file_id'        => $fileId,
            'file_name'      => $fileName,
            'size'           => $fileSizeBytes,
            'size_formatted' => $fileSizeMb . ' MB',
            'web_view_link'  => $fileId ? "https://drive.google.com/file/d/{$fileId}/view" : null,
            'message'        => "Berkas '{$fileName}' ({$fileSizeMb} MB) berhasil diunggah ke Google Drive!",
        ];
    }

    /**
     * Upload Database SQL langsung ke Google Drive.
     */
    public static function uploadDatabaseSql(?string $targetFolderId = null): array
    {
        $timestamp = now()->format('Y-m-d_H-i-s');
        $fileName = 'patenpakminko_db_backup_' . $timestamp . '.sql';

        $tempDir = storage_path('app/temp_backups');
        if (!File::exists($tempDir)) {
            File::makeDirectory($tempDir, 0755, true);
        }

        $tempPath = $tempDir . '/' . $fileName;
        $sqlContent = BackupService::generateSqlDump();
        File::put($tempPath, $sqlContent);

        try {
            $result = static::uploadFile($tempPath, $fileName, $targetFolderId);
            @unlink($tempPath);
            return $result;
        } catch (\Throwable $e) {
            @unlink($tempPath);
            throw $e;
        }
    }

    /**
     * Upload Berkas ZIP Dokumen ke Google Drive.
     */
    public static function uploadFullZip(array $categories = [], ?string $targetFolderId = null): array
    {
        $zipPath = BackupService::createFullZipBackup(null, $categories);
        $fileName = basename($zipPath);

        try {
            $result = static::uploadFile($zipPath, $fileName, $targetFolderId);
            @unlink($zipPath);
            return $result;
        } catch (\Throwable $e) {
            @unlink($zipPath);
            throw $e;
        }
    }

    /**
     * Helper URL-safe Base64 encode
     */
    private static function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}

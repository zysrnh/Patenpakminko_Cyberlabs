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
     * Cek mode autentikasi aktif: 'oauth' atau 'service_account' atau null.
     */
    public static function getAuthMode(): ?string
    {
        if (!empty(SiteSetting::get('gdrive_refresh_token'))) {
            return 'oauth';
        }
        if (!empty(static::getCredentials())) {
            return 'service_account';
        }
        return null;
    }

    /**
     * Ambil email akun Google yang sedang terhubung.
     */
    public static function getConnectedEmail(): ?string
    {
        if (static::getAuthMode() === 'oauth') {
            return SiteSetting::get('gdrive_connected_email') ?? 'Akun Google Pribadi';
        }

        $creds = static::getCredentials();
        return $creds['client_email'] ?? null;
    }

    /**
     * Cek apakah konfigurasi Google Drive sudah lengkap.
     */
    public static function isConfigured(): bool
    {
        $hasAuth = !empty(static::getAuthMode());
        return $hasAuth && !empty(static::getFolderId());
    }

    /**
     * Generate / Refresh OAuth2 Access Token.
     * Prioritas 1: OAuth 2.0 Refresh Token (Akun Gmail Pribadi / Workspace).
     * Prioritas 2: Google Service Account JWT (Pure PHP OpenSSL).
     */
    public static function getAccessToken(): string
    {
        // 1. Cek apakah menggunakan OAuth 2.0 (Akun Gmail Pribadi)
        $refreshToken = SiteSetting::get('gdrive_refresh_token');
        $clientId     = SiteSetting::get('gdrive_client_id');
        $clientSecret = SiteSetting::get('gdrive_client_secret');

        if (!empty($refreshToken) && !empty($clientId) && !empty($clientSecret)) {
            $response = Http::asForm()->timeout(20)->post('https://oauth2.googleapis.com/token', [
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
                'refresh_token' => $refreshToken,
                'grant_type'    => 'refresh_token',
            ]);

            if ($response->successful()) {
                $accessToken = $response->json('access_token');
                if (!empty($accessToken)) {
                    return $accessToken;
                }
            } else {
                $err = $response->json('error_description') ?? $response->body();
                throw new \Exception("Gagal me-refresh Google Drive Access Token: {$err}");
            }
        }

        // 2. Fallback ke Service Account JWT jika ada
        $creds = static::getCredentials();
        if ($creds) {
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

            if ($response->successful()) {
                $accessToken = $response->json('access_token');
                if (!empty($accessToken)) {
                    return $accessToken;
                }
            } else {
                $errorDetail = $response->json('error_description') ?? $response->body();
                throw new \Exception('Gagal mendapatkan Access Token dari Google: ' . $errorDetail);
            }
        }

        throw new \Exception('Koneksi Google Drive belum dikonfigurasi. Hubungkan akun Google Drive atau lengkapi Service Account JSON.');
    }

    /**
     * Test koneksi ke Google Drive & verifikasi folder tujuan.
     */
    public static function testConnection(): array
    {
        try {
            $authMode = static::getAuthMode();
            if (!$authMode) {
                return [
                    'success' => false,
                    'message' => 'Autentikasi Google Drive belum dikonfigurasi. Hubungkan akun Google Drive atau upload Service Account JSON.',
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
            $connectedEmail = static::getConnectedEmail() ?? 'Google Account';

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
                        'message' => "Folder Google Drive tidak ditemukan (404). Pastikan Folder ID benar dan akun ({$connectedEmail}) memiliki akses ke folder tersebut.",
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
            $authModeText = $authMode === 'oauth' ? 'OAuth 2.0 (Akun Pribadi)' : 'Service Account';

            return [
                'success'        => true,
                'message'        => "Koneksi berhasil! Terhubung ke folder '{$folderName}' (ID: {$folderId}). Akun: {$connectedEmail} [Mode: {$authModeText}].",
                'folder_name'    => $folderName,
                'client_email'   => $connectedEmail,
                'auth_mode'      => $authMode,
                'can_upload'     => $canAddChildren,
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
     * Dapatkan atau buat subfolder di dalam folder Google Drive tertentu.
     */
    public static function getOrCreateSubfolder(string $folderName, ?string $parentFolderId = null): string
    {
        $parentId = $parentFolderId ?: static::getFolderId();
        if (empty($parentId)) {
            throw new \Exception('Parent Folder ID Google Drive belum disetel.');
        }

        $cleanName = trim(str_replace(["\r", "\n", '"', "'"], '', $folderName));
        if (empty($cleanName)) {
            $cleanName = 'Folder_Tanpa_Nama';
        }

        $accessToken = static::getAccessToken();

        // 1. Cek apakah folder sudah ada di dalam parentId
        $escapedSearch = str_replace("'", "\\'", $cleanName);
        $q = "'{$parentId}' in parents and name = '{$escapedSearch}' and mimeType = 'application/vnd.google-apps.folder' and trashed = false";

        $response = Http::withToken($accessToken)
            ->timeout(15)
            ->get("https://www.googleapis.com/drive/v3/files", [
                'q'      => $q,
                'fields' => 'files(id, name)',
            ]);

        if ($response->successful()) {
            $files = $response->json('files');
            if (!empty($files) && !empty($files[0]['id'])) {
                return $files[0]['id'];
            }
        }

        // 2. Buat folder baru jika belum ada
        $createResponse = Http::withToken($accessToken)
            ->timeout(20)
            ->post("https://www.googleapis.com/drive/v3/files", [
                'name'     => $cleanName,
                'mimeType' => 'application/vnd.google-apps.folder',
                'parents'  => [$parentId],
            ]);

        if (!$createResponse->successful()) {
            $err = $createResponse->json('error.message') ?? $createResponse->body();
            throw new \Exception("Gagal membuat folder '{$cleanName}' di Google Drive: {$err}");
        }

        $newFolderId = $createResponse->json('id');
        if (empty($newFolderId)) {
            throw new \Exception("Google Drive tidak mengembalikan ID folder baru.");
        }

        return $newFolderId;
    }

    /**
     * Tentukan nama folder kategori berdasarkan class model permohonan.
     */
    public static function getApplicationCategoryFolder(string $modelClass): string
    {
        $baseName = class_basename($modelClass);
        return match ($baseName) {
            'PpkprBerusahaApplication' => '01_PKKPR_Berusaha',
            'PpkprApplication'         => '02_PKKPR_Non_Berusaha',
            'KebijakanApplication'     => '03_Kebijakan',
            'PsnApplication'           => '04_PSN',
            'TanahTimbulApplication'   => '05_Tanah_Timbul',
            default                    => '06_Layanan_Lainnya',
        };
    }

    /**
     * Buat nama folder rapi untuk permohonan spesifik: [NO_PERMOHONAN] NAMA_PEMOHON.
     */
    public static function getApplicationFolderName(\Illuminate\Database\Eloquent\Model $model): string
    {
        $code = $model->application_number ?? $model->no_berkas ?? ('ID_' . $model->id);
        $name = $model->nama_pemilik_usaha ?? $model->nama_pengaju ?? null;

        if (empty($name) && method_exists($model, 'user') && $model->relationLoaded('user') && $model->user) {
            $name = $model->user->name;
        }

        if (empty($name)) {
            $name = 'Pemohon';
        }

        // Bersihkan karakter terlarang untuk nama folder
        $cleanCode = preg_replace('/[\\/\\\\:*?"<>|]/', '-', trim($code));
        $cleanName = preg_replace('/[\\/\\\\:*?"<>|]/', ' ', trim($name));
        $cleanName = preg_replace('/\s+/', ' ', $cleanName);

        return "[{$cleanCode}] {$cleanName}";
    }

    /**
     * Ekstrak seluruh file fisik yang diunggah dari atribut model permohonan.
     */
    public static function extractModelPhysicalFiles(\Illuminate\Database\Eloquent\Model $model): array
    {
        $files = [];
        $attributes = $model->getAttributes();
        $allowedExts = ['pdf', 'jpg', 'jpeg', 'png', 'docx', 'doc', 'zip', 'geojson', 'shp', 'kml', 'kmz'];

        foreach ($attributes as $key => $val) {
            if (!is_string($val) || empty(trim($val))) {
                continue;
            }

            $valTrim = trim($val);
            $ext = strtolower(pathinfo($valTrim, PATHINFO_EXTENSION));
            if (!in_array($ext, $allowedExts)) {
                continue;
            }

            // Cek berbagai kandidat path file di storage server
            $candidates = [
                storage_path('app/public/' . ltrim($valTrim, '/\\')),
                storage_path('app/' . ltrim($valTrim, '/\\')),
                public_path('storage/' . ltrim($valTrim, '/\\')),
                public_path(ltrim($valTrim, '/\\')),
            ];

            $resolvedPath = null;
            foreach ($candidates as $cand) {
                if (File::exists($cand) && is_file($cand)) {
                    $resolvedPath = $cand;
                    break;
                }
            }

            if ($resolvedPath) {
                $fileName = basename($resolvedPath);
                $files[$key] = [
                    'attribute' => $key,
                    'path'      => $resolvedPath,
                    'filename'  => $fileName,
                    'size'      => File::size($resolvedPath),
                ];
            }
        }

        return $files;
    }

    /**
     * Cek apakah berkas dengan nama tertentu sudah ada di dalam folder Google Drive.
     */
    public static function fileExistsInFolder(string $fileName, string $folderId): bool
    {
        try {
            $accessToken = static::getAccessToken();
            $escaped = str_replace("'", "\\'", $fileName);
            $q = "'{$folderId}' in parents and name = '{$escaped}' and trashed = false";

            $res = Http::withToken($accessToken)
                ->timeout(10)
                ->get("https://www.googleapis.com/drive/v3/files", [
                    'q'      => $q,
                    'fields' => 'files(id, name)',
                ]);

            if ($res->successful()) {
                $files = $res->json('files');
                return !empty($files) && count($files) > 0;
            }
        } catch (\Throwable $e) {}

        return false;
    }

    /**
     * Sinkronkan otomatis seluruh berkas dokumen pemohon ke Google Drive secara terstruktur.
     */
    public static function syncApplicationFilesToDrive(\Illuminate\Database\Eloquent\Model $model): array
    {
        if (!static::isConfigured()) {
            return [
                'synced' => false,
                'reason' => 'Google Drive belum dikonfigurasi.',
            ];
        }

        $rootFolderId = static::getFolderId();
        if (empty($rootFolderId)) {
            return [
                'synced' => false,
                'reason' => 'Folder ID utama Google Drive belum disetel.',
            ];
        }

        // 1. Buat / Dapatkan Folder Kategori Layanan (misal: 01_PKKPR_Berusaha)
        $catFolder = static::getApplicationCategoryFolder(get_class($model));
        $catFolderId = static::getOrCreateSubfolder($catFolder, $rootFolderId);

        // 2. Buat / Dapatkan Folder Spesifik Pemohon (misal: [BERUSAHA-20261124-IEDIX] PT Sumber Makmur)
        $appFolder = static::getApplicationFolderName($model);
        $appFolderId = static::getOrCreateSubfolder($appFolder, $catFolderId);

        // 3. Ekstrak seluruh berkas fisik yang diunggah
        $files = static::extractModelPhysicalFiles($model);
        if (empty($files)) {
            return [
                'synced'          => true,
                'uploaded_count'  => 0,
                'folder_name'     => $appFolder,
                'category_folder' => $catFolder,
            ];
        }

        // 4. Upload berkas satu per satu ke dalam folder pemohon
        $uploaded = 0;
        foreach ($files as $fileItem) {
            try {
                // Lewati jika file dengan nama persis sudah ada di folder tersebut (menghindari duplikasi)
                if (static::fileExistsInFolder($fileItem['filename'], $appFolderId)) {
                    continue;
                }

                static::uploadFile($fileItem['path'], $fileItem['filename'], $appFolderId);
                $uploaded++;
            } catch (\Throwable $e) {
                Log::warning("Gagal mengunggah berkas {$fileItem['filename']} ke folder Google Drive: " . $e->getMessage());
            }
        }

        Log::info("Auto-Sync Google Drive: Berhasil menyinkronkan {$uploaded} berkas untuk permohonan '{$appFolder}' di kategori '{$catFolder}'.");

        return [
            'synced'          => true,
            'uploaded_count'  => $uploaded,
            'app_folder_id'   => $appFolderId,
            'folder_name'     => $appFolder,
            'category_folder' => $catFolder,
        ];
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

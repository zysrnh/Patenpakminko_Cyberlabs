<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class AdminInformalMapController extends Controller
{
    /**
     * Pastikan hanya Admin BPN dan Super Admin (DPN) yang bisa mengakses.
     */
    public function __construct()
    {
        // Akses dikontrol via route middleware / gate di controller
    }

    protected function authorizeAdmin()
    {
        $user = auth()->user();
        if (!$user || (!$user->isBpn() && !$user->isDpn() && !$user->isSuperAdmin())) {
            abort(403, 'Akses ditolak. Fitur ini khusus Admin BPN dan Super Admin.');
        }
    }

    /**
     * Konfigurasi layer default INFORMAL.
     */
    public static function defaultLayers(): array
    {
        return [
            'lp2b' => [
                'key'         => 'lp2b',
                'name'        => 'LP2B (Lahan Pertanian Pangan Berkelanjutan)',
                'short_name'  => 'LP2B',
                'description' => 'Data poligon Lahan Pertanian Pangan Berkelanjutan Kota Sukabumi.',
                'file_name'   => 'lp2b.geojson',
                'color'       => '#064e3b',
                'fillColor'   => '#064e3b',
                'opacity'     => 0.65,
                'weight'      => 2,
                'is_active'   => true,
            ],
            'lbs' => [
                'key'         => 'lbs',
                'name'        => 'LBS (Lahan Baku Sawah)',
                'short_name'  => 'LBS',
                'description' => 'Data spasial luasan Lahan Baku Sawah Kota Sukabumi.',
                'file_name'   => 'lbs.geojson',
                'color'       => '#3b82f6',
                'fillColor'   => '#3b82f6',
                'opacity'     => 0.50,
                'weight'      => 2,
                'is_active'   => true,
            ],
            'lsd' => [
                'key'         => 'lsd',
                'name'        => 'LSD (Lahan Sawah yang Dilindungi)',
                'short_name'  => 'LSD',
                'description' => 'Peta penetapan Lahan Sawah yang Dilindungi Kementerian ATR/BPN.',
                'file_name'   => 'lsd.geojson',
                'color'       => '#4ade80',
                'fillColor'   => '#4ade80',
                'opacity'     => 0.50,
                'weight'      => 2,
                'is_active'   => true,
            ],
            'sukabumi_bounds' => [
                'key'         => 'sukabumi_bounds',
                'name'        => 'Batas Administrasi Kota Sukabumi',
                'short_name'  => 'Batas Kota',
                'description' => 'Batas delineasi administratif terluar Kota Sukabumi.',
                'file_name'   => 'sukabumi_bounds.geojson',
                'color'       => '#003B64',
                'fillColor'   => 'transparent',
                'opacity'     => 0.80,
                'weight'      => 3,
                'is_active'   => true,
            ],
        ];
    }

    /**
     * Ambil konfigurasi layer aktif gabungan default dan custom.
     */
    public static function getLayersConfig(): array
    {
        $defaults = self::defaultLayers();
        $configFile = storage_path('app/informal_layers_config.json');

        if (File::exists($configFile)) {
            $saved = json_decode(File::get($configFile), true) ?? [];
            foreach ($saved as $k => $cfg) {
                if (isset($defaults[$k])) {
                    $defaults[$k] = array_merge($defaults[$k], $cfg);
                }
            }
        }

        // Hitung info file aktual & riwayat backup
        foreach ($defaults as $k => &$layer) {
            $path = storage_path('app/public/shp_bpn/' . $layer['file_name']);
            if (File::exists($path)) {
                $layer['exists'] = true;
                $layer['size'] = File::size($path);
                $layer['size_human'] = self::formatBytes($layer['size']);
                $layer['updated_at'] = date('d M Y H:i:s', File::lastModified($path));
                $layer['url'] = asset('storage/shp_bpn/' . $layer['file_name']) . '?v=' . File::lastModified($path);
            } else {
                $layer['exists'] = false;
                $layer['size'] = 0;
                $layer['size_human'] = '0 KB';
                $layer['updated_at'] = '-';
                $layer['url'] = asset('storage/shp_bpn/' . $layer['file_name']);
            }

            // Cari file backup terbaru di folder backup
            $backupDir = storage_path('app/public/shp_bpn/backup');
            if (File::isDirectory($backupDir)) {
                $base = pathinfo($layer['file_name'], PATHINFO_FILENAME);
                $prefix = $base . '_bak_';
                $backupFiles = File::glob($backupDir . '/' . $prefix . '*.geojson');
                if (empty($backupFiles)) {
                    $directBackup = $backupDir . '/' . $layer['file_name'];
                    if (File::exists($directBackup)) {
                        $backupFiles = [$directBackup];
                    }
                }
                if (!empty($backupFiles)) {
                    usort($backupFiles, function($a, $b) {
                        return filemtime($b) - filemtime($a);
                    });
                    $layer['latest_backup_file'] = basename($backupFiles[0]);
                    $layer['latest_backup_time'] = date('d M Y H:i:s', filemtime($backupFiles[0]));
                    $layer['has_backup'] = true;
                } else {
                    $layer['has_backup'] = false;
                }
            } else {
                $layer['has_backup'] = false;
            }
        }

        return $defaults;
    }

    /**
     * Format bytes ke string yang manusiawi.
     */
    protected static function formatBytes($bytes, $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * Fungsi helper menulis file dengan aman di Linux/cPanel (auto chmod & unlink bypass).
     */
    protected function safeWriteFile(string $path, string $content): bool
    {
        $dir = dirname($path);
        if (!File::isDirectory($dir)) {
            @File::makeDirectory($dir, 0777, true, true);
        }
        @chmod($dir, 0777);

        // Jika file sudah ada, coba ubah permission lalu unlink
        if (File::exists($path)) {
            @chmod($path, 0666);
            @unlink($path);
        }

        // Tulis ulang file
        $written = @file_put_contents($path, $content);
        if ($written !== false) {
            @chmod($path, 0666);
            return true;
        }

        // Fallback: tulis ke file temporary lalu rename
        $tmp = $dir . '/tmp_' . uniqid() . '.json';
        if (@file_put_contents($tmp, $content) !== false) {
            @chmod($tmp, 0666);
            if (@rename($tmp, $path)) {
                @chmod($path, 0666);
                return true;
            }
        }

        throw new \Exception("Gagal menulis ke {$path}. Harap pastikan folder storage memiliki izin tulis (jalankan 'chmod -R 775 storage' di terminal cPanel).");
    }

    /**
     * Halaman Utama Pengelolaan Peta INFORMAL.
     */
    public function index()
    {
        $this->authorizeAdmin();
        $layers = self::getLayersConfig();

        return view('admin.informal_map.index', compact('layers'));
    }

    /**
     * Upload File Layer Peta (.geojson, .json, atau .zip shapefile).
     */
    public function upload(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'layer_key' => 'required|string',
            'map_file'  => 'required|file|max:51200', // Maks 50MB
        ], [
            'layer_key.required' => 'Pilih layer peta yang akan diperbarui.',
            'map_file.required'  => 'Pilih file peta (.geojson, .json, atau .zip shapefile).',
            'map_file.max'       => 'Ukuran file maksimal 50 MB.',
        ]);

        $layerKey = $request->input('layer_key');
        $layers = self::defaultLayers();

        if (!isset($layers[$layerKey])) {
            return back()->with('error', 'Layer peta tidak valid.');
        }

        $targetFileName = $layers[$layerKey]['file_name'];
        $storageDir = storage_path('app/public/shp_bpn');
        if (!File::isDirectory($storageDir)) {
            @File::makeDirectory($storageDir, 0777, true, true);
        }
        @chmod($storageDir, 0777);

        $publicDir = public_path('storage/shp_bpn');
        if (!File::isDirectory($publicDir)) {
            @File::makeDirectory($publicDir, 0777, true, true);
        }
        @chmod($publicDir, 0777);

        $targetStoragePath = $storageDir . '/' . $targetFileName;
        $targetPublicPath  = $publicDir . '/' . $targetFileName;

        // Backup file lama jika ada
        $backupName = null;
        if (File::exists($targetStoragePath)) {
            $backupDir = storage_path('app/public/shp_bpn/backup');
            if (!File::isDirectory($backupDir)) {
                @File::makeDirectory($backupDir, 0777, true, true);
            }
            @chmod($backupDir, 0777);

            $backupName = pathinfo($targetFileName, PATHINFO_FILENAME) . '_bak_' . date('Ymd_His') . '.geojson';
            @File::copy($targetStoragePath, $backupDir . '/' . $backupName);
            @chmod($backupDir . '/' . $backupName, 0666);
        }

        $uploadedFile = $request->file('map_file');
        $originalFileName = $uploadedFile->getClientOriginalName();
        $extension = strtolower($uploadedFile->getClientOriginalExtension());

        if (in_array($extension, ['geojson', 'json'])) {
            // Validasi format GeoJSON
            $content = file_get_contents($uploadedFile->getRealPath());
            $json = json_decode($content, true);

            if (!$json || !isset($json['type'])) {
                return back()->with('error', 'Format file tidak valid. Pastikan file berupa GeoJSON valid yang memiliki atribut "type" (FeatureCollection / Feature).');
            }

            // Simpan ke storage dan copy ke public menggunakan safeWriteFile
            try {
                $this->safeWriteFile($targetStoragePath, $content);
                if (File::isDirectory(public_path('storage/shp_bpn')) || !is_link(public_path('storage'))) {
                    @$this->safeWriteFile($targetPublicPath, $content);
                }
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }

            // Simpan metadata riwayat file ke json config
            $configFile = storage_path('app/informal_layers_config.json');
            $saved = File::exists($configFile) ? (json_decode(File::get($configFile), true) ?? []) : [];
            if (!isset($saved[$layerKey])) {
                $saved[$layerKey] = [];
            }
            $saved[$layerKey]['original_filename']  = $originalFileName;
            $saved[$layerKey]['latest_backup_file'] = $backupName ?? ($saved[$layerKey]['latest_backup_file'] ?? null);
            $saved[$layerKey]['latest_backup_time'] = $backupName ? date('d M Y H:i:s') : ($saved[$layerKey]['latest_backup_time'] ?? null);
            $saved[$layerKey]['uploaded_by']        = auth()->user()->name ?? auth()->user()->username;
            @File::put($configFile, json_encode($saved, JSON_PRETTY_PRINT));

            $featureCount = isset($json['features']) ? count($json['features']) : 1;
            $backupInfo = $backupName ? " File lama berhasil dicadangkan sebagai `{$backupName}`." : "";
            return back()->with('success', "Layer {$layers[$layerKey]['short_name']} berhasil diperbarui dari '{$originalFileName}'! ({$featureCount} fitur poligon).{$backupInfo}");
        } 
        elseif ($extension === 'zip') {
            // Ekstrak ZIP dan proses Shapefile
            $tempDir = storage_path('app/temp_shp_' . uniqid());
            @File::makeDirectory($tempDir, 0777, true, true);

            $zip = new ZipArchive();
            if ($zip->open($uploadedFile->getRealPath()) === true) {
                $zip->extractTo($tempDir);
                $zip->close();
            } else {
                File::deleteDirectory($tempDir);
                return back()->with('error', 'Gagal membuka file ZIP shapefile.');
            }

            // Cari file .shp di dalam folder hasil ekstrak
            $shpFiles = File::glob($tempDir . '/*.shp');
            if (empty($shpFiles)) {
                $shpFiles = File::glob($tempDir . '/*/*.shp');
            }

            if (empty($shpFiles)) {
                File::deleteDirectory($tempDir);
                return back()->with('error', 'Tidak ditemukan file berekstensi .shp di dalam file ZIP.');
            }

            $shpPath = $shpFiles[0];

            // Konversi Shapefile ke GeoJSON menggunakan script Python Geopandas
            $scriptPath = storage_path('app/convert_shp_to_geojson.py');
            if (!File::exists($scriptPath)) {
                $pyScript = <<<'PY'
import sys
import os
import json

try:
    import geopandas as gpd
except ImportError:
    print("ERROR: geopandas belum terpasang di sistem.")
    sys.exit(1)

shp_path = sys.argv[1]
out_geojson = sys.argv[2]
layer_key = sys.argv[3] if len(sys.argv) > 3 else ""

try:
    gdf = gpd.read_file(shp_path)
    if gdf.empty:
        print("ERROR: Shapefile kosong.")
        sys.exit(1)

    # Convert ke WGS84 EPSG:4326 jika belum
    if gdf.crs is None or gdf.crs.to_epsg() != 4326:
        gdf = gdf.to_crs(epsg=4326)

    # Filter poligon aktif LP2B jika ada status tidak dipertahankan
    if layer_key == 'lp2b':
        for col in gdf.columns:
            col_l = col.lower()
            if 'perda' in col_l or 'status' in col_l or 'ket' in col_l:
                mask = gdf[col].astype(str).str.upper().str.contains('TIDAK DIPERTAHANKAN')
                if mask.any():
                    gdf = gdf[~mask]
                break

    gdf.to_file(out_geojson, driver='GeoJSON')
    print(f"SUCCESS:{len(gdf)}")
except Exception as e:
    print(f"ERROR: {str(e)}")
    sys.exit(1)
PY;
                @File::put($scriptPath, $pyScript);
            }

            // Eksekusi script python
            $tempOutput = $tempDir . '/converted.geojson';
            $cmd = sprintf('python "%s" "%s" "%s" "%s"', $scriptPath, $shpPath, $tempOutput, $layerKey);
            $output = [];
            $returnVar = 0;
            exec($cmd . ' 2>&1', $output, $returnVar);

            $outputStr = implode("\n", $output);

            if ($returnVar === 0 && File::exists($tempOutput)) {
                $convertedContent = File::get($tempOutput);
                try {
                    $this->safeWriteFile($targetStoragePath, $convertedContent);
                    if (File::isDirectory(public_path('storage/shp_bpn')) || !is_link(public_path('storage'))) {
                        @$this->safeWriteFile($targetPublicPath, $convertedContent);
                    }
                } catch (\Exception $e) {
                    File::deleteDirectory($tempDir);
                    return back()->with('error', $e->getMessage());
                }

                File::deleteDirectory($tempDir);

                // Simpan metadata riwayat file ke json config
                $configFile = storage_path('app/informal_layers_config.json');
                $saved = File::exists($configFile) ? (json_decode(File::get($configFile), true) ?? []) : [];
                if (!isset($saved[$layerKey])) {
                    $saved[$layerKey] = [];
                }
                $saved[$layerKey]['original_filename']  = $originalFileName;
                $saved[$layerKey]['latest_backup_file'] = $backupName ?? ($saved[$layerKey]['latest_backup_file'] ?? null);
                $saved[$layerKey]['latest_backup_time'] = $backupName ? date('d M Y H:i:s') : ($saved[$layerKey]['latest_backup_time'] ?? null);
                $saved[$layerKey]['uploaded_by']        = auth()->user()->name ?? auth()->user()->username;
                @File::put($configFile, json_encode($saved, JSON_PRETTY_PRINT));

                $matchCount = preg_match('/SUCCESS:(\d+)/', $outputStr, $m) ? $m[1] : 'beberapa';
                $backupInfo = $backupName ? " File lama berhasil dicadangkan sebagai `{$backupName}`." : "";
                return back()->with('success', "Shapefile {$layers[$layerKey]['short_name']} berhasil dikonversi dan disimpan dari '{$originalFileName}'! ({$matchCount} fitur).{$backupInfo}");
            } else {
                File::deleteDirectory($tempDir);
                Log::error("Gagal convert SHP: " . $outputStr);
                return back()->with('error', "Gagal mengonversi file shapefile: {$outputStr}. Pastikan file shapefile memiliki koordinat valid (disarankan upload langsung dalam format .geojson/.json).");
            }
        } else {
            return back()->with('error', 'Format file tidak didukung. Harap upload file .geojson, .json, atau .zip (Shapefile).');
        }
    }

    /**
     * Download File GeoJSON aktif untuk backup.
     */
    public function download($layerKey)
    {
        $this->authorizeAdmin();
        $layers = self::defaultLayers();

        if (!isset($layers[$layerKey])) {
            abort(404, 'Layer tidak ditemukan.');
        }

        $filePath = storage_path('app/public/shp_bpn/' . $layers[$layerKey]['file_name']);
        if (!File::exists($filePath)) {
            return back()->with('error', 'File layer belum tersedia di server.');
        }

        $downloadName = $layerKey . '_' . date('Ymd_His') . '.geojson';
        return response()->download($filePath, $downloadName);
    }

    /**
     * Update Pengaturan Tampilan Layer (Warna, Opacity, Status Aktif).
     */
    public function updateSettings(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'layer_key' => 'required|string',
            'color'     => 'required|string|max:20',
            'opacity'   => 'required|numeric|min:0.1|max:1.0',
            'is_active' => 'nullable',
        ]);

        $layerKey = $request->input('layer_key');
        $configFile = storage_path('app/informal_layers_config.json');
        $saved = File::exists($configFile) ? (json_decode(File::get($configFile), true) ?? []) : [];

        $saved[$layerKey] = [
            'color'     => $request->input('color'),
            'fillColor' => $request->input('color'),
            'opacity'   => (float)$request->input('opacity'),
            'is_active' => $request->has('is_active') ? true : false,
        ];

        File::put($configFile, json_encode($saved, JSON_PRETTY_PRINT));

        return back()->with('success', 'Pengaturan layer berhasil disimpan.');
    }

    /**
     * Hapus / Kosongkan Layer Peta (Otomatis Backup Terlebih Dahulu).
     */
    public function destroy($layerKey)
    {
        $this->authorizeAdmin();
        $layers = self::defaultLayers();

        if (!isset($layers[$layerKey])) {
            return back()->with('error', 'Layer peta tidak valid.');
        }

        $targetFileName = $layers[$layerKey]['file_name'];
        $storageDir = storage_path('app/public/shp_bpn');
        $publicDir = public_path('storage/shp_bpn');
        $backupDir = $storageDir . '/backup';

        if (!File::isDirectory($backupDir)) {
            @File::makeDirectory($backupDir, 0777, true, true);
        }
        @chmod($backupDir, 0777);

        $targetStoragePath = $storageDir . '/' . $targetFileName;
        $targetPublicPath  = $publicDir . '/' . $targetFileName;

        if (!File::exists($targetStoragePath) && !File::exists($targetPublicPath)) {
            return back()->with('error', 'File layer sudah tidak ada atau kosong.');
        }

        // Backup file lama sebelum dihapus
        $backupName = pathinfo($targetFileName, PATHINFO_FILENAME) . '_bak_' . date('Ymd_His') . '.geojson';
        if (File::exists($targetStoragePath)) {
            @File::copy($targetStoragePath, $backupDir . '/' . $backupName);
            @chmod($backupDir . '/' . $backupName, 0666);
        } elseif (File::exists($targetPublicPath)) {
            @File::copy($targetPublicPath, $backupDir . '/' . $backupName);
            @chmod($backupDir . '/' . $backupName, 0666);
        }

        // Hapus file aktif dari storage dan public
        if (File::exists($targetStoragePath)) {
            @chmod($targetStoragePath, 0666);
            @unlink($targetStoragePath);
        }
        if (File::exists($targetPublicPath)) {
            @chmod($targetPublicPath, 0666);
            @unlink($targetPublicPath);
        }

        // Simpan metadata riwayat file ke json config
        $configFile = storage_path('app/informal_layers_config.json');
        $saved = File::exists($configFile) ? (json_decode(File::get($configFile), true) ?? []) : [];
        if (!isset($saved[$layerKey])) {
            $saved[$layerKey] = [];
        }
        $saved[$layerKey]['latest_backup_file'] = $backupName;
        $saved[$layerKey]['latest_backup_time'] = date('d M Y H:i:s');
        $saved[$layerKey]['deleted_at']         = date('d M Y H:i:s');
        $saved[$layerKey]['deleted_by']         = auth()->user()->name ?? auth()->user()->username;
        @File::put($configFile, json_encode($saved, JSON_PRETTY_PRINT));

        return back()->with('success', "Layer {$layers[$layerKey]['short_name']} berhasil dihapus dari peta. Cadangan aman otomatis tersimpan sebagai `{$backupName}`.");
    }

    /**
     * Pulihkan Layer Peta dari Cadangan Terakhir.
     */
    public function restore($layerKey)
    {
        $this->authorizeAdmin();
        $layers = self::defaultLayers();

        if (!isset($layers[$layerKey])) {
            return back()->with('error', 'Layer peta tidak valid.');
        }

        $targetFileName = $layers[$layerKey]['file_name'];
        $storageDir = storage_path('app/public/shp_bpn');
        $publicDir = public_path('storage/shp_bpn');
        $backupDir = $storageDir . '/backup';

        if (!File::isDirectory($backupDir)) {
            return back()->with('error', 'Folder backup belum tersedia.');
        }

        $base = pathinfo($targetFileName, PATHINFO_FILENAME);
        $backupFiles = File::glob($backupDir . '/' . $base . '_bak_*.geojson');
        if (empty($backupFiles)) {
            $directBackup = $backupDir . '/' . $targetFileName;
            if (File::exists($directBackup)) {
                $backupFiles = [$directBackup];
            }
        }

        if (empty($backupFiles)) {
            return back()->with('error', 'Tidak ditemukan file cadangan untuk layer ini.');
        }

        // Urutkan backup terbaru
        usort($backupFiles, function($a, $b) {
            return filemtime($b) - filemtime($a);
        });

        $sourceBackupPath = $backupFiles[0];
        $backupFileName = basename($sourceBackupPath);
        $content = File::get($sourceBackupPath);

        try {
            $this->safeWriteFile($storageDir . '/' . $targetFileName, $content);
            if (File::isDirectory($publicDir) || !is_link(public_path('storage'))) {
                @$this->safeWriteFile($publicDir . '/' . $targetFileName, $content);
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        // Simpan info restore di config
        $configFile = storage_path('app/informal_layers_config.json');
        $saved = File::exists($configFile) ? (json_decode(File::get($configFile), true) ?? []) : [];
        if (!isset($saved[$layerKey])) {
            $saved[$layerKey] = [];
        }
        $saved[$layerKey]['restored_at']   = date('d M Y H:i:s');
        $saved[$layerKey]['restored_from'] = $backupFileName;
        $saved[$layerKey]['restored_by']   = auth()->user()->name ?? auth()->user()->username;
        @File::put($configFile, json_encode($saved, JSON_PRETTY_PRINT));

        return back()->with('success', "Layer {$layers[$layerKey]['short_name']} berhasil dipulihkan dari cadangan `{$backupFileName}` dan kembali aktif di peta!");
    }
}

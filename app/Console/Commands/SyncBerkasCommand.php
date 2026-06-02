<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Berkas;
use App\Models\PpkprApplication;
use App\Models\PpkprBerusahaApplication;
use App\Models\KebijakanApplication;
use App\Models\PsnApplication;

class SyncBerkasCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'berkas:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sinkronisasi dokumen dari aplikasi ke dalam tabel berkas secara terpusat';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Memulai sinkronisasi berkas...");
        
        $count = 0;

        $fileFields = [
            'peta_lokasi' => 'Peta Lokasi',
            'surat_kuasa' => 'Surat Kuasa',
            'fc_ktp' => 'FC KTP',
            'fc_npwp' => 'FC NPWP',
            'fc_akta_pendirian' => 'FC Akta Pendirian',
            'rencana_penggunaan_tanah' => 'Rencana Penggunaan Tanah',
            'nib' => 'NIB',
            'kbli' => 'KBLI',
            'proposal_kegiatan' => 'Proposal Kegiatan',
            'persyaratan_lainnya' => 'Persyaratan Lainnya',
            'bpn_pertek_document' => 'Dokumen Pertek (BPN)',
            'dinas_pu_document' => 'Dokumen Penilaian (PU)',
            'satu_pintu_document' => 'Dokumen PKKPR Final (PTSP)'
        ];

        // 1. PKKPR Berusaha
        $berusahaApps = PpkprBerusahaApplication::all();
        foreach ($berusahaApps as $app) {
            $this->processApp($app, $fileFields, 'PKKPR Berusaha');
            $count++;
        }

        // 2. PKKPR Non Berusaha
        $nonBerusahaApps = PpkprApplication::all();
        foreach ($nonBerusahaApps as $app) {
            $this->processApp($app, $fileFields, 'PKKPR Non-Berusaha');
            $count++;
        }

        // 3. Kebijakan Khusus
        $kebijakanApps = KebijakanApplication::all();
        foreach ($kebijakanApps as $app) {
            $this->processApp($app, $fileFields, 'Kebijakan Khusus');
            $count++;
        }

        // 4. PSN
        $psnApps = PsnApplication::all();
        foreach ($psnApps as $app) {
            $this->processApp($app, $fileFields, 'PSN');
            $count++;
        }

        $this->info("Sinkronisasi selesai! $count berkas berhasil diproses.");
    }

    private function processApp($app, $fileFields, $modulName)
    {
        // 1. Ekstrak Formulir PTP jika ada
        if (!empty($app->ptp_data)) {
            $this->generatePtpBerkas($app, $modulName);
        }

        // 2. Proses semua field dokumen
        foreach ($fileFields as $field => $labelJenis) {
            if (!empty($app->$field)) {
                $this->createBerkasIfNotExists(
                    $app->user_id, 
                    $labelJenis, 
                    $app->$field, 
                    $modulName, 
                    $app->application_number
                );
            }
        }
    }

    private function generatePtpBerkas($app, $modulName)
    {
        $ptpData = json_decode($app->ptp_data, true);
        if (!$ptpData) return;

        $fileName = 'Formulir_PTP_' . str_replace('/', '_', $app->application_number) . '.html';
        $filePath = 'ptp_forms/' . $fileName;
        $fullPath = storage_path('app/public/' . $filePath);

        // Buat folder jika belum ada
        if (!file_exists(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0755, true);
        }

        // Jika file belum pernah di-generate, buat HTML-nya
        if (!file_exists($fullPath)) {
            $html = "<html><head><title>Formulir PTP - {$app->application_number}</title>";
            $html .= "<style>body{font-family:sans-serif;padding:20px;} table{border-collapse:collapse;width:100%;max-width:800px;} th,td{border:1px solid #ddd;padding:8px;text-align:left;} th{background:#f4f4f4;width:30%;}</style>";
            $html .= "</head><body>";
            $html .= "<h2>Formulir PTP (Pertimbangan Teknis Pertanahan)</h2>";
            $html .= "<p><strong>Nomor Pengajuan:</strong> {$app->application_number} ({$modulName})</p>";
            $html .= "<table><tbody>";
            foreach ($ptpData as $key => $value) {
                $label = ucwords(str_replace('_', ' ', $key));
                $html .= "<tr><th>{$label}</th><td>{$value}</td></tr>";
            }
            $html .= "</tbody></table></body></html>";

            file_put_contents($fullPath, $html);
        }

        $this->createBerkasIfNotExists($app->user_id, 'Formulir PTP', $filePath, $modulName, $app->application_number);
    }

    private function createBerkasIfNotExists($userId, $jenisLabel, $filePath, $modulName, $appNumber)
    {
        // Hindari duplikasi
        if (Berkas::where('file_path', $filePath)->exists()) {
            return;
        }

        $ext = pathinfo($filePath, PATHINFO_EXTENSION);
        if (empty($ext)) $ext = 'html'; // fallback

        // Estimate size
        $fullPath = storage_path('app/public/' . $filePath);
        $ukuranStr = '0 KB';
        if (file_exists($fullPath)) {
            $ukuranKb = round(filesize($fullPath) / 1024, 2);
            $ukuranStr = $ukuranKb > 1024 ? round($ukuranKb / 1024, 2) . ' MB' : $ukuranKb . ' KB';
        }

        Berkas::create([
            'user_id' => $userId,
            'nama_berkas' => "[$modulName] $appNumber",
            'kategori' => $jenisLabel,
            'file_path' => $filePath,
            'tipe_file' => strtolower($ext),
            'ukuran_file' => $ukuranStr,
            'keterangan' => "Auto-sync ($jenisLabel)"
        ]);
    }
}

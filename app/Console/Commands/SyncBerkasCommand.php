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

        $fileName = 'Formulir_PTP_' . str_replace('/', '_', $app->application_number) . '.docx';
        $filePath = 'ptp_forms/' . $fileName;
        $fullPath = storage_path('app/public/' . $filePath);

        // Buat folder jika belum ada
        if (!file_exists(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0755, true);
        }

        // Ambil email user jika ada
        $email = $app->user ? $app->user->email : '-';

        // Jika file belum pernah di-generate, buat DOCX-nya dari template
        if (!file_exists($fullPath)) {
            $templatePath = storage_path('app/public/doc/Formulir/Formulir Pertek 2026 Template.docx');

            if (file_exists($templatePath)) {
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);

                $templateProcessor->setValue('nama',                   $ptpData['nama'] ?? '-');
                $templateProcessor->setValue('nik',                    $ptpData['nik'] ?? '-');
                $templateProcessor->setValue('nib',                    $ptpData['nib'] ?? '-');
                $templateProcessor->setValue('alamat',                 $ptpData['alamat'] ?? '-');
                $templateProcessor->setValue('phone_number',           $ptpData['phone_number'] ?? '-');
                $templateProcessor->setValue('bertindak_atas_nama',    $ptpData['bertindak_atas_nama'] ?? '-');
                $templateProcessor->setValue('anggaran_dasar_tanggal', $ptpData['anggaran_dasar_tanggal'] ?? '-');
                $templateProcessor->setValue('anggaran_dasar_no',      $ptpData['anggaran_dasar_no'] ?? '-');
                $templateProcessor->setValue('rencana_kegiatan',       $ptpData['rencana_kegiatan'] ?? '-');
                $templateProcessor->setValue('kbli',                   $ptpData['kbli'] ?? '-');
                $templateProcessor->setValue('letak_tanah_jalan',      $ptpData['letak_tanah_jalan'] ?? '-');
                $templateProcessor->setValue('letak_tanah_kelurahan',  $ptpData['letak_tanah_kelurahan'] ?? '-');
                $templateProcessor->setValue('letak_tanah_kecamatan',  $ptpData['letak_tanah_kecamatan'] ?? '-');
                $templateProcessor->setValue('luas_tanah',             $ptpData['luas_tanah'] ?? '-');
                $templateProcessor->setValue('status_penguasaan',      $ptpData['status_penguasaan'] ?? '-');
                $templateProcessor->setValue('penggunaan_saat_ini',    $ptpData['penggunaan_saat_ini'] ?? '-');
                $templateProcessor->setValue('email',                  $email);

                $templateProcessor->saveAs($fullPath);
            }
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

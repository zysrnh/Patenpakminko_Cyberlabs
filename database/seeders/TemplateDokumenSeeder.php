<?php

namespace Database\Seeders;

use App\Models\TemplateDokumen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class TemplateDokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Pastikan folder storage/app/public/Contoh_Format ada
        $destDir = storage_path('app/public/Contoh_Format');
        if (!File::exists($destDir)) {
            File::makeDirectory($destDir, 0777, true, true);
        }

        // 2. Sumber folder perbaikan sampling dokumen
        $srcDir = base_path('perbaikan sampling dokumen');

        // Daftar mapping file sampling dokumen dari perbaikan sampling dokumen
        $samplingFiles = [
            [
                'src_file'     => '1. Contoh Formulir Pertek.pdf',
                'dest_file'    => 'Contoh_Format/1. Contoh Formulir Pertek.pdf',
                'nama_template'=> 'Contoh 1 - Formulir Pertek',
                'kode_template'=> 'contoh_1_formulir_pertek',
                'kategori'     => 'Contoh Format Requirements',
                'keterangan'   => 'Contoh format pengisian Formulir Pertek.',
            ],
            [
                'src_file'     => '2. SKETSA LOKASI.pdf',
                'dest_file'    => 'Contoh_Format/2. SKETSA LOKASI.pdf',
                'nama_template'=> 'Contoh 2 - Sketsa Lokasi',
                'kode_template'=> 'contoh_2_sketsa_lokasi',
                'kategori'     => 'Contoh Format Requirements',
                'keterangan'   => 'Contoh format Peta / Sketsa Lokasi.',
            ],
            [
                'src_file'     => '3. Contoh Surat Kuasa Perusahaan.pdf',
                'dest_file'    => 'Contoh_Format/3. Contoh Surat Kuasa Perusahaan.pdf',
                'nama_template'=> 'Contoh 3 - Surat Kuasa Perusahaan',
                'kode_template'=> 'contoh_3_surat_kuasa',
                'kategori'     => 'Contoh Format Requirements',
                'keterangan'   => 'Contoh format Surat Kuasa Perusahaan.',
            ],
            [
                'src_file'     => '4. Contoh KTP.pdf',
                'dest_file'    => 'Contoh_Format/4. Contoh KTP.pdf',
                'nama_template'=> 'Contoh 4 - KTP',
                'kode_template'=> 'contoh_4_ktp',
                'kategori'     => 'Contoh Format Requirements',
                'keterangan'   => 'Contoh kelengkapan KTP.',
            ],
            [
                'src_file'     => '5. Contoh NPWP.pdf',
                'dest_file'    => 'Contoh_Format/5. Contoh NPWP.pdf',
                'nama_template'=> 'Contoh 5 - NPWP',
                'kode_template'=> 'contoh_5_npwp',
                'kategori'     => 'Contoh Format Requirements',
                'keterangan'   => 'Contoh format dokumen NPWP.',
            ],
            [
                'src_file'     => '6. contoh akta PENDIRIAN PERSEROAN TERBATAS.pdf',
                'dest_file'    => 'Contoh_Format/6. contoh akta PENDIRIAN PERSEROAN TERBATAS.pdf',
                'nama_template'=> 'Contoh 6 - Akta Pendirian Perseroan Terbatas',
                'kode_template'=> 'contoh_6_akta_pendirian',
                'kategori'     => 'Contoh Format Requirements',
                'keterangan'   => 'Contoh format Akta Pendirian PT.',
            ],
            [
                'src_file'     => '7. Rencana Penggunaan pemanfaatan tanah.pdf',
                'dest_file'    => 'Contoh_Format/7. Rencana Penggunaan pemanfaatan tanah.pdf',
                'nama_template'=> 'Contoh 7 - Rencana Penggunaan Pemanfaatan Tanah',
                'kode_template'=> 'contoh_7_rencana_pemanfaatan_tanah',
                'kategori'     => 'Contoh Format Requirements',
                'keterangan'   => 'Contoh format rencana penggunaan & pemanfaatan tanah.',
            ],
            [
                'src_file'     => '8. Contoh NIB.pdf',
                'dest_file'    => 'Contoh_Format/8. Contoh NIB.pdf',
                'nama_template'=> 'Contoh 8 - NIB (Nomor Induk Berusaha)',
                'kode_template'=> 'contoh_8_nib',
                'kategori'     => 'Contoh Format Requirements',
                'keterangan'   => 'Contoh format Nomor Induk Berusaha (NIB).',
            ],
            [
                'src_file'     => '9. Contoh KBLI.pdf',
                'dest_file'    => 'Contoh_Format/9. Contoh KBLI.pdf',
                'nama_template'=> 'Contoh 9 - KBLI',
                'kode_template'=> 'contoh_9_kbli',
                'kategori'     => 'Contoh Format Requirements',
                'keterangan'   => 'Contoh format dokumen KBLI.',
            ],
            [
                'src_file'     => '10. Contoh Bussiness Plan Proposal.pdf',
                'dest_file'    => 'Contoh_Format/10. Contoh Bussiness Plan Proposal.pdf',
                'nama_template'=> 'Contoh 10 - Business Plan Proposal',
                'kode_template'=> 'contoh_10_proposal',
                'kategori'     => 'Contoh Format Requirements',
                'keterangan'   => 'Contoh format Business Plan Proposal.',
            ],
            [
                'src_file'     => '11. Contoh serifikat elektronik, analog, akta sewa, perjanjian sewa.pdf',
                'dest_file'    => 'Contoh_Format/11. Contoh serifikat elektronik, analog, akta sewa, perjanjian sewa.pdf',
                'nama_template'=> 'Contoh 11 - Sertipikat Elektronik / Akta Sewa',
                'kode_template'=> 'contoh_11_sertipikat',
                'kategori'     => 'Contoh Format Requirements',
                'keterangan'   => 'Contoh sertipikat elektronik/analog & akta/perjanjian sewa.',
            ],
        ];

        // Copy file dari 'perbaikan sampling dokumen' ke 'storage/app/public/Contoh_Format'
        foreach ($samplingFiles as $item) {
            $sourcePath = $srcDir . '/' . $item['src_file'];
            $targetPath = storage_path('app/public/' . $item['dest_file']);

            if (File::exists($sourcePath)) {
                File::copy($sourcePath, $targetPath);
            }
        }

        // Hapus template lama dari DB yang mungkin tidak ada lagi di list baru
        TemplateDokumen::whereIn('kode_template', ['pertek_2026_master', 'wa_blast', 'contoh_1_formulir_ptp'])->delete();

        // 3. Masukkan record ke database
        $allTemplates = array_merge([
            [
                'nama_template' => 'Formulir Pertek 2026 Template (Semua Layanan PTP)',
                'kode_template' => 'pertek_2026',
                'kategori'      => 'Formulir Pertek',
                'file_path'     => 'doc/Formulir/Formulir Pertek 2026 Template.docx',
                'keterangan'    => 'Template utama pembuatan dokumen Word Pertimbangan Teknis Pertanahan untuk 5 Layanan (PPKPR Berusaha, Non Berusaha, Kebijakan, Tanah Timbul, PSN).',
            ],
        ], array_map(function($sf) {
            return [
                'nama_template' => $sf['nama_template'],
                'kode_template' => $sf['kode_template'],
                'kategori'      => $sf['kategori'],
                'file_path'     => $sf['dest_file'],
                'keterangan'    => $sf['keterangan'],
            ];
        }, $samplingFiles));

        foreach ($allTemplates as $t) {
            $fullPath = storage_path('app/public/' . $t['file_path']);
            $tipeFile = pathinfo($t['file_path'], PATHINFO_EXTENSION);
            $ukuranStr = '0 KB';

            if (File::exists($fullPath)) {
                $bytes = File::size($fullPath);
                $ukuranKb = round($bytes / 1024, 2);
                $ukuranStr = $ukuranKb > 1024 ? round($ukuranKb / 1024, 2) . ' MB' : $ukuranKb . ' KB';
            }

            TemplateDokumen::updateOrCreate(
                ['kode_template' => $t['kode_template']],
                [
                    'nama_template' => $t['nama_template'],
                    'kategori'      => $t['kategori'],
                    'file_path'     => $t['file_path'],
                    'tipe_file'     => strtolower($tipeFile),
                    'ukuran_file'   => $ukuranStr,
                    'keterangan'    => $t['keterangan'],
                    'is_active'     => true,
                ]
            );
        }
    }
}

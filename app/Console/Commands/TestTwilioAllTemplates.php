<?php

namespace App\Console\Commands;

use App\Services\WhatsappService;
use App\Traits\WaBlastHelper;
use Illuminate\Console\Command;

class TestTwilioAllTemplates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twilio:test-all {phone=083861669565 : Nomor tujuan penerima uji coba} {--category=all : Kategori uji coba (pemohon, admin, otp, all)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim pesan uji coba seluruh template Twilio WhatsApp resmi Meta (Pemohon & Admin)';

    /**
     * Execute the console command.
     */
    public function handle(WhatsappService $waService)
    {
        $phone = $this->argument('phone');
        $category = strtolower($this->option('category') ?: 'all');

        $this->newLine();
        $this->info("==============================================================");
        $this->info("   UJI COBA BLASING TWILIO WHATSAPP RESMI PATEN PAK MIKO     ");
        $this->info("==============================================================");
        $this->line("Target Penerima : <fg=yellow>{$phone}</>");
        $this->line("Kategori        : <fg=cyan>{$category}</>");
        $this->newLine();

        $templates = [
            // PEMOHON TEMPLATES
            [
                'category' => 'pemohon',
                'name'     => '1. Pemohon - Pengajuan Masuk',
                'key'      => 'twilio_tpl_pemohon_pengajuan_masuk',
                'vars'     => [
                    '1' => 'Zaki Yusron',
                    '2' => 'PKKPR Berusaha',
                    '3' => 'https://patenpakmiko.com/dashboard',
                    '4' => '085724455503',
                ],
            ],
            [
                'category' => 'pemohon',
                'name'     => '2. Pemohon - Berkas Lengkap (Instruksi PNBP)',
                'key'      => 'twilio_tpl_pemohon_berkas_lengkap',
                'vars'     => [
                    '1' => 'Zaki Yusron',
                    '2' => 'PKKPR Berusaha',
                    '3' => 'https://patenpakmiko.com/dashboard',
                    '4' => '085724455503',
                ],
            ],
            [
                'category' => 'pemohon',
                'name'     => '3. Pemohon - Berkas Perlu Revisi',
                'key'      => 'twilio_tpl_pemohon_berkas_revisi',
                'vars'     => [
                    '1' => 'Zaki Yusron',
                    '2' => 'PKKPR Berusaha',
                    '3' => 'Scan KTP dan peta poligon bidang tanah kurang jelas, mohon perbaiki.',
                    '4' => 'https://patenpakmiko.com/revisi-berkas',
                    '5' => '085724455503',
                ],
            ],
            [
                'category' => 'pemohon',
                'name'     => '4. Pemohon - PNBP Dikonfirmasi Lunas',
                'key'      => 'twilio_tpl_pemohon_pnbp_lunas',
                'vars'     => [
                    '1' => 'Zaki Yusron',
                    '2' => 'PKKPR Berusaha',
                    '3' => '2026/BPN-KOTA-SMI/001',
                    '4' => 'https://patenpakmiko.com/login',
                    '5' => '085724455503',
                ],
            ],
            [
                'category' => 'pemohon',
                'name'     => '5. Pemohon - Jadwal Survey Lapangan',
                'key'      => 'twilio_tpl_pemohon_jadwal_lokasi',
                'vars'     => [
                    '1' => 'Zaki Yusron',
                    '2' => 'PKKPR Berusaha',
                    '3' => 'Kamis, 12 November 2026 Pukul 09.00 WIB',
                    '4' => '085724455503 (Pak Hendra - Surveyor)',
                    '5' => '085724455503',
                ],
            ],
            [
                'category' => 'pemohon',
                'name'     => '6. Pemohon - Jadwal Rapat Pembahasan',
                'key'      => 'twilio_tpl_pemohon_jadwal_rapat',
                'vars'     => [
                    '1' => 'Zaki Yusron',
                    '2' => 'PKKPR Berusaha',
                    '3' => 'Senin, 16 November 2026 Pukul 10.00 WIB di Aula Kantah',
                    '4' => 'https://patenpakmiko.com/dashboard',
                    '5' => '085724455503',
                ],
            ],
            [
                'category' => 'pemohon',
                'name'     => '7. Pemohon - Dokumen Izin Terbit',
                'key'      => 'twilio_tpl_pemohon_dokumen_terbit',
                'vars'     => [
                    '1' => 'Zaki Yusron',
                    '2' => 'PKKPR Berusaha',
                    '3' => 'https://patenpakmiko.com/dashboard',
                    '4' => 'https://patenpakmiko.com/lapolpa',
                    '5' => '085724455503',
                ],
            ],
            [
                'category' => 'pemohon',
                'name'     => '8. Pemohon - Notifikasi Khusus (Dinamis Akun/Info)',
                'key'      => 'twilio_tpl_pemohon_informasi_layanan',
                'vars'     => [
                    '1' => 'Zaki Yusron',
                    '2' => 'Pendaftaran Akun Layanan',
                    '3' => 'ID Pengguna: 3272012304950001 | Sandi: Sukabumi2026* | Status: Aktif',
                    '4' => 'https://patenpakmiko.com/login',
                    '5' => '085724455503',
                ],
            ],

            // ADMIN TEMPLATES
            [
                'category' => 'admin',
                'name'     => '9. Admin - Notif Pengajuan Baru Masuk',
                'key'      => 'twilio_tpl_admin_pengajuan_baru',
                'vars'     => [
                    '1' => 'Kota Sukabumi',
                    '2' => 'PKKPR Berusaha',
                    '3' => 'PT Makmur Sejahtera (Zaki)',
                    '4' => 'https://patenpakmiko.com/login',
                    '5' => '085724455503',
                ],
            ],
            [
                'category' => 'admin',
                'name'     => '10. Admin - Berkas Revisi Telah Diunggah',
                'key'      => 'twilio_tpl_admin_berkas_revisi',
                'vars'     => [
                    '1' => 'Kota Sukabumi',
                    '2' => 'PT Makmur Sejahtera (Zaki)',
                    '3' => 'PKKPR Berusaha',
                    '4' => 'https://patenpakmiko.com/login',
                    '5' => '085724455503',
                ],
            ],
            [
                'category' => 'admin',
                'name'     => '11. Admin - Validasi Tata Ruang Awal Masuk ke PUTR',
                'key'      => 'twilio_tpl_admin_validasi_putr',
                'vars'     => [
                    '1' => 'Dinas PUTR Kota Sukabumi',
                    '2' => '2026/BPN-KOTA-SMI/001',
                    '3' => 'PT Makmur Sejahtera (Zaki)',
                    '4' => 'https://patenpakmiko.com/login',
                    '5' => '085724455503',
                ],
            ],
            [
                'category' => 'admin',
                'name'     => '12. Admin - Penilaian PUTR Selesai (Notif BPN)',
                'key'      => 'twilio_tpl_admin_putr_selesai',
                'vars'     => [
                    '1' => 'Kantor Pertanahan Kota Sukabumi',
                    '2' => 'PKKPR Berusaha',
                    '3' => '2026/BPN-KOTA-SMI/001',
                    '4' => 'PT Makmur Sejahtera (Zaki)',
                    '5' => 'https://patenpakmiko.com/login',
                    '6' => '085724455503',
                ],
            ],
            [
                'category' => 'admin',
                'name'     => '13. Admin - Dokumen Siap Diterbitkan (Notif DPMPTSP)',
                'key'      => 'twilio_tpl_admin_siap_terbit',
                'vars'     => [
                    '1' => 'DPMPTSP Kota Sukabumi',
                    '2' => 'PKKPR Berusaha',
                    '3' => '2026/BPN-KOTA-SMI/001',
                    '4' => 'https://patenpakmiko.com/login',
                    '5' => '085724455503',
                ],
            ],
        ];

        $defaultSids = [
            'twilio_tpl_admin_pengajuan_baru'      => 'HX01522b323b8587486c94f11eb82529ec',
            'twilio_tpl_admin_berkas_revisi'       => 'HXad0b9226baeee04b03f570b3e593ac23',
            'twilio_tpl_admin_validasi_putr'       => 'HXc06c27930b78ab5dd9a361fd0f8a1a16',
            'twilio_tpl_admin_putr_selesai'        => 'HX72b7305e55e06d129a34794c6666f7f1',
            'twilio_tpl_admin_siap_terbit'         => 'HX91ba5051d69c2cbab1527caf9b5e156e',
            'twilio_tpl_pemohon_pengajuan_masuk'   => 'HXf963b32442235133f0adf7dbfb6edcf0',
            'twilio_tpl_pemohon_berkas_lengkap'    => 'HXd76acd3f3f92097fc99a6c5d6582f14f',
            'twilio_tpl_pemohon_berkas_revisi'     => 'HX160b664130c735c3a1248c74da06d8b1',
            'twilio_tpl_pemohon_pnbp_lunas'        => 'HX2e8ed627c7fa242d5a6003da25ea1741',
            'twilio_tpl_pemohon_jadwal_lokasi'     => 'HX30e47f7a001b0ae702204a05ebd54346',
            'twilio_tpl_pemohon_jadwal_rapat'      => 'HXdde8c3f0e34351b71406cc00dfd39962',
            'twilio_tpl_pemohon_dokumen_terbit'    => 'HXb9758a22a27c4f249225b5ab8435d0ff',
            'twilio_tpl_pemohon_informasi_layanan' => 'HX7e4005d5350a49c703d8c61f8cde8cc3',
        ];

        $settings = WaBlastHelper::getWhatsappSettingsStatic();

        $successCount = 0;
        $failCount = 0;

        foreach ($templates as $idx => $tpl) {
            if ($category !== 'all' && $tpl['category'] !== $category) {
                continue;
            }

            $sid = $settings[$tpl['key']] ?? ($defaultSids[$tpl['key']] ?? '');

            $this->output->write("Mengirim [{$tpl['name']}] ... ");

            $res = $waService->sendTemplateMessage($phone, $sid, $tpl['vars']);

            if ($res['success']) {
                $this->info("✅ BERHASIL (SID: {$res['sid']})");
                $successCount++;
            } else {
                $this->error("❌ GAGAL: " . $res['status']);
                $failCount++;
            }

            // Jeda 1.5 detik antar pengiriman agar antrean rapi
            usleep(1500000);
        }

        $this->newLine();
        $this->info("==============================================================");
        $this->line("Total Berhasil : <fg=green>{$successCount}</>");
        $this->line("Total Gagal    : <fg=red>{$failCount}</>");
        $this->info("==============================================================");

        return $failCount === 0 ? 0 : 1;
    }
}

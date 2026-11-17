<?php

namespace App\Console\Commands;

use App\Models\PpkprBerusahaApplication;
use App\Traits\WaBlastHelper;
use Illuminate\Console\Command;

class TestTwilioCredential extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twilio:test-credential {id=46 : ID Permohonan Berusaha}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uji coba tembak WhatsApp Kredensial Akun (Username & Sandi) ke Pemohon untuk permohonan tertentu';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');
        $app = PpkprBerusahaApplication::with('user')->find($id);

        if (!$app) {
            $this->error("Permohonan Berusaha ID #{$id} tidak ditemukan di database!");
            return 1;
        }

        $phone = $app->user->phone_number ?? '';
        if (empty($phone)) {
            $this->error("Pemohon pada permohonan ID #{$id} tidak memiliki nomor telepon!");
            return 1;
        }

        $nama = $app->nama_pengaju ?: ($app->user->name ?? ($app->user->username ?? 'Pemohon'));
        $noBerkas = !empty($app->no_berkas) ? $app->no_berkas : '2026/BPN-KOTA-SMI/' . str_pad($app->id, 3, '0', STR_PAD_LEFT);
        if (empty($app->no_berkas)) {
            $app->no_berkas = $noBerkas;
        }

        $url = "https://patenpakmiko.com/berusaha/{$app->id}";

        $this->newLine();
        $this->info("==============================================================");
        $this->info("   UJI COBA TEMBAK WHATSAPP KREDENSIAL LOGIN AKUN (SSH)      ");
        $this->info("==============================================================");
        $this->line("Permohonan ID : <fg=yellow>#{$app->id}</>");
        $this->line("Nama Pemohon  : <fg=yellow>{$nama}</>");
        $this->line("Nomor Tujuan  : <fg=yellow>{$phone}</>");
        $this->line("No. Berkas    : <fg=yellow>{$noBerkas}</>");
        $this->newLine();

        $this->output->write("Mengirim notifikasi akun via Twilio WhatsApp resmi ... ");

        WaBlastHelper::dispatchTwilioPemohonTemplate(
            $phone,
            'credential',
            $app,
            'Pertimbangan Teknis Pertanahan PKKPR Berusaha',
            $url,
            '085724455503'
        );

        $this->info("✅ SELESAI!");
        $this->newLine();
        $this->line("Silakan cek WhatsApp pada nomor <fg=green>{$phone}</> sekarang!");
        $this->info("==============================================================");

        return 0;
    }
}

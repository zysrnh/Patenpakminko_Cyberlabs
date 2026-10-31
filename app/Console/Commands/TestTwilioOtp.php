<?php

namespace App\Console\Commands;

use App\Services\WhatsappService;
use Illuminate\Console\Command;

class TestTwilioOtp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twilio:test-otp {phone : Nomor tujuan (misal 0812xxxx atau 62812xxxx)} {otp? : Kode OTP (default acak 6 digit)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim pesan uji coba OTP WhatsApp menggunakan Twilio Content Template (HX0b7d9a5ca52ebc88204445328ee24569)';

    /**
     * Execute the console command.
     */
    public function handle(WhatsappService $waService)
    {
        $phone = $this->argument('phone');
        $otp = $this->argument('otp') ?? (string) rand(100000, 999999);

        $this->info("Menyiapkan pengiriman OTP ke: {$phone}");
        $this->info("Kode OTP: {$otp}");
        $this->info("Template SID: HX0b7d9a5ca52ebc88204445328ee24569 (Approved Meta)");

        $result = $waService->sendOtpTemplate($phone, $otp);

        $this->newLine();
        if ($result['success']) {
            $this->info("✅ Berhasil dikirim!");
            $this->line("Status: " . $result['status']);
            $this->line("Message SID: " . ($result['sid'] ?? '-'));
        } else {
            $this->error("❌ Pengiriman gagal / status penolakan:");
            $this->line("Status: " . $result['status']);
            if (isset($result['response'])) {
                $this->line("Detail response Twilio: " . json_encode($result['response'], JSON_PRETTY_PRINT));
            }
        }

        return $result['success'] ? 0 : 1;
    }
}

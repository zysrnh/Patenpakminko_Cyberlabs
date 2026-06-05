<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

/**
 * WhatsappService — Abstraksi multi-provider pengiriman notifikasi WhatsApp/SMS.
 *
 * Provider yang didukung:
 *  - fonnte : Fonnte API (https://fonnte.com) — default
 *  - twilio : Twilio WhatsApp/SMS API
 *
 * Pengaturan dibaca dari storage/app/whatsapp_settings.json
 */
class WhatsappService
{
    protected array $settings;

    public function __construct()
    {
        $this->settings = $this->loadSettings();
    }

    /* ──────────────────────────────────────────────────────────── */
    /*  PUBLIC                                                       */
    /* ──────────────────────────────────────────────────────────── */

    /**
     * Kirim pesan WA/SMS ke satu nomor.
     *
     * @param  string $phone    Nomor tujuan (format bebas: 081x, +62x, dll)
     * @param  string $message  Isi pesan teks
     * @return array  ['success' => bool, 'status' => string, 'provider' => string]
     */
    public function send(string $phone, string $message): array
    {
        $provider = $this->settings['provider'] ?? 'fonnte';

        $phone = $this->normalizePhone($phone);

        return match ($provider) {
            'twilio' => $this->sendViaTwilio($phone, $message),
            default  => $this->sendViaFonnte($phone, $message),
        };
    }

    /**
     * Kembalikan provider yang aktif.
     */
    public function activeProvider(): string
    {
        return $this->settings['provider'] ?? 'fonnte';
    }

    /**
     * Kembalikan settings lengkap (untuk dipakai di UI admin).
     */
    public function getSettings(): array
    {
        return $this->settings;
    }

    /* ──────────────────────────────────────────────────────────── */
    /*  PROVIDER: FONNTE                                             */
    /* ──────────────────────────────────────────────────────────── */

    private function sendViaFonnte(string $phone, string $message): array
    {
        $token = $this->settings['fonnte_token'] ?? '';

        if (empty($token)) {
            return ['success' => false, 'status' => 'Simulasi (Token Fonnte kosong)', 'provider' => 'fonnte'];
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 20,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => ['target' => $phone, 'message' => $message],
            CURLOPT_HTTPHEADER     => ['Authorization: ' . $token],
        ]);

        $response = curl_exec($curl);
        $err      = curl_error($curl);
        curl_close($curl);

        if ($err) {
            Log::error('[WA-Fonnte] cURL error: ' . $err);
            return ['success' => false, 'status' => 'Gagal (Koneksi Fonnte Error)', 'provider' => 'fonnte'];
        }

        $decoded = json_decode($response, true);
        $ok      = $decoded['status'] ?? false;

        return [
            'success'  => (bool) $ok,
            'status'   => $ok ? 'Terkirim (Fonnte)' : 'Gagal (Fonnte: ' . ($decoded['reason'] ?? 'Token Error') . ')',
            'provider' => 'fonnte',
        ];
    }

    /* ──────────────────────────────────────────────────────────── */
    /*  PROVIDER: TWILIO                                            */
    /* ──────────────────────────────────────────────────────────── */

    private function sendViaTwilio(string $phone, string $message): array
    {
        $accountSid = $this->settings['twilio_account_sid'] ?? '';
        $authToken  = $this->settings['twilio_auth_token']  ?? '';
        $fromNumber = $this->settings['twilio_from_number'] ?? '';
        $useWhatsapp = ($this->settings['twilio_channel'] ?? 'whatsapp') === 'whatsapp';

        if (empty($accountSid) || empty($authToken) || empty($fromNumber)) {
            return ['success' => false, 'status' => 'Simulasi (Twilio belum dikonfigurasi)', 'provider' => 'twilio'];
        }

        // Twilio: format +6281xxx
        $to   = $useWhatsapp ? 'whatsapp:+' . $phone : '+' . $phone;
        $from = $useWhatsapp ? 'whatsapp:' . $fromNumber : $fromNumber;

        $url     = "https://api.twilio.com/2010-04-01/Accounts/{$accountSid}/Messages.json";
        $payload = http_build_query(['To' => $to, 'From' => $from, 'Body' => $message]);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 20,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_USERPWD        => $accountSid . ':' . $authToken,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/x-www-form-urlencoded'],
        ]);

        $response = curl_exec($curl);
        $err      = curl_error($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($err) {
            Log::error('[WA-Twilio] cURL error: ' . $err);
            return ['success' => false, 'status' => 'Gagal (Koneksi Twilio Error)', 'provider' => 'twilio'];
        }

        $decoded = json_decode($response, true);
        $ok      = isset($decoded['sid']) && $httpCode >= 200 && $httpCode < 300;

        return [
            'success'  => $ok,
            'status'   => $ok ? 'Terkirim (Twilio)' : 'Gagal (Twilio: ' . ($decoded['message'] ?? 'HTTP ' . $httpCode) . ')',
            'provider' => 'twilio',
        ];
    }

    /* ──────────────────────────────────────────────────────────── */
    /*  HELPERS                                                      */
    /* ──────────────────────────────────────────────────────────── */

    /**
     * Normalisasi nomor telepon ke format 62xxxxxxx (tanpa +, tanpa strip).
     */
    private function normalizePhone(string $phone): string
    {
        $clean = preg_replace('/[^0-9]/', '', $phone);

        if (str_starts_with($clean, '0')) {
            $clean = '62' . substr($clean, 1);
        } elseif (!str_starts_with($clean, '62')) {
            $clean = '62' . $clean;
        }

        return $clean;
    }

    private function loadSettings(): array
    {
        $path = storage_path('app/whatsapp_settings.json');

        if (!file_exists($path)) {
            return [];
        }

        return json_decode(file_get_contents($path), true) ?? [];
    }
}

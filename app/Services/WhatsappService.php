<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * WhatsappService — Abstraksi multi-provider pengiriman notifikasi WhatsApp/SMS.
 *
 * Provider yang didukung:
 *  - fonnte : Fonnte API (https://fonnte.com)
 *  - twilio : Twilio WhatsApp/SMS API (Support Twilio Content Template)
 *
 * Pengaturan dibaca dari storage/app/whatsapp_settings.json atau environment.
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
     * Kirim pesan WA/SMS ke satu nomor (Teks Biasa).
     *
     * @param  string $phone    Nomor tujuan (format bebas: 081x, +62x, dll)
     * @param  string $message  Isi pesan teks
     * @return array  ['success' => bool, 'status' => string, 'provider' => string]
     */
    public function send(string $phone, string $message): array
    {
        $provider = $this->settings['provider'] ?? 'twilio';
        $normalizedPhone = $this->normalizePhone($phone);

        $result = match ($provider) {
            'fonnte' => $this->sendViaFonnte($normalizedPhone, $message),
            default  => $this->sendViaTwilio($normalizedPhone, $message),
        };

        $this->writeLog($phone, $message, $result['status'] ?? 'Selesai');

        return $result;
    }

    /**
     * Kirim OTP menggunakan Twilio Content Template (WhatsApp Authentication).
     * Template SID: HX0b7d9a5ca52ebc88204445328ee24569 (Approved Meta).
     *
     * @param  string $phone  Nomor tujuan (format bebas)
     * @param  string $otp    Kode verifikasi (misal: 6 digit)
     * @return array  ['success' => bool, 'status' => string, 'provider' => string, 'sid' => ?string]
     */
    public function sendOtpTemplate(string $phone, string $otp): array
    {
        $normalizedPhone = $this->normalizePhone($phone);
        $accountSid = $this->settings['twilio_account_sid'] ?? env('TWILIO_ACCOUNT_SID', '');
        $authToken  = $this->settings['twilio_auth_token']  ?? env('TWILIO_AUTH_TOKEN', '');
        $fromNumber = $this->settings['twilio_from_number'] ?? env('TWILIO_FROM_NUMBER', '+6285724455503');
        $contentSid = $this->settings['twilio_otp_content_sid'] ?? env('TWILIO_OTP_CONTENT_SID', 'HX0b7d9a5ca52ebc88204445328ee24569');

        if (empty($accountSid) || empty($authToken)) {
            $msg = 'Simulasi OTP (Twilio Auth Token belum diisi di settings/env)';
            $this->writeLog($phone, "OTP: {$otp} (Template {$contentSid})", $msg);
            return [
                'success'  => false,
                'status'   => $msg,
                'provider' => 'twilio',
                'sid'      => null,
            ];
        }

        // Format nomor untuk Twilio WhatsApp
        $fromNumberClean = '+' . preg_replace('/[^0-9]/', '', $fromNumber);
        $to   = 'whatsapp:+' . $normalizedPhone;
        $from = 'whatsapp:' . $fromNumberClean;

        $url = "https://api.twilio.com/2010-04-01/Accounts/{$accountSid}/Messages.json";
        $payload = [
            'To'               => $to,
            'From'             => $from,
            'ContentSid'       => $contentSid,
            'ContentVariables' => json_encode(['1' => (string) $otp]),
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 25,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => http_build_query($payload),
            CURLOPT_USERPWD        => $accountSid . ':' . $authToken,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/x-www-form-urlencoded'],
        ]);

        $response = curl_exec($curl);
        $err      = curl_error($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($err) {
            Log::error('[Twilio-OTP] cURL error: ' . $err);
            $statusText = 'Gagal (Koneksi Twilio cURL Error)';
            $this->writeLog($phone, "OTP: {$otp} (Template {$contentSid})", $statusText);
            return ['success' => false, 'status' => $statusText, 'provider' => 'twilio', 'sid' => null];
        }

        $decoded = json_decode($response, true);
        $isOk = isset($decoded['sid']) && $httpCode >= 200 && $httpCode < 300;
        $statusText = $isOk 
            ? 'Terkirim via Twilio Template (' . $decoded['sid'] . ')' 
            : 'Gagal Twilio: ' . ($decoded['message'] ?? 'HTTP ' . $httpCode);

        $this->writeLog($phone, "OTP: {$otp} (Template {$contentSid})", $statusText);

        return [
            'success'  => $isOk,
            'status'   => $statusText,
            'provider' => 'twilio',
            'sid'      => $decoded['sid'] ?? null,
            'response' => $decoded,
        ];
    }

    /**
     * Kembalikan provider yang aktif.
     */
    public function activeProvider(): string
    {
        return $this->settings['provider'] ?? 'twilio';
    }

    /**
     * Kembalikan settings lengkap.
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
        $accountSid = $this->settings['twilio_account_sid'] ?? env('TWILIO_ACCOUNT_SID', '');
        $authToken  = $this->settings['twilio_auth_token']  ?? env('TWILIO_AUTH_TOKEN', '');
        $fromNumber = $this->settings['twilio_from_number'] ?? env('TWILIO_FROM_NUMBER', '+6285724455503');
        $useWhatsapp = ($this->settings['twilio_channel'] ?? 'whatsapp') === 'whatsapp';

        if (empty($accountSid) || empty($authToken) || empty($fromNumber)) {
            return ['success' => false, 'status' => 'Simulasi (Twilio belum dikonfigurasi)', 'provider' => 'twilio'];
        }

        $fromNumberClean = '+' . preg_replace('/[^0-9]/', '', $fromNumber);
        $to   = $useWhatsapp ? 'whatsapp:+' . $phone : '+' . $phone;
        $from = $useWhatsapp ? 'whatsapp:' . $fromNumberClean : $fromNumberClean;

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
    public function normalizePhone(string $phone): string
    {
        $clean = preg_replace('/[^0-9]/', '', $phone);

        if (str_starts_with($clean, '0')) {
            $clean = '62' . substr($clean, 1);
        } elseif (!str_starts_with($clean, '62')) {
            $clean = '62' . $clean;
        }

        return $clean;
    }

    /**
     * Catat log pengiriman WhatsApp ke storage/app/whatsapp_logs.json.
     */
    private function writeLog(string $phone, string $message, string $status): void
    {
        try {
            $logPath = storage_path('app/whatsapp_logs.json');
            $logs = [];
            if (file_exists($logPath)) {
                $logs = json_decode(file_get_contents($logPath), true) ?: [];
            }

            array_unshift($logs, [
                'id'        => uniqid(),
                'recipient' => $phone,
                'message'   => $message,
                'timestamp' => now()->format('d M Y, H:i:s'),
                'status'    => $status,
            ]);

            // Simpan maksimal 100 log terakhir
            if (count($logs) > 100) {
                $logs = array_slice($logs, 0, 100);
            }

            file_put_contents($logPath, json_encode($logs, JSON_PRETTY_PRINT));
        } catch (\Throwable $e) {
            Log::warning('[WhatsappService] Gagal mencatat log: ' . $e->getMessage());
        }
    }

    private function loadSettings(): array
    {
        $settings = [];
        if (Storage::disk('local')->exists('whatsapp_settings.json')) {
            $settings = json_decode(Storage::disk('local')->get('whatsapp_settings.json'), true) ?? [];
        }
        if (empty($settings)) {
            $path = storage_path('app/whatsapp_settings.json');
            if (file_exists($path)) {
                $settings = json_decode(file_get_contents($path), true) ?? [];
            }
        }
        return $settings;
    }
}

import os
import re

file_path = r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\app\Http\Controllers\LapolpaController.php'

with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Replace Template 1 (Booking Notification)
old_template_1 = """$messagePemohon = "Halo {$pemohonName},\\n\\nJadwal pelaporan LAPOLPAK Anda berhasil terdaftar dengan status BOOKED!\\n\\n"
                        . "🗓️ Tanggal: {$tglIndo}\\n"
                        . "⏰ Waktu: {$rentangWaktu}\\n"
                        . "📱 WhatsApp terdaftar: {$booking->whatsapp_number}\\n\\n"
                        . "*PANDUAN PELAPORAN LAPOLPAK UTK PEMOHON*:\\n"
                        . "1. Hadir tepat waktu sesuai jadwal yang telah Anda pilih.\\n"
                        . "2. Siapkan dokumen identitas diri (KTP) asli.\\n"
                        . "3. Bawa cetakan dokumen permohonan PPKPR/izin terkait.\\n"
                        . "4. Pastikan nomor WhatsApp Anda aktif selama proses pelaporan berlangsung.\\n\\n"
                        . "Lacak bukti booking Anda di dashboard: {$url}";"""

new_template_1 = """$messagePemohon = "Halo *{$pemohonName}*,\\n\\n"
                        . "Terima kasih! Jadwal pelaporan LAPOLPAK Anda telah berhasil didaftarkan dengan status *BOOKED*.\\n\\n"
                        . "Rincian Jadwal:\\n"
                        . "🗓️ Tanggal: {$tglIndo}\\n"
                        . "⏰ Waktu: {$rentangWaktu}\\n"
                        . "📱 WhatsApp: {$booking->whatsapp_number}\\n\\n"
                        . "📌 *PANDUAN PELAPORAN LAPOLPAK*:\\n"
                        . "1. Mohon hadir tepat waktu sesuai jadwal yang telah dipilih.\\n"
                        . "2. Siapkan dokumen identitas diri (KTP) asli.\\n"
                        . "3. Bawa cetakan fisik dokumen permohonan PPKPR/izin terkait.\\n"
                        . "4. Pastikan nomor WhatsApp Anda selalu aktif selama proses berlangsung.\\n\\n"
                        . "Lacak bukti pemesanan Anda melalui tautan berikut:\\n{$url}";"""

content = content.replace(old_template_1, new_template_1)

# Replace Template 2 (Status Update Notification)
old_template_2 = """$message = "Halo {$pemohonName},\\n\\nStatus pelaporan LAPOLPAK Anda untuk tanggal {$tglIndo} ({$rentangWaktu}) telah diubah oleh petugas menjadi:\\n"
                 . "*{$statusLabel}*\\n\\n";

        if ($booking->admin_note) {
            $message .= "Catatan dari Petugas:\\n_{$booking->admin_note}_\\n\\n";
        }

        $message .= "Terima kasih atas kerja sama Anda.\\n"
                 . "Lacak detail selengkapnya di: " . route('lapolpa.index');"""

new_template_2 = """$message = "Halo *{$pemohonName}*,\\n\\n"
                 . "Berikut adalah pembaruan status jadwal pelaporan LAPOLPAK Anda pada tanggal *{$tglIndo} ({$rentangWaktu})*.\\n\\n"
                 . "Status saat ini: *{$statusLabel}*\\n\\n";

        if ($booking->admin_note) {
            $message .= "📝 *Catatan Petugas:*\\n_{$booking->admin_note}_\\n\\n";
        }

        $message .= "Terima kasih atas partisipasi dan kerja sama Anda.\\n"
                 . "Untuk melihat detail selengkapnya, silakan akses tautan berikut:\\n"
                 . route('lapolpa.index');"""

content = content.replace(old_template_2, new_template_2)

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(content)
print("Updated LapolpaController WA templates.")

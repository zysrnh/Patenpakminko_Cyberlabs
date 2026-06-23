import os
import re

file_path = r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\app\Http\Controllers\LapolpaController.php'

with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Replace Template 2 (Status Update Notification) again based on user's new copy
old_template_2 = """$message = "Halo *{$pemohonName}*,\\n\\n"
                 . "Berikut adalah pembaruan status jadwal pelaporan LAPOLPAK Anda pada tanggal *{$tglIndo} ({$rentangWaktu})*.\\n\\n"
                 . "Status saat ini: *{$statusLabel}*\\n\\n";

        if ($booking->admin_note) {
            $message .= "📝 *Catatan Petugas:*\\n_{$booking->admin_note}_\\n\\n";
        }

        $message .= "Terima kasih atas partisipasi dan kerja sama Anda.\\n"
                 . "Untuk melihat detail selengkapnya, silakan akses tautan berikut:\\n"
                 . route('lapolpa.index');"""

new_template_2 = """$message = "Halo *{$pemohonName}*,\\n\\n"
                 . "Status Permohonan Fitur LAPOL PAK Anda untuk tanggal *{$tglIndo} ({$rentangWaktu})* telah diubah menjadi: *{$statusLabel}* oleh Kantor Pertanahan Sukabumi.\\n\\n";

        if ($booking->admin_note) {
            $message .= "Catatan dari Petugas:\\n_{$booking->admin_note}_\\n\\n";
        }

        $message .= "Terima kasih atas kerja sama Anda.\\n"
                 . "Lacak detail selengkapnya di: " . route('lapolpa.index');"""

content = content.replace(old_template_2, new_template_2)

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(content)
print("Updated LapolpaController WA templates to match exact user request.")

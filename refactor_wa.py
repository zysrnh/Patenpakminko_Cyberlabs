import os
import re

CONTROLLERS = [
    'app/Http/Controllers/PpkprBerusahaController.php',
    'app/Http/Controllers/PpkprNonBerusahaController.php',
    'app/Http/Controllers/PsnController.php',
    'app/Http/Controllers/KebijakanController.php',
    'app/Http/Controllers/TanahTimbulController.php'
]

LAYANAN_MAP = {
    'PpkprBerusahaController.php': 'PPKPR Berusaha',
    'PpkprNonBerusahaController.php': 'PPKPR Non-Berusaha',
    'PsnController.php': 'PSN (Proyek Strategis Nasional)',
    'KebijakanController.php': 'Kebijakan Khusus',
    'TanahTimbulController.php': 'Tanah Timbul'
}

for path in CONTROLLERS:
    if not os.path.exists(path):
        continue
    
    with open(path, 'r', encoding='utf-8') as f:
        content = f.read()
    
    filename = os.path.basename(path)
    layanan_name = LAYANAN_MAP.get(filename, 'Layanan')
    
    # 1. Add Trait use
    if 'use App\\Traits\\WaBlastHelper;' not in content:
        content = re.sub(r'(class\s+\w+\s+extends\s+Controller\s*\{)', r'\1\n    use \\App\\Traits\\WaBlastHelper;\n', content)
    
    # 2. Replace sendCustomWa / sendCustomWhatsappNotification
    func_name = 'sendCustomWa'
    if 'sendCustomWhatsappNotification' in content:
        func_name = 'sendCustomWhatsappNotification'
    
    pattern = r'(private function ' + func_name + r'\s*\(.*?\$.*?\$.*?\)\s*\{)(.*?)(private function executeFonnteSend)'
    
    # The new body
    new_body = r"""
        $settings = $this->getWhatsappSettings();
        if (!($settings['connected'] ?? false)) return;

        $app = func_get_arg(0);
        $type = func_get_arg(1);
        
        $url = url('/dashboard'); // simplified
        if(method_exists($app, 'id')) {
            // Assume route names: berusaha.show, non_berusaha.show, psn.show, kebijakan.show, tanah_timbul.show
            $routeName = strtolower(str_replace('Controller', '', class_basename($this)));
            if ($routeName === 'ppkprberusaha') $routeName = 'berusaha';
            if ($routeName === 'ppkprnonberusaha') $routeName = 'non_berusaha';
            if ($routeName === 'tanahtimbul') $routeName = 'tanah_timbul';
            $url = route($routeName . '.show', $app->id);
        }

        $msg = $this->generateWaMessage($type, $app, '""" + layanan_name + r"""', $url);
        
        $pemohon = $app->user->phone_number ?? '';

        if ($msg && $pemohon) {
            if (!empty($settings['cp_admin'])) {
                $msg .= "\n\n_Jika ada pertanyaan, hubungi CP Admin: " . $settings['cp_admin'] . "_";
            }
            $this->executeFonnteSend($pemohon, $msg);
        }

        // Notifikasi Internal Antar Instansi
        $no_berkas_text = !empty($app->no_berkas) ? " (No. Berkas: {$app->no_berkas})" : "";
        $nama = $app->nama_pengaju ?: ($app->user->name ?? ($app->user->username ?? ''));
        
        $adminBpn = $settings['admin_bpn'] ?? '';
        $adminPutr = $settings['admin_putr'] ?? '';
        $adminPu = $settings['admin_dinas_pu'] ?? '';
        $adminPtsp = $settings['admin_satu_pintu'] ?? '';

        // 1. Pendaftaran Baru
        if (($type === 'submit' || $type === 'submit_berkas') && $adminBpn) {
            $this->executeFonnteSend($adminBpn, "Halo Admin Kantor Pertanahan, ada pengajuan permohonan baru untuk """ + layanan_name + r""" atas nama {$nama}. Silakan login untuk melakukan verifikasi berkas awal di: {$url}");
        }
        // 2. Bukti Bayar PNBP
        if ($type === 'credential' && $adminBpn) {
            $this->executeFonnteSend($adminBpn, "Halo Admin Kantor Pertanahan, pemohon atas nama {$nama} telah selesai melakukan pembayaran PNBP untuk layanan """ + layanan_name + r""". Silakan login untuk verifikasi bayar dan aktifkan akun pemohon di: {$url}");
        }
        // 3. PUTR -> Saat BPN terbit Pertek
        if ($type === 'pertek_terbit' && $adminPutr) {
            $this->executeFonnteSend($adminPutr, "Notifikasi Dinas PUTR: Pertimbangan Teknis Pertanahan (PTP) untuk """ + layanan_name + r"""{$no_berkas_text} telah terbit dari Kantor Pertanahan. Silakan lakukan penilaian PKKPR di: {$url}");
        }
        // 4. PTSP -> Saat PUTR Selesai
        if ($type === 'pu_selesai' && $adminPtsp) {
            $this->executeFonnteSend($adminPtsp, "Notifikasi Satu Pintu: Penilaian Dinas PUTR untuk """ + layanan_name + r"""{$no_berkas_text} selesai. Silakan proses penerbitan PKKPR di: {$url}");
        }
        // 5. Kembali ke BPN -> Tunggu PTSP
        if ($type === 'pu_selesai' && $adminBpn) {
            $this->executeFonnteSend($adminBpn, "Notifikasi Kantor Pertanahan: Dinas PUTR telah selesai menilai """ + layanan_name + r"""{$no_berkas_text}. Menunggu penerbitan PKKPR oleh DPMPTSP / Satu Pintu.");
        }
    }

    """
    
    content = re.sub(pattern, r'\1' + new_body + r'\3', content, flags=re.DOTALL)
    
    with open(path, 'w', encoding='utf-8') as f:
        f.write(content)
    
    print(f"Refactored {filename}")

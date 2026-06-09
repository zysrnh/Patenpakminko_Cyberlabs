import os

CONTROLLERS = [
    'PsnController.php',
    'KebijakanController.php',
    'TanahTimbulController.php'
]

LAYANAN_MAP = {
    'PsnController.php': 'PSN (Proyek Strategis Nasional)',
    'KebijakanController.php': 'Kebijakan Khusus',
    'TanahTimbulController.php': 'Tanah Timbul'
}

for c in CONTROLLERS:
    p = 'app/Http/Controllers/' + c
    with open(p, 'r', encoding='utf-8') as f: txt = f.read()
    
    layanan_name = LAYANAN_MAP[c]
    
    if 'use App\\Traits\\WaBlastHelper;' not in txt:
        txt = txt.replace('extends Controller\n{', 'extends Controller\n{\n    use \\App\\Traits\\WaBlastHelper;\n')
    
    func_name = 'sendCustomWhatsappNotification' if 'sendCustomWhatsappNotification' in txt else 'sendCustomWa'
    start_idx = txt.find('private function ' + func_name)
    if start_idx == -1: continue
    
    end_idx = txt.find('private function executeFonnteSend', start_idx)
    if end_idx == -1: continue
    
    new_func = f'''private function {func_name}($app, $type)
    {{
        $settings = $this->getWhatsappSettings();
        if (!($settings['connected'] ?? false)) return;

        $url = url('/dashboard');
        if(method_exists($app, 'id')) {{
            $routeName = strtolower(str_replace('Controller', '', class_basename($this)));
            if ($routeName === 'ppkprberusaha') $routeName = 'berusaha';
            if ($routeName === 'ppkprnonberusaha') $routeName = 'non_berusaha';
            if ($routeName === 'tanahtimbul') $routeName = 'tanah_timbul';
            $url = route($routeName . '.show', $app->id);
        }}

        $msg = $this->generateWaMessage($type, $app, '{layanan_name}', $url);
        
        $pemohon = $app->user->phone_number ?? '';

        if ($msg && $pemohon) {{
            if (!empty($settings['cp_admin'])) {{
                $msg .= "\\n\\n_Jika ada pertanyaan, hubungi CP Admin: " . $settings['cp_admin'] . "_";
            }}
            $this->executeFonnteSend($pemohon, $msg);
        }}

        // Notifikasi Internal Antar Instansi
        $no_berkas_text = !empty($app->no_berkas) ? " (No. Berkas: {{$app->no_berkas}})" : "";
        $nama = $app->nama_pengaju ?: ($app->user->name ?? ($app->user->username ?? ''));
        
        $adminBpn = $settings['admin_bpn'] ?? '';
        $adminPutr = $settings['admin_putr'] ?? '';
        $adminPtsp = $settings['admin_satu_pintu'] ?? '';

        if (($type === 'submit' || $type === 'submit_berkas') && $adminBpn) {{
            $this->executeFonnteSend($adminBpn, "Halo Admin Kantor Pertanahan, ada pengajuan permohonan baru untuk {layanan_name} atas nama {{$nama}}. Silakan login untuk melakukan verifikasi berkas awal di: {{$url}}");
        }}
        if ($type === 'credential' && $adminBpn) {{
            $this->executeFonnteSend($adminBpn, "Halo Admin Kantor Pertanahan, pemohon atas nama {{$nama}} telah selesai melakukan pembayaran PNBP untuk layanan {layanan_name}. Silakan login untuk verifikasi bayar dan aktifkan akun pemohon di: {{$url}}");
        }}
        if ($type === 'pertek_terbit' && $adminPutr) {{
            $this->executeFonnteSend($adminPutr, "Notifikasi Dinas PUTR: Pertimbangan Teknis Pertanahan (PTP) untuk {layanan_name}{{$no_berkas_text}} telah terbit dari Kantor Pertanahan. Silakan lakukan penilaian PKKPR di: {{$url}}");
        }}
        if ($type === 'pu_selesai' && $adminPtsp) {{
            $this->executeFonnteSend($adminPtsp, "Notifikasi Satu Pintu: Penilaian Dinas PUTR untuk {layanan_name}{{$no_berkas_text}} selesai. Silakan proses penerbitan PKKPR di: {{$url}}");
        }}
        if ($type === 'pu_selesai' && $adminBpn) {{
            $this->executeFonnteSend($adminBpn, "Notifikasi Kantor Pertanahan: Dinas PUTR telah selesai menilai {layanan_name}{{$no_berkas_text}}. Menunggu penerbitan PKKPR oleh DPMPTSP / Satu Pintu.");
        }}
    }}

    '''
    
    txt = txt[:start_idx] + new_func + txt[end_idx:]
    with open(p, 'w', encoding='utf-8') as f: f.write(txt)
    print(f'Refactored {c}')

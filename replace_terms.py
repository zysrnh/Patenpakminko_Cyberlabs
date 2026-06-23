import os

directories = [
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\app\Http\Controllers\WaTemplateController.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\app\Http\Controllers\AuthController.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\app\Http\Controllers\RevisiController.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\template_wa.txt',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\template_whatsapp_blast.txt',
]

def process_content(content):
    new_content = content
    
    # 1. PU -> PUTR
    new_content = new_content.replace('Dinas PU (Tata Ruang)', 'Dinas Pekerjaan Umum dan Tata Ruang (PUTR)')
    new_content = new_content.replace('Dinas PU/PUTR', 'Dinas Pekerjaan Umum dan Tata Ruang (PUTR)')
    new_content = new_content.replace('Dinas PU', 'Dinas Pekerjaan Umum dan Tata Ruang (PUTR)')
    new_content = new_content.replace('Dinas PUTR', 'Dinas Pekerjaan Umum dan Tata Ruang (PUTR)')
    new_content = new_content.replace('Dinas Pekerjaan Umum dan Tata Ruang (PUTR)TR', 'Dinas Pekerjaan Umum dan Tata Ruang (PUTR)')
    new_content = new_content.replace('Dinas Pekerjaan Umum dan Tata Ruang (PUTR) (Tata Ruang)', 'Dinas Pekerjaan Umum dan Tata Ruang (PUTR)')
    
    # 2. BPN -> Kantor Pertanahan (BPN)
    new_content = new_content.replace('Kantor Pertanahan (BPN)', 'TEMP_BPN')
    new_content = new_content.replace('Kantor Pertanahan', 'TEMP_BPN')
    new_content = new_content.replace('Petugas BPN', 'Petugas TEMP_BPN')
    new_content = new_content.replace('Layanan BPN', 'Layanan TEMP_BPN')
    new_content = new_content.replace('Admin BPN', 'Admin TEMP_BPN')
    new_content = new_content.replace('Dashboard BPN', 'Dashboard TEMP_BPN')
    new_content = new_content.replace('Portal BPN', 'Portal TEMP_BPN')
    new_content = new_content.replace('Catatan BPN', 'Catatan TEMP_BPN')
    new_content = new_content.replace('oleh BPN', 'oleh TEMP_BPN')
    new_content = new_content.replace('dari BPN', 'dari TEMP_BPN')
    new_content = new_content.replace('Petugas lapangan BPN', 'Petugas lapangan TEMP_BPN')
    new_content = new_content.replace('BPN Pusat', 'TEMP_BPN Pusat')
    new_content = new_content.replace('Pertek BPN', 'Pertek TEMP_BPN')
    new_content = new_content.replace('Kantor TEMP_BPN', 'TEMP_BPN')
    new_content = new_content.replace('Petugas Kantor TEMP_BPN', 'Petugas TEMP_BPN')
    
    new_content = new_content.replace('TEMP_BPN', 'Kantor Pertanahan (BPN)')
    new_content = new_content.replace('Kantor Pertanahan (Kantor Pertanahan (BPN))', 'Kantor Pertanahan (BPN)')
    new_content = new_content.replace('Kantor Pertanahan (BPN) (BPN)', 'Kantor Pertanahan (BPN)')
    
    # 3. Non-Berusaha -> Non Berusaha
    new_content = new_content.replace('PPKPR Non-Berusaha', 'PPKPR Non Berusaha')
    new_content = new_content.replace('Permohonan Non-Berusaha', 'Permohonan Non Berusaha')
    new_content = new_content.replace('Layanan Non-Berusaha', 'Layanan Non Berusaha')
    new_content = new_content.replace('Non-Berusaha', 'Non Berusaha')
    
    new_content = new_content.replace('non berusaha.show', 'non-berusaha.show')
    new_content = new_content.replace('non berusaha.verify', 'non-berusaha.verify')
    new_content = new_content.replace('non berusaha.ptp_pdf', 'non-berusaha.ptp_pdf')
    new_content = new_content.replace('route(\'non berusaha', 'route(\'non-berusaha')
    new_content = new_content.replace('type === \'non berusaha\'', 'type === \'non-berusaha\'')
    new_content = new_content.replace('type === "non berusaha"', 'type === "non-berusaha"')
    
    return new_content

def process_path(path):
    if os.path.isfile(path):
        with open(path, 'r', encoding='utf-8') as f:
            content = f.read()
        new_content = process_content(content)
        if new_content != content:
            with open(path, 'w', encoding='utf-8') as f:
                f.write(new_content)
            print('Updated:', path)
    elif os.path.isdir(path):
        for root, _, files in os.walk(path):
            for file in files:
                if file.endswith('.php') or file.endswith('.txt') or file.endswith('.blade.php'):
                    process_path(os.path.join(root, file))

for d in directories:
    process_path(d)

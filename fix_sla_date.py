import os

files = [
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\berusaha\show.blade.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\non-berusaha\show.blade.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\kebijakan\show.blade.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\tanah-timbul\show.blade.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\psn\show.blade.php'
]

for file in files:
    if os.path.exists(file):
        with open(file, 'r', encoding='utf-8') as f:
            content = f.read()
            
        old_line = "$targetDate = $application->created_at->addWeekdays(10);"
        new_line = "$targetDate = $application->tgl_selesai_layanan ? \Carbon\Carbon::parse($application->tgl_selesai_layanan) : $application->created_at->addWeekdays(10);"
        
        content = content.replace(old_line, new_line)
        
        with open(file, 'w', encoding='utf-8') as f:
            f.write(content)
        print('Fixed SLA in ' + file)

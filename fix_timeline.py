import os
import re

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
            
        # 1. Fix .timeline selector
        content = content.replace("document.querySelector('.timeline-body')", "document.querySelector('.timeline')")
        
        # 2. Remove the red warning text "(Tahap ini...)"
        content = re.sub(r'<div style="margin-top:12px; font-size:12\.5px; color:#c53030; font-weight: 700;">\(Tahap ini.*?</div>', '', content)
        
        with open(file, 'w', encoding='utf-8') as f:
            f.write(content)
        print('Fixed ' + file)

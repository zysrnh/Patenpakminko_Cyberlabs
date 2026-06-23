import os
import re

files = [
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\berusaha\index.blade.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\non-berusaha\index.blade.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\kebijakan\index.blade.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\tanah-timbul\index.blade.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\psn\index.blade.php'
]

for file in files:
    if os.path.exists(file):
        with open(file, 'r', encoding='utf-8') as f:
            content = f.read()
            
        old_str = "$hari = (int)$startDate->diffInDays($endDate);"
        new_str = "$hari = (int)$startDate->diffInWorkingDaysWithHolidays($endDate);"
        
        content = content.replace(old_str, new_str)
        
        with open(file, 'w', encoding='utf-8') as f:
            f.write(content)
        print('Updated index table SLA logic in ' + file)

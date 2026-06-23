import re

files = [
    r"d:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\kebijakan\show.blade.php",
    r"d:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\tanah-timbul\show.blade.php"
]

for filepath in files:
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    # 1. Remove panel-pu-1
    content = re.sub(r'@if\(\$user->isDinasPu\(\)\).*?<div id="panel-pu-1".*?@endif', '', content, flags=re.DOTALL)
    
    # 2. Remove left panel PU info
    content = re.sub(r'<!-- Dinas Pekerjaan Umum dan Tata Ruang \(PUTR\) Info -->.*?@endif\s*@endif', '', content, flags=re.DOTALL)

    # 3. Remove timeline step for PU
    # "<!-- STEP 6: Penilaian Pertimbangan Teknis Pertanahan Dinas Pekerjaan Umum dan Tata Ruang (PUTR) -->" to the end of its div
    content = re.sub(r'<!-- STEP 6: Penilaian Pertimbangan Teknis Pertanahan Dinas Pekerjaan Umum dan Tata Ruang \(PUTR\) -->.*?</div>\s*</div>', '', content, flags=re.DOTALL)

    # 4. Rename "6. Penerbitan Pertimbangan Teknis Pertanahan" to "5. Penerbitan Pertimbangan Teknis Pertanahan"
    content = content.replace("6. Penerbitan Pertimbangan Teknis Pertanahan", "5. Penerbitan Pertimbangan Teknis Pertanahan")

    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(content)
        print(f"Updated {filepath}")

print("Done.")

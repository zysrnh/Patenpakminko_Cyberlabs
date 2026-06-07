import re

with open('resources/views/auth/ptp-create.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Replace any img src with storage/assets or storage/svg with tandatanya.svg within the help banner context.
# Since there might be other images, let's be safe.
new_content = re.sub(
    r'<img src="\{\{\s*asset\(\'(?:storage/assets/help-illustration\.svg|storage/svg/illustrasi-bantuan\.svg)\'\)\s*\}\}".*?>',
    '''<img src="{{ asset('storage/svg/tandatanya.svg') }}" alt="Ilustrasi Bantuan">''',
    content
)

with open('resources/views/auth/ptp-create.blade.php', 'w', encoding='utf-8') as f:
    f.write(new_content)

print('Updated auth/ptp-create.blade.php')

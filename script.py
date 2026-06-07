import os, re

files = [
    'resources/views/berusaha/create.blade.php',
    'resources/views/non-berusaha/create.blade.php',
    'resources/views/kebijakan/create.blade.php',
    'resources/views/psn/create.blade.php',
    'resources/views/tanah-timbul/create.blade.php'
]

for f in files:
    with open(f, 'r', encoding='utf-8') as file:
        content = file.read()
    
    # 1. Update header structure
    pattern = re.compile(r'<div class="ptp-header-top">\s*<div>\s*<div class="ptp-layanan-label">.*?</div>\s*<div class="ptp-badge">\s*<div class="ptp-badge-text">\s*<span class="ptp-badge-name">(.*?)</span>\s*</div>\s*</div>\s*</div>\s*<a href="(.*?)" class="btn-kembali">\&larr; Kembali</a>\s*</div>', re.DOTALL)
    
    def replacer(match):
        badge_name = match.group(1).strip()
        back_link = match.group(2).strip()
        return f'''<div class="ptp-header-top">
            <div class="ptp-badge">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                <span class="ptp-badge-name">{badge_name}</span>
            </div>
            <a href="{back_link}" class="btn-kembali">&larr; Kembali</a>
        </div>'''

    new_content = pattern.sub(replacer, content)
    
    # 2. Update help banner image
    new_content = new_content.replace(
        '''<img src="{{ asset('storage/assets/help-illustration.svg') }}" alt="Ilustrasi Bantuan" onerror="this.src='https://ui-avatars.com/api/?name=Help&background=EAF3FA&color=3291A8&size=300'">''',
        '''<img src="{{ asset('storage/svg/tandatanya.svg') }}" alt="Ilustrasi Bantuan">'''
    )
    
    with open(f, 'w', encoding='utf-8') as file:
        file.write(new_content)

print('Updated 5 files.')

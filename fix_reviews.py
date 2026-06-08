import os

files = {
    'resources/views/kebijakan/show.blade.php': 'kebijakan',
    'resources/views/tanah-timbul/show.blade.php': 'tanah_timbul',
    'resources/views/psn/show.blade.php': 'psn'
}

for path, mod_type in files.items():
    with open(path, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # fix the hardcoded non_berusaha in where clause
    content = content.replace("->where('module_type', 'non_berusaha')", f"->where('module_type', '{mod_type}')")
    
    # fix the hidden input value
    content = content.replace('<input type="hidden" name="module_type" value="non_berusaha">', f'<input type="hidden" name="module_type" value="{mod_type}">')
    
    with open(path, 'w', encoding='utf-8') as f:
        f.write(content)

print("Fixed module_type for reviews!")

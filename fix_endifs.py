import os

def fix_endifs(filepath):
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    # Find the script tag for showBpnPanel
    script_str = "</script>"
    idx = content.find(script_str)
    if idx == -1:
        return
        
    idx += len(script_str)
    
    # After the script, we expect some whitespace, @endif, whitespace, </div>, whitespace, @endif
    # We want to remove the two @endifs.
    
    # We can just use a regex
    import re
    # We replace:
    #                     @endif
    #                 </div>
    #             @endif
    # 
    #             <div class="layout-grid">
    # With:
    #                 </div>
    #             <div class="layout-grid">
    
    pattern = re.compile(r"@endif\s*</div>\s*@endif\s*<div class=\"layout-grid\">")
    content = pattern.sub("</div>\n\n            <div class=\"layout-grid\">", content)
    
    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(content)

fix_endifs('resources/views/tanah-timbul/show.blade.php')
fix_endifs('resources/views/kebijakan/show.blade.php')

print("Fixed endifs")

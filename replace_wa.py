import re
import os

files = [
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\tanah-timbul\show.blade.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\non-berusaha\show.blade.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\berusaha\show.blade.php',
    r'd:\Gawe\Patenpakminko_Cyberlabs\Patenpakminko\resources\views\kebijakan\show.blade.php',
]

# The regex for wa-message-input
# Let's match flexible spacing
input_regex = r'<div class="form-group-v" style="margin-bottom:\s*12px;\s*border-top:\s*1px\s*dashed\s*var\(--clr-line\);\s*padding-top:\s*12px;\s*margin-top:\s*12px;">\s*<label style="font-size:\s*11\.5px;\s*color:\s*var\(--clr-muted\);\s*font-weight:\s*600;">✎ Edit Pesan WA \(Opsional\):</label>\s*<textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan otomatis..."></textarea>\s*</div>'

for fpath in files:
    if not os.path.exists(fpath): continue
    with open(fpath, 'r', encoding='utf-8') as f:
        content = f.read()

    # Replace wa-message-input
    content = re.sub(input_regex, '<x-wa-message-input />', content)

    # Now let's try to find wa-resend-form
    # We can match the form and extract route, wa_type, background color, and button text
    resend_regex = r'<form action="{{ (route\([^\)]+\)) }}" method="POST" style="margin-top:\s*16px;">\s*@csrf\s*<input type="hidden" name="step" value="resend_wa">\s*<input type="hidden" name="wa_type" value="([^"]+)">\s*<div class="form-group-v" style="margin-bottom:\s*12px;\s*text-align:\s*left;">\s*<label style="font-size:\s*11px;\s*color:\s*var\(--clr-muted\);">Edit Pesan WA \(Opsional\):</label>\s*<textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan..."></textarea>\s*</div>\s*<button type="submit" class="btn-submit-v" style="background:\s*([^;]+);\s*width:\s*100%;\s*justify-content:\s*center;">\s*<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2\.5">\s*<path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/>\s*</svg>\s*(.*?)\s*</button>\s*</form>'

    def replace_resend(match):
        route_call = match.group(1)
        wa_type = match.group(2)
        btn_color = match.group(3)
        btn_text = match.group(4).strip()
        
        # If waType has php tags like {{ ... }}, we need to pass it without quotes as expression, but wait, we can just use normal string if we pass it correctly.
        # Actually in Blade component, if it contains {{...}} we can't easily pass it as attribute string unless we use expression.
        # Let's check what waType might be.
        # In the regex `value="([^"]+)"`. If it's `{{ $application->status === 'ditolak' ? 'pertek_tolak' : 'pertek_terbit' }}`
        # Let's just output it exactly inside a string attribute if we can, or just keep the form as is if it's too complex.
        
        # Wait, Blade attributes with {{ }} inside quotes works fine: `waType="{{ $something }}"`
        # BUT waType might contain double quotes! Let's handle it safely.
        wa_type_safe = wa_type.replace('"', "&quot;")
        
        return f'<x-wa-resend-form route="{{{{ {route_call} }}}}" waType="{wa_type_safe}" btnColor="{btn_color}" btnText="{btn_text}" />'

    content = re.sub(resend_regex, replace_resend, content, flags=re.DOTALL)

    # Some forms might have margin-top: 12px; instead of 16px. Let's make it flexible.
    resend_regex_2 = r'<form action="{{ (route\([^\)]+\)) }}" method="POST" style="margin-top:\s*\d+px;\s*margin-bottom:\s*12px;">\s*@csrf\s*<input type="hidden" name="step" value="resend_wa">\s*<input type="hidden" name="wa_type" value="([^"]+)">\s*<div class="form-group-v" style="margin-bottom:\s*12px;\s*text-align:\s*left;">\s*<label style="font-size:\s*11px;\s*color:\s*var\(--clr-muted\);">Edit Pesan WA \(Opsional\):</label>\s*<textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan..."></textarea>\s*</div>\s*<button type="submit" class="btn-submit-v" style="background:\s*([^;]+);\s*width:\s*100%;\s*justify-content:\s*center;">\s*<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2\.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>\s*(.*?)\s*</button>\s*</form>'
    content = re.sub(resend_regex_2, replace_resend, content, flags=re.DOTALL)
    
    # Another pattern: `<form action="{{ route(...) }}" method="POST" style="margin-top: 16px;">` with some slightly different inner HTML:
    resend_regex_3 = r'<form action="{{ (route\([^\)]+\)) }}" method="POST" style="margin-top:\s*16px;">\s*@csrf\s*<input type="hidden" name="step" value="resend_wa">\s*<input type="hidden" name="wa_type" value="([^"]+)">\s*<div class="form-group-v" style="margin-top:\s*12px;\s*margin-bottom:\s*12px;\s*text-align:\s*left;">\s*<label style="font-size:\s*11px;\s*color:\s*var\(--clr-muted\);">Edit Pesan WA \(Opsional\):</label>\s*<textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan..."></textarea>\s*</div>\s*<button type="submit" class="btn-submit-v" style="background:\s*([^;]+);\s*width:\s*100%;\s*justify-content:\s*center;">\s*<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2\.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>\s*(.*?)\s*</button>\s*</form>'
    content = re.sub(resend_regex_3, replace_resend, content, flags=re.DOTALL)


    with open(fpath, 'w', encoding='utf-8') as f:
        f.write(content)

print("Replacement complete")

const fs = require('fs');

const files = [
    'd:\\Gawe\\Patenpakminko_Cyberlabs\\Patenpakminko\\resources\\views\\tanah-timbul\\show.blade.php',
    'd:\\Gawe\\Patenpakminko_Cyberlabs\\Patenpakminko\\resources\\views\\non-berusaha\\show.blade.php',
    'd:\\Gawe\\Patenpakminko_Cyberlabs\\Patenpakminko\\resources\\views\\berusaha\\show.blade.php',
    'd:\\Gawe\\Patenpakminko_Cyberlabs\\Patenpakminko\\resources\\views\\kebijakan\\show.blade.php',
];

const input_regex = /<div class="form-group-v" style="margin-bottom:\s*12px;\s*border-top:\s*1px\s*dashed\s*var\(--clr-line\);\s*padding-top:\s*12px;\s*margin-top:\s*12px;">\s*<label style="font-size:\s*11\.5px;\s*color:\s*var\(--clr-muted\);\s*font-weight:\s*600;">✎ Edit Pesan WA \(Opsional\):<\/label>\s*<textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan otomatis..."><\/textarea>\s*<\/div>/g;

const resend_regex = /<form action="\{\{\s*(route\([^\)]+\))\s*\}\}" method="POST" style="margin-top:\s*16px;">\s*@csrf\s*<input type="hidden" name="step" value="resend_wa">\s*<input type="hidden" name="wa_type" value="([^"]+)">\s*<div class="form-group-v" style="margin(?:-top:\s*12px;\s*margin)?-bottom:\s*12px;\s*text-align:\s*left;">\s*<label style="font-size:\s*11px;\s*color:\s*var\(--clr-muted\);">Edit Pesan WA \(Opsional\):<\/label>\s*<textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan..."><\/textarea>\s*<\/div>\s*<button type="submit" class="btn-submit-v" style="background:\s*([^;]+);\s*width:\s*100%;\s*justify-content:\s*center;">\s*<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2\.5">\s*<path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"\/>\s*<\/svg>\s*(.*?)\s*<\/button>\s*<\/form>/gs;

let count = 0;
files.forEach(fpath => {
    if (!fs.existsSync(fpath)) return;
    let content = fs.readFileSync(fpath, 'utf8');

    content = content.replace(input_regex, '<x-wa-message-input />');

    content = content.replace(resend_regex, (match, route_call, wa_type, btn_color, btn_text) => {
        let safe_wa_type = wa_type.replace(/"/g, '&quot;');
        let safe_btn_text = btn_text.trim();
        return `<x-wa-resend-form route="{{ ${route_call} }}" waType="${safe_wa_type}" btnColor="${btn_color}" btnText="${safe_btn_text}" />`;
    });

    fs.writeFileSync(fpath, content);
    count++;
    console.log(`Processed ${fpath}`);
});
console.log(`Done replacing in ${count} files.`);

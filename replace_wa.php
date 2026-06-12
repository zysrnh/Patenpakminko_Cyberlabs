<?php

$files = [
    'd:\\Gawe\\Patenpakminko_Cyberlabs\\Patenpakminko\\resources\\views\\tanah-timbul\\show.blade.php',
    'd:\\Gawe\\Patenpakminko_Cyberlabs\\Patenpakminko\\resources\\views\\non-berusaha\\show.blade.php',
    'd:\\Gawe\\Patenpakminko_Cyberlabs\\Patenpakminko\\resources\\views\\berusaha\\show.blade.php',
    'd:\\Gawe\\Patenpakminko_Cyberlabs\\Patenpakminko\\resources\\views\\kebijakan\\show.blade.php',
];

$input_regex = '/<div class="form-group-v" style="margin-bottom:\s*12px;\s*border-top:\s*1px\s*dashed\s*var\(--clr-line\);\s*padding-top:\s*12px;\s*margin-top:\s*12px;">\s*<label style="font-size:\s*11\.5px;\s*color:\s*var\(--clr-muted\);\s*font-weight:\s*600;">✎ Edit Pesan WA \(Opsional\):<\/label>\s*<textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan otomatis..."><\/textarea>\s*<\/div>/';

$resend_regex = '/<form action="\{\{\s*(route\([^\)]+\))\s*\}\}" method="POST" style="margin-top:\s*16px;">\s*@csrf\s*<input type="hidden" name="step" value="resend_wa">\s*<input type="hidden" name="wa_type" value="([^"]+)">\s*<div class="form-group-v" style="margin(?:-top:\s*12px;\s*margin)?-bottom:\s*12px;\s*text-align:\s*left;">\s*<label style="font-size:\s*11px;\s*color:\s*var\(--clr-muted\);">Edit Pesan WA \(Opsional\):<\/label>\s*<textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan..."><\/textarea>\s*<\/div>\s*<button type="submit" class="btn-submit-v" style="background:\s*([^;]+);\s*width:\s*100%;\s*justify-content:\s*center;">\s*<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2\.5">\s*<path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"\/?>\s*<\/svg>\s*(.*?)\s*<\/button>\s*<\/form>/s';

$count = 0;
foreach ($files as $fpath) {
    if (!file_exists($fpath)) continue;
    $content = file_get_contents($fpath);

    $content = preg_replace($input_regex, '<x-wa-message-input />', $content);

    $content = preg_replace_callback($resend_regex, function($matches) {
        $route_call = $matches[1];
        $wa_type = str_replace('"', '&quot;', $matches[2]);
        $btn_color = $matches[3];
        $btn_text = trim($matches[4]);
        
        return "<x-wa-resend-form route=\"{{ {$route_call} }}\" waType=\"{$wa_type}\" btnColor=\"{$btn_color}\" btnText=\"{$btn_text}\" />";
    }, $content);

    file_put_contents($fpath, $content);
    $count++;
    echo "Processed $fpath\n";
}
echo "Done replacing in $count files.\n";

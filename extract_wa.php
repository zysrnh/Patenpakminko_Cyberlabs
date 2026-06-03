<?php
$files = glob("d:/Gawe/Patenpakminko_Cyberlabs/Patenpakminko/app/Http/Controllers/*.php");
$output = "KUMPULAN TEMPLATE WHATSAPP BLAST\n================================\n\n";

foreach ($files as $file) {
    $content = file_get_contents($file);
    $basename = basename($file);
    
    // Cari semua string yang ada di dalam variabel seperti $message = "..." atau executeFonnteSend(..., "...")
    preg_match_all('/(?:\$message|\$msg|\$msgBpn|\$msgPutr|executeFonnteSend\([^,]+,)\s*=?\s*["\'](.*?Halo.*?)["\']/is', $content, $matches_halo);
    preg_match_all('/(?:\$message|\$msg|\$msgBpn|\$msgPutr|executeFonnteSend\([^,]+,)\s*=?\s*["\'](.*?Notifikasi.*?)["\']/is', $content, $matches_notif);
    
    $messages = array_merge($matches_halo[1], $matches_notif[1]);
    
    if (count($messages) > 0) {
        $output .= "### " . $basename . " ###\n\n";
        foreach (array_unique($messages) as $msg) {
            $msg = trim(preg_replace('/\s+/', ' ', $msg)); // cleanup newlines
            $output .= "- " . $msg . "\n\n";
        }
    }
}

file_put_contents("d:/Gawe/Patenpakminko_Cyberlabs/Patenpakminko/template_wa.txt", $output);
echo "Berhasil!";

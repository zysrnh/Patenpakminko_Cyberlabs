<?php
$sourcePath = 'd:/Gawe/Patenpakminko_Cyberlabs/Patenpakminko/resources/views/non-berusaha/show.blade.php';
$targetPath = 'd:/Gawe/Patenpakminko_Cyberlabs/Patenpakminko/resources/views/kebijakan/show.blade.php';

$content = file_get_contents($sourcePath);

// Replace routes
$content = str_replace("route('non-berusaha.index')", "route('kebijakan.index')", $content);
$content = str_replace("route('non-berusaha.verify'", "route('kebijakan.verify'", $content);
$content = str_replace("route('non-berusaha.ptp_pdf'", "route('kebijakan.ptp_pdf'", $content);

// Replace module type
$content = str_replace("'module_type', 'non_berusaha'", "'module_type', 'kebijakan'", $content);
$content = str_replace('value="non_berusaha"', 'value="kebijakan"', $content);

// Replace specific text
$content = str_replace("Dokumen PKKPR Non-Berusaha siap diunduh", "Dokumen Kebijakan Khusus siap diunduh", $content);

file_put_contents($targetPath, $content);
echo "Replacement completed successfully.\n";

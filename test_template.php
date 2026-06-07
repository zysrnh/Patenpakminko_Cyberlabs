<?php
$zip = new ZipArchive();
if ($zip->open('storage/app/public/doc/Formulir/Formulir Pertek 2026 Template.docx') === TRUE) {
    $content = $zip->getFromName('word/document.xml');
    preg_match_all('/\$\{[^\}]+\}/', $content, $matches);
    print_r(array_unique($matches[0]));
    $zip->close();
} else {
    echo "Failed to open zip\n";
}

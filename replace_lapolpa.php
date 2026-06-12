<?php
$dirs = ['resources/views/'];
$replacements = [
    'LAPOLPA' => 'LAPOL PAK',
    'Lapolpa' => 'Lapol Pak',
    'lapolpa' => 'lapolpa' // to prevent accidental replacements if somehow matched. Not strictly necessary.
];

foreach ($dirs as $dir) {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isFile() && in_array($file->getExtension(), ['php'])) {
            $content = file_get_contents($file->getPathname());
            $newContent = str_replace(['LAPOLPA', 'Lapolpa'], ['LAPOL PAK', 'Lapol Pak'], $content);
            if ($content !== $newContent) {
                file_put_contents($file->getPathname(), $newContent);
                echo 'Updated: ' . $file->getPathname() . "\n";
            }
        }
    }
}

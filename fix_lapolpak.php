<?php
$dirs = ['resources/views/'];
$replacements = [
    'Lapol Pakk.png' => 'Lapolpak.png',
    'LAPOL PAKK.png' => 'Lapolpak.png',
    'Lapol Pakk' => 'Lapolpak', // Just in case
    'LAPOL PAKK' => 'Lapolpak'
];

foreach ($dirs as $dir) {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isFile() && in_array($file->getExtension(), ['php'])) {
            $content = file_get_contents($file->getPathname());
            $newContent = str_replace(array_keys($replacements), array_values($replacements), $content);
            if ($content !== $newContent) {
                file_put_contents($file->getPathname(), $newContent);
                echo 'Updated: ' . $file->getPathname() . "\n";
            }
        }
    }
}

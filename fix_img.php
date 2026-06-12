<?php
$dirs = ['resources/views/'];
$replacements = [
    'Pertimbangan Teknis Pertanahan.png' => 'PKKPR.png'
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

<?php
$dirs = ['app/', 'resources/views/', 'routes/'];
$replacements = [
    'PPKPR Berusaha' => 'Pertimbangan Teknis Pertanahan Berusaha',
    'PKKPR Berusaha' => 'Pertimbangan Teknis Pertanahan Berusaha',
    'PPKPR Non Berusaha' => 'Pertimbangan Teknis Pertanahan Non Berusaha',
    'PKKPR Non Berusaha' => 'Pertimbangan Teknis Pertanahan Non Berusaha',
    'Ppkpr Berusaha' => 'Pertimbangan Teknis Pertanahan Berusaha',
    'Ppkpr Non Berusaha' => 'Pertimbangan Teknis Pertanahan Non Berusaha'
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

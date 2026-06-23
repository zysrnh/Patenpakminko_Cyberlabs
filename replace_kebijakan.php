<?php
$dirs = ['resources/views/', 'app/', 'routes/', 'database/', './'];
$replacements = [
    'Kebijakan' => 'Kebijakan',
    'kebijakan' => 'kebijakan',
    'KEBIJAKAN' => 'KEBIJAKAN'
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) continue;
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isFile() && in_array($file->getExtension(), ['php', 'txt', 'md'])) {
            // skip vendor and node_modules
            if (strpos($file->getPathname(), 'vendor') !== false || strpos($file->getPathname(), 'node_modules') !== false) {
                continue;
            }
            $content = file_get_contents($file->getPathname());
            $newContent = str_replace(array_keys($replacements), array_values($replacements), $content);
            if ($content !== $newContent) {
                file_put_contents($file->getPathname(), $newContent);
                echo 'Updated: ' . $file->getPathname() . "\n";
            }
        }
    }
}

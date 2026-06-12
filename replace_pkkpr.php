<?php
$dirs = ['resources/views/'];
$replacements = [
    'PKKPR' => 'Pertimbangan Teknis Pertanahan',
    'PPKPR' => 'Pertimbangan Teknis Pertanahan'
];

foreach ($dirs as $dir) {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isFile() && in_array($file->getExtension(), ['php'])) {
            $content = file_get_contents($file->getPathname());
            
            // We need to be careful not to replace something like Pertimbangan Teknis Pertanahan Berusaha again if we just do str_replace.
            // Wait! If the text is "Logo PKKPR", it will become "Logo Pertimbangan Teknis Pertanahan"
            // Wait, what if it's already "Pertimbangan Teknis Pertanahan"? Then replacing "PKKPR" won't affect it.
            // Let's do it.
            $newContent = str_replace(array_keys($replacements), array_values($replacements), $content);
            
            // Fix case: "Pertimbangan Teknis Pertanahan Pertimbangan Teknis Pertanahan Berusaha" ?
            // Since I previously replaced "PKKPR Berusaha" -> "Pertimbangan Teknis Pertanahan Berusaha",
            // the text "PKKPR Berusaha" doesn't exist anymore. So "PKKPR" will only match standalone PKKPRs.
            
            // Note: we should avoid replacing variable names or snake_cases.
            // But str_replace is case sensitive. PKKPR and PPKPR are all caps. 
            // The variables are usually $satu_pintu_no_pkkpr (lowercase pkkpr).
            // So replacing uppercase PKKPR and PPKPR should be safe for variables.
            
            if ($content !== $newContent) {
                file_put_contents($file->getPathname(), $newContent);
                echo 'Updated: ' . $file->getPathname() . "\n";
            }
        }
    }
}

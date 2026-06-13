<?php
$dirs = ['resources/views/'];
// We'll replace the full text where it appears.
$replacements = [
    'Pertimbangan Teknis Pertanahan Berusaha' => 'Pertimbangan Teknis Pertanahan PKKPR Berusaha',
    'Pertimbangan Teknis Pertanahan Non Berusaha' => 'Pertimbangan Teknis Pertanahan PKKPR Non Berusaha',
    
    // For the other three, they might appear as just "Kebijakan", "Tanah Timbul", "Proyek Strategis Nasional (PSN)".
    // But we have to be careful not to replace generic words like "Kebijakan" everywhere (e.g. in URLs or CSS classes).
    // We will do a regex or HTML specific replacement for those if needed, but let's see what happens.
];

foreach ($dirs as $dir) {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isFile() && in_array($file->getExtension(), ['php'])) {
            $content = file_get_contents($file->getPathname());
            
            // First do the easy ones:
            $newContent = str_replace(array_keys($replacements), array_values($replacements), $content);
            
            // For Kebijakan, Tanah Timbul, PSN: Let's target the strong tags in welcome.blade.php
            $newContent = str_replace('<strong>Kebijakan</strong>', '<strong>Pertimbangan Teknis Pertanahan Kebijakan</strong>', $newContent);
            $newContent = str_replace('<strong>Tanah Timbul</strong>', '<strong>Pertimbangan Teknis Pertanahan Tanah Timbul</strong>', $newContent);
            $newContent = str_replace('<strong>Proyek Strategis Nasional (PSN)</strong>', '<strong>Pertimbangan Teknis Pertanahan Proyek Strategis Nasional (PSN)</strong>', $newContent);
            
            // For public.blade.php Layanan dropdown and footer:
            $newContent = preg_replace('/>\s*Kebijakan\s*<\/a>/', '>Pertimbangan Teknis Pertanahan Kebijakan</a>', $newContent);
            // wait, in the dropdown it's not an <a> it's text inside <a> but with an img
            $newContent = preg_replace('/alt=\"\"\>\s*Kebijakan\s*/', 'alt=""> Pertimbangan Teknis Pertanahan Kebijakan', $newContent);
            
            // In ptp-create.blade.php:
            $newContent = str_replace("'kebijakan' => 'Pertimbangan Teknis Pertanahan Kebijakan'", "'kebijakan' => 'Pertimbangan Teknis Pertanahan Kebijakan'", $newContent); // already done manually maybe? No, ptp-create had: "'kebijakan' => 'Pertimbangan Teknis Pertanahan Kebijakan'" actually it already did!
            // Wait, let's check ptp-create.blade.php:
            // 'kebijakan' => 'Pertimbangan Teknis Pertanahan Kebijakan'
            // 'psn' => 'Pertimbangan Teknis Pertanahan PSN'
            // 'tanah-timbul' => 'Pertimbangan Teknis Pertanahan Tanah Timbul'
            $newContent = str_replace("'psn' => 'Pertimbangan Teknis Pertanahan PSN'", "'psn' => 'Pertimbangan Teknis Pertanahan Proyek Strategis Nasional (PSN)'", $newContent);
            
            // In app.blade.php (Sidebar):
            $newContent = preg_replace('/<span class="nav-text">Kebijakan<\/span>/', '<span class="nav-text">Pertimbangan Teknis Pertanahan Kebijakan</span>', $newContent);
            $newContent = preg_replace('/<span class="nav-text">Tanah Timbul<\/span>/', '<span class="nav-text">Pertimbangan Teknis Pertanahan Tanah Timbul</span>', $newContent);
            $newContent = preg_replace('/<span class="nav-text">PSN<\/span>/', '<span class="nav-text">Pertimbangan Teknis Pertanahan Proyek Strategis Nasional (PSN)</span>', $newContent);
            // Wait, app.blade.php uses `Kebijakan` directly not `<span class="nav-text">`.
            $newContent = preg_replace('/>\s*Kebijakan\s*<\/a>/', '>Pertimbangan Teknis Pertanahan Kebijakan</a>', $newContent);
            $newContent = preg_replace('/>\s*Tanah Timbul\s*<\/a>/', '>Pertimbangan Teknis Pertanahan Tanah Timbul</a>', $newContent);
            $newContent = preg_replace('/>\s*PSN\s*<\/a>/', '>Pertimbangan Teknis Pertanahan Proyek Strategis Nasional (PSN)</a>', $newContent);

            if ($content !== $newContent) {
                file_put_contents($file->getPathname(), $newContent);
                echo 'Updated: ' . $file->getPathname() . "\n";
            }
        }
    }
}

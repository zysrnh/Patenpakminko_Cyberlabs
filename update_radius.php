<?php

$files = [
    'resources/views/berusaha/show.blade.php',
    'resources/views/non-berusaha/show.blade.php',
    'resources/views/psn/show.blade.php',
    'resources/views/kebijakan/show.blade.php',
    'resources/views/tanah-timbul/show.blade.php',
];

foreach ($files as $file) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);
    
    // Replace outer container radius
    $content = str_replace(
        'border-radius: var(--r-md);',
        'border-radius: 4px;',
        $content
    );
    
    // Replace inner block radius
    $content = str_replace(
        'border-radius: 6px;',
        'border-radius: 4px;',
        $content
    );
    
    file_put_contents($file, $content);
    echo "Updated radius in $file\n";
}

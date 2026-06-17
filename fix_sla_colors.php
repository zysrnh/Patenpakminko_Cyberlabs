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
    
    // Change Blue back to Green
    $content = str_replace(
        "\$slaBg = '#EBF8FF';\n                                \$slaBorder = '#BEE3F8';\n                                \$slaColor = '#2B6CB0';",
        "\$slaBg = '#D1E7DD';\n                                \$slaBorder = '#BADBCC';\n                                \$slaColor = '#0F5132';",
        $content
    );

    $content = str_replace(
        "\$slaBg = '#EBF8FF';\r\n                                \$slaBorder = '#BEE3F8';\r\n                                \$slaColor = '#2B6CB0';",
        "\$slaBg = '#D1E7DD';\r\n                                \$slaBorder = '#BADBCC';\r\n                                \$slaColor = '#0F5132';",
        $content
    );
    
    // Also, let's fix trying to remove the inline color var(--blue) in Javascript if it exists
    $content = str_replace(
        'color: var(--blue);',
        '',
        $content
    );
    
    file_put_contents($file, $content);
    echo "Fixed colors in $file\n";
}

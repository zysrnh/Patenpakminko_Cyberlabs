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
    
    $search = "\$isSelesai = (\$application->status === 'disetujui' || \$application->status === 'ditolak' || \$application->bpn_pertek_document);";
    $replace = "\$isSelesai = (\$application->bpn_pertek_document || in_array(\$application->status, ['ditolak', 'menunggu_dinas_pu', 'menunggu_satu_pintu', 'disetujui']));";
    
    $content = str_replace($search, $replace, $content);
    file_put_contents($file, $content);
    echo "Fixed isSelesai in $file\n";
}

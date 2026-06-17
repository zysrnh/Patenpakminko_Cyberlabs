<?php
$file = 'resources/views/dashboard.blade.php';
$content = file_get_contents($file);

$strToFind = "<a href=\"{{ route('admin.reviews.index') }}\" class=\"nav-item\">\n                <svg viewBox=\"0 0 24 24\"><path d=\"M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7\"/><path d=\"M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z\"/></svg>\n                Kelola Ulasan\n            </a>";

$newLink = "<a href=\"{{ route('admin.users.index') }}\" class=\"nav-item\">\n                <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2\"/><circle cx=\"9\" cy=\"7\" r=\"4\"/><path d=\"M23 21v-2a4 4 0 00-3-3.87\"/><path d=\"M16 3.13a4 4 0 010 7.75\"/></svg>\n                Kelola Admin\n            </a>\n            " . $strToFind;

if (strpos($content, 'admin.users.index') === false) {
    $content = str_replace($strToFind, $newLink, $content);
    file_put_contents($file, $content);
    echo "Dashboard sidebar updated\n";
} else {
    echo "Dashboard sidebar already updated\n";
}

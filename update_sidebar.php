<?php
$file = 'resources/views/layouts/app.blade.php';
$content = file_get_contents($file);

$strToFind = "<a href=\"{{ route('admin.reviews.index') }}\" class=\"nav-item {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}\">";
$newLink = "<a href=\"{{ route('admin.users.index') }}\" class=\"nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}\">\n                <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\"><path d=\"M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2\"/><circle cx=\"9\" cy=\"7\" r=\"4\"/><path d=\"M23 21v-2a4 4 0 00-3-3.87\"/><path d=\"M16 3.13a4 4 0 010 7.75\"/></svg>\n                Kelola Admin\n            </a>\n            " . $strToFind;

if (strpos($content, 'admin.users.index') === false) {
    $content = str_replace($strToFind, $newLink, $content);
    file_put_contents($file, $content);
    echo "Sidebar updated\n";
} else {
    echo "Sidebar already updated\n";
}

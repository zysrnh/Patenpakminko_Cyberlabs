<?php

$content = file_get_contents('app/Http/Controllers/BerkasController.php');
$content = str_replace('BerkasController', 'DokumenController', $content);
$content = str_replace('use App\Models\Berkas;', 'use App\Models\Dokumen;', $content);
$content = str_replace('Berkas::', 'Dokumen::', $content);
$content = str_replace('$berkas', '$dokumen', $content);
$content = str_replace('berkas.', 'dokumen.', $content);
$content = str_replace('berkas/', 'dokumen/', $content);
$content = str_replace('nama_berkas', 'nama_dokumen', $content);
$content = str_replace('berkas', 'dokumen', $content);
$content = str_replace('Berkas', 'Dokumen', $content);
file_put_contents('app/Http/Controllers/DokumenController.php', $content);

$viewContent = file_get_contents('resources/views/berkas/index.blade.php');
$viewContent = str_replace('Berkas', 'Dokumen', $viewContent);
$viewContent = str_replace('berkas', 'dokumen', $viewContent);
$viewContent = str_replace('nama_berkas', 'nama_dokumen', $viewContent);
if (!file_exists('resources/views/dokumen')) {
    mkdir('resources/views/dokumen');
}
file_put_contents('resources/views/dokumen/index.blade.php', $viewContent);

echo "Done\n";

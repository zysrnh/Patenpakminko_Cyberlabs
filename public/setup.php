<?php
// Smart Setup Script (Bisa ditaruh di public_html atau public)

$vendorPaths = [
    __DIR__.'/../vendor/autoload.php', // Standar Laravel
    __DIR__.'/Patenpakminko/vendor/autoload.php', // Jika ditaruh di dalam folder Patenpakminko
    __DIR__.'/vendor/autoload.php', // Jika sejajar
];

$autoloadFound = false;
foreach ($vendorPaths as $path) {
    if (file_exists($path)) {
        require $path;
        $appPath = dirname($path, 2) . '/bootstrap/app.php';
        if (file_exists($appPath)) {
            $app = require_once $appPath;
            $autoloadFound = true;
            break;
        }
    }
}

if (!$autoloadFound) {
    die("<h1>Error 500</h1><p>Gagal menemukan file vendor/autoload.php. Pastikan setup.php ditaruh di tempat yang benar atau folder Laravel (Patenpakminko) sudah di-upload.</p>");
}

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

echo "<h2>Paten Pak Miko - VPS Setup Script</h2>";
echo "<hr>";

// 1. Run Migrate Fresh + Seed
echo "<b>1. Menjalankan Migrate Fresh & Seeder</b><br>";
try {
    \Illuminate\Support\Facades\Artisan::call('migrate:fresh', [
        '--seed' => true, 
        '--force' => true
    ]);
    echo "<pre>" . \Illuminate\Support\Facades\Artisan::output() . "</pre><br>";
} catch (\Exception $e) {
    echo "<pre style='color:red'>" . $e->getMessage() . "</pre><br>";
}

echo "<h3 style='color:green'>SEMUA PROSES SELESAI!</h3>";
echo "<p style='color:red'>Tolong SEGERA HAPUS file <b>setup.php</b> ini dari server demi keamanan!</p>";

<?php
$file = 'routes/web.php';
$content = file_get_contents($file);

$strToFind = "Route::get('/admin/reviews', [ReviewController::class, 'adminIndex'])->name('admin.reviews.index');";
$newRoutes = "Route::resource('/admin/users', \App\Http\Controllers\AdminUserController::class)->except(['show'])->names('admin.users');\n    " . $strToFind;

if (strpos($content, '/admin/users') === false) {
    $content = str_replace($strToFind, $newRoutes, $content);
    file_put_contents($file, $content);
    echo "Routes updated\n";
} else {
    echo "Routes already updated\n";
}

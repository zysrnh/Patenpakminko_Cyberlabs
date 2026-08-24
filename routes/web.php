<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PpkprNonBerusahaController;
use App\Http\Controllers\KebijakanController;
use App\Http\Controllers\TanahTimbulController;
use App\Http\Controllers\PpkprBerusahaController;
use App\Http\Controllers\LapolpaController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\InformalController;
use App\Http\Controllers\PsnController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\AdminDpnController;
use App\Http\Controllers\KbliController;
use App\Http\Controllers\WaTemplateController;
use App\Http\Controllers\TemplateDokumenController;
use App\Http\Controllers\TempUploadController;
use Illuminate\Support\Facades\Route;
use App\Models\Review;
 
// Internal API for WA Templates & Temp Document Uploads
Route::get("/api/wa-template", [WaTemplateController::class, "getTemplate"])->name("api.wa-template");
Route::post("/api/temp-upload-document", [TempUploadController::class, "upload"])->name("api.temp-upload");

// Halaman utama / Landing Page
Route::get('/', function () {
    $formalReviews = Review::with('user')
        ->where('is_approved', true)
        ->latest()
        ->take(10)
        ->get()
        ->map(function ($item) {
            $item->module_label_display = $item->module_label;
            $name = null;
            if ($item->module_type === 'berusaha' && $item->module_id) {
                $app = \App\Models\PpkprBerusahaApplication::find($item->module_id);
                if ($app) {
                    $name = $app->nama_pemilik_usaha ?: $app->nama_pengaju;
                }
            } elseif ($item->module_type === 'non_berusaha' && $item->module_id) {
                $app = \App\Models\PpkprNonBerusahaApplication::find($item->module_id);
                if ($app) {
                    $name = $app->nama_pemilik_usaha ?: $app->nama_pengaju;
                }
            }
            if (!$name || strtolower($name) === 'petugas bpn') {
                $name = ($item->user && strtolower($item->user->name) !== 'petugas bpn') ? $item->user->name : ($item->user->username ?? 'Pelaku Usaha');
            }
            $item->reviewer_name = $name;
            $item->reviewer_initial = strtoupper(substr($name ?? 'PU', 0, 2));
            return $item;
        });

    $informalReviews = \App\Models\InformalRating::with('user')
        ->where('is_approved', true)
        ->latest()
        ->take(6)
        ->get()
        ->map(function ($item) {
            $item->module_label_display = 'INFORMAL - ' . strtoupper($item->informal_type);
            $item->reviewer_name = $item->name ?? ($item->user->name ?? ($item->user->username ?? 'Publik'));
            $item->reviewer_initial = strtoupper(substr($item->reviewer_name, 0, 2));
            return $item;
        });

    $reviews = $formalReviews->concat($informalReviews)->sortByDesc('created_at')->values()->take(12);

    // Kalkulasi rata-rata keseluruhan (Review + InformalRating)
    $countApprovedReview = Review::where('is_approved', true)->count();
    $countApprovedInformal = \App\Models\InformalRating::where('is_approved', true)->count();
    $totalApprovedCount = $countApprovedReview + $countApprovedInformal;

    if ($totalApprovedCount > 0) {
        $avgReview = Review::where('is_approved', true)->avg('rating') ?? 0;
        $avgInformal = \App\Models\InformalRating::where('is_approved', true)->avg('rating') ?? 0;
        $averageRating = (($avgReview * $countApprovedReview) + ($avgInformal * $countApprovedInformal)) / $totalApprovedCount;
    } else {
        // Fallback jika belum ada yang diapprove: hitung dari seluruh rating yang telah masuk ke DB
        $countAllReview = Review::count();
        $countAllInformal = \App\Models\InformalRating::count();
        $totalAllCount = $countAllReview + $countAllInformal;

        if ($totalAllCount > 0) {
            $avgReviewAll = Review::avg('rating') ?? 0;
            $avgInformalAll = \App\Models\InformalRating::avg('rating') ?? 0;
            $averageRating = (($avgReviewAll * $countAllReview) + ($avgInformalAll * $countAllInformal)) / $totalAllCount;
        } else {
            $averageRating = 5.0; // Default jika belum ada rating sama sekali
        }
    }
    $averageRating = number_format((float)$averageRating, 1);
    
    // Hitung visitor & statistik web
    $visitorFile = 'visitor_stats.json';
    $statsData = [
        'count' => 0,
        'permohonan_diproses' => '',
        'rata_rata_penyelesaian' => '10 hari',
        'rating_override' => '',
    ];
    if (\Illuminate\Support\Facades\Storage::exists($visitorFile)) {
        $loaded = json_decode(\Illuminate\Support\Facades\Storage::get($visitorFile), true);
        if (is_array($loaded)) {
            $statsData = array_merge($statsData, $loaded);
        }
    }
    
    if (isset($statsData['permohonan_diproses']) && strtolower(trim((string)$statsData['permohonan_diproses'])) === '12k') {
        $statsData['permohonan_diproses'] = '';
    }
    
    $visitorCount = (int) $statsData['count'];
    $isNewVisitor = false;
    if (!request()->cookie('visited')) {
        $visitorCount++;
        $statsData['count'] = $visitorCount;
        \Illuminate\Support\Facades\Storage::put($visitorFile, json_encode($statsData));
        $isNewVisitor = true;
    }

    // Hitung total permohonan otomatis dari semua layanan di database (5 modul permohonan)
    $totalPermohonan = \App\Models\PpkprApplication::count()
        + \App\Models\PpkprBerusahaApplication::count()
        + \App\Models\KebijakanApplication::count()
        + \App\Models\PsnApplication::count()
        + \App\Models\TanahTimbulApplication::count();

    $statsData['permohonan_diproses_display'] = number_format($totalPermohonan);

    // Berita / Artikel
    $beritas = \App\Models\Berita::where('is_published', true)->latest()->take(10)->get();

    $response = response()->view('welcome', compact('reviews', 'averageRating', 'visitorCount', 'statsData', 'beritas', 'totalPermohonan'));
    if ($isNewVisitor) {
        $response->cookie('visited', true, 60 * 24); // 24 jam
    }
    
    return $response;
});

// Route Alur Proses
Route::get('/alur', function() {
    return view('alur');
})->name('alur');

// Route Download & Preview Template Publik
Route::get('/download-template/{kode}', function($kode) {
    $template = \App\Models\TemplateDokumen::where('kode_template', $kode)->where('is_active', true)->first();
    if ($template && \Illuminate\Support\Facades\Storage::disk('public')->exists($template->file_path)) {
        return \Illuminate\Support\Facades\Storage::disk('public')->download($template->file_path, $template->nama_template . '.' . $template->tipe_file);
    }
    $defaultPath = storage_path('app/public/doc/Formulir/Formulir Pertek 2026 Template.docx');
    if (file_exists($defaultPath)) {
        return response()->download($defaultPath, 'Formulir_Pertek_2026_Template.docx');
    }
    abort(404, 'Template tidak ditemukan.');
})->name('public.template.download');

Route::get('/preview-template/{kode}', [TemplateDokumenController::class, 'publicPreview'])->name('public.template.preview');


// Route Publik Semua Ulasan
Route::get('/testimoni', function () {
    $formalReviews = \App\Models\Review::with('user')
        ->where('is_approved', true)
        ->latest()
        ->get()
        ->map(function ($item) {
            $item->module_label_display = $item->module_label;
            $item->reviewer_name = $item->user->name ?? $item->user->username;
            $item->reviewer_initial = strtoupper(substr($item->user->username ?? 'PU', 0, 2));
            return $item;
        });

    $informalReviews = \App\Models\InformalRating::with('user')
        ->where('is_approved', true)
        ->latest()
        ->get()
        ->map(function ($item) {
            $item->module_label_display = 'INFORMAL - ' . strtoupper($item->informal_type);
            $item->reviewer_name = $item->name ?? ($item->user->name ?? ($item->user->username ?? 'Publik'));
            $item->reviewer_initial = strtoupper(substr($item->reviewer_name, 0, 2));
            return $item;
        });

    $reviews = $formalReviews->concat($informalReviews)->sortByDesc('rating')->values()->take(50);
    
    return view('testimoni', compact('reviews'));
})->name('testimoni');

// Route Kontak
Route::get('/kontak', function() {
    return view('kontak');
})->name('kontak');

// Route Berita Publik
Route::get('/berita/{slug}', [\App\Http\Controllers\BeritaController::class, 'showPublic'])->name('berita.show');

// Rute Peta Publik Informal (Tanpa Login)
Route::get('/informal', [InformalController::class, 'index'])->name('informal.index');

// Rute LAPOLPAK (Bisa Tanpa Login & Dengan Login)
Route::get('/lapolpak', [LapolpaController::class, 'index'])->name('lapolpa.index');
Route::post('/lapolpak', [LapolpaController::class, 'store'])->name('lapolpa.store');
Route::get('/lapolpak/success', [LapolpaController::class, 'success'])->name('lapolpa.success');
Route::put('/lapolpak/{id}', [LapolpaController::class, 'updateStatus'])->name('lapolpa.update');
Route::delete('/lapolpak/{id}', [LapolpaController::class, 'destroy'])->name('lapolpa.destroy');
Route::post('/lapolpak/bulk-destroy', [LapolpaController::class, 'bulkDestroy'])->name('lapolpa.bulk-destroy');
Route::get('/lapolpak/ulasan/{id}', [LapolpaController::class, 'showReviewForm'])->name('lapolpa.review.form');
Route::post('/lapolpak/ulasan/{id}', [LapolpaController::class, 'submitReview'])->name('lapolpa.review.submit');

Route::post('/informal/rating', [InformalController::class, 'storeRating'])->name('informal.rating.store');

// Rute Publik PTP Form
Route::get('/permohonan-ptp', [AuthController::class, 'showPtpForm'])->name('ptp.create');
Route::post('/permohonan-ptp', [AuthController::class, 'storePtpForm'])->name('ptp.store');
Route::get('/permohonan-ptp/preview', [AuthController::class, 'previewPtpForm'])->name('ptp.preview');

// Rute Lihat/Download File Publik (Tanpa Harus Login)
Route::get('/file/{path}', [BerkasController::class, 'viewFile'])->where('path', '.*')->name('file.view');

// Rute Portal Revisi Publik
Route::get("/revisi-berkas", [\App\Http\Controllers\RevisiController::class, "index"])->name("revisi.index");
Route::post("/revisi-berkas/track", [\App\Http\Controllers\RevisiController::class, "track"])->name("revisi.track");
Route::post("/revisi-berkas/detail", [\App\Http\Controllers\RevisiController::class, "trackDetail"])->name("revisi.track.detail");
Route::post("/revisi-berkas/upload/{type}/{id}", [\App\Http\Controllers\RevisiController::class, "upload"])->name("revisi.upload");


// Entrypoint Publik PPKPR Baru (Guest dialihkan ke PTP form secara otomatis di Controller)
Route::get('/berusaha/baru', [PpkprBerusahaController::class, 'create'])->name('berusaha.create');
Route::post('/berusaha/baru', [PpkprBerusahaController::class, 'store'])->name('berusaha.store');
Route::get('/non-berusaha/baru', [PpkprNonBerusahaController::class, 'create'])->name('non-berusaha.create');
Route::post('/non-berusaha/baru', [PpkprNonBerusahaController::class, 'store'])->name('non-berusaha.store');
Route::get('/kebijakan/baru', [KebijakanController::class, 'create'])->name('kebijakan.create');
Route::post('/kebijakan/baru', [KebijakanController::class, 'store'])->name('kebijakan.store');
Route::get('/tanah-timbul/baru', [TanahTimbulController::class, 'create'])->name('tanah-timbul.create');
Route::post('/tanah-timbul/baru', [TanahTimbulController::class, 'store'])->name('tanah-timbul.store');
Route::get('/psn/baru', [PsnController::class, 'create'])->name('psn.create');
Route::post('/psn/baru', [PsnController::class, 'store'])->name('psn.store');
 
// KBLI Autocomplete AJAX (publik, tidak perlu login)
Route::get('/api/kbli/search', [KbliController::class, 'search'])->name('kbli.search');
Route::get('/api/kbli/find', [KbliController::class, 'findByCode'])->name('kbli.find');

// Rute untuk tamu (Guest Only)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
 
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendOtp'])->name('password.otp.send');
    Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])->name('password.otp.verify.form');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('password.otp.verify');
    Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('password.reset.form');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');
});
 
// Rute untuk pengguna yang sudah login (Authenticated)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user && $user->role === 'pelaku_usaha' && !$user->is_active) {
            \Illuminate\Support\Facades\Auth::logout();
            return redirect()->route('login')->withErrors([
                'login' => 'Akun belum aktif. Anda baru bisa login setelah permohonan Anda mencapai tahap verifikasi pembayaran (Step 3).',
            ]);
        }
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/admin_dpn', [AdminDpnController::class, 'index'])->name('admin_dpn.index');
    Route::post('/admin_dpn', [AdminDpnController::class, 'update'])->name('admin_dpn.update');
    Route::post('/admin_dpn/reset-visitor', [AdminDpnController::class, 'resetVisitorCount'])->name('admin_dpn.reset_visitor');
    Route::get('/admin_dpn/backup-database', [AdminDpnController::class, 'downloadDatabaseBackup'])->name('admin_dpn.backup_database');
    Route::get('/admin_dpn/backup-database-sql', [AdminDpnController::class, 'downloadDatabaseSqlOnly'])->name('admin_dpn.backup_database_sql');
    Route::post('/admin_dpn/send-backup-email', [AdminDpnController::class, 'sendBackupEmailNow'])->name('admin_dpn.send_backup_email');
    Route::post('/souvenir/send/{type}/{id}', [AdminDpnController::class, 'markSouvenirSent'])->name('souvenir.mark_sent');
    Route::post('/application/rollback/{type}/{id}', [AdminDpnController::class, 'rollbackStatus'])->name('application.rollback');
    Route::post('/application/forward/{type}/{id}', [AdminDpnController::class, 'forwardStatus'])->name('application.forward');
    
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    
    // PPKPR Non-Berusaha
    Route::get('/non-berusaha', [PpkprNonBerusahaController::class, 'index'])->name('non-berusaha.index');
    Route::match(['get', 'post'], '/non-berusaha/bulk-destroy', [PpkprNonBerusahaController::class, 'bulkDestroy'])->name('non-berusaha.bulk-destroy');
    Route::match(['get', 'post'], '/non-berusaha/bulk{any}', [PpkprNonBerusahaController::class, 'bulkDestroy'])->where('any', '.*');
    Route::get('/non-berusaha/{id}', [PpkprNonBerusahaController::class, 'show'])->name('non-berusaha.show');
    Route::get('/non-berusaha/{id}/ptp', [PpkprNonBerusahaController::class, 'ptpPdf'])->name('non-berusaha.ptp_pdf');
    Route::post('/non-berusaha/{id}/verifikasi', [PpkprNonBerusahaController::class, 'verify'])->name('non-berusaha.verify');
    Route::delete('/non-berusaha/{id}', [PpkprNonBerusahaController::class, 'destroy'])->name('non-berusaha.destroy');
 
    // Kebijakan
    Route::get('/kebijakan', [KebijakanController::class, 'index'])->name('kebijakan.index');
    Route::match(['get', 'post'], '/kebijakan/bulk-destroy', [KebijakanController::class, 'bulkDestroy'])->name('kebijakan.bulk-destroy');
    Route::match(['get', 'post'], '/kebijakan/bulk{any}', [KebijakanController::class, 'bulkDestroy'])->where('any', '.*');
    Route::get('/kebijakan/{id}', [KebijakanController::class, 'show'])->name('kebijakan.show');
    Route::get('/kebijakan/{id}/ptp', [KebijakanController::class, 'ptpPdf'])->name('kebijakan.ptp_pdf');
    Route::post('/kebijakan/{id}/verifikasi', [KebijakanController::class, 'verify'])->name('kebijakan.verify');
    Route::delete('/kebijakan/{id}', [KebijakanController::class, 'destroy'])->name('kebijakan.destroy');

    // Tanah Timbul
    Route::get('/tanah-timbul', [TanahTimbulController::class, 'index'])->name('tanah-timbul.index');
    Route::match(['get', 'post'], '/tanah-timbul/bulk-destroy', [TanahTimbulController::class, 'bulkDestroy'])->name('tanah-timbul.bulk-destroy');
    Route::match(['get', 'post'], '/tanah-timbul/bulk{any}', [TanahTimbulController::class, 'bulkDestroy'])->where('any', '.*');
    Route::get('/tanah-timbul/{id}', [TanahTimbulController::class, 'show'])->name('tanah-timbul.show');
    Route::get('/tanah-timbul/{id}/ptp', [TanahTimbulController::class, 'ptpPdf'])->name('tanah-timbul.ptp_pdf');
    Route::post('/tanah-timbul/{id}/verifikasi', [TanahTimbulController::class, 'verify'])->name('tanah-timbul.verify');
    Route::delete('/tanah-timbul/{id}', [TanahTimbulController::class, 'destroy'])->name('tanah-timbul.destroy');

    // PSN
    Route::get('/psn', [PsnController::class, 'index'])->name('psn.index');
    Route::match(['get', 'post'], '/psn/bulk-destroy', [PsnController::class, 'bulkDestroy'])->name('psn.bulk-destroy');
    Route::match(['get', 'post'], '/psn/bulk{any}', [PsnController::class, 'bulkDestroy'])->where('any', '.*');
    Route::get('/psn/{id}', [PsnController::class, 'show'])->name('psn.show');
    Route::get('/psn/{id}/ptp', [PsnController::class, 'ptpPdf'])->name('psn.ptp_pdf');
    Route::post('/psn/{id}/verifikasi', [PsnController::class, 'verify'])->name('psn.verify');
    Route::delete('/psn/{id}', [PsnController::class, 'destroy'])->name('psn.destroy');
 
    // PPKPR Berusaha
    Route::get('/berusaha', [PpkprBerusahaController::class, 'index'])->name('berusaha.index');
    Route::match(['get', 'post'], '/berusaha/bulk-destroy', [PpkprBerusahaController::class, 'bulkDestroy'])->name('berusaha.bulk-destroy');
    Route::match(['get', 'post'], '/berusaha/bulk{any}', [PpkprBerusahaController::class, 'bulkDestroy'])->where('any', '.*');
    Route::get('/berusaha/{id}', [PpkprBerusahaController::class, 'show'])->name('berusaha.show');
    Route::get('/berusaha/{id}/ptp', [PpkprBerusahaController::class, 'ptpPdf'])->name('berusaha.ptp_pdf');
    Route::post('/berusaha/{id}/verifikasi', [PpkprBerusahaController::class, 'verify'])->name('berusaha.verify');
    Route::delete('/berusaha/{id}', [PpkprBerusahaController::class, 'destroy'])->name('berusaha.destroy');
    
    // Fitur Ulasan (Review)
    Route::get('/ulasan', [ReviewController::class, 'index'])->name('ulasan.index');
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
    Route::post('/admin/users/bulk-destroy', [\App\Http\Controllers\AdminUserController::class, 'bulkDestroy'])->name('admin.users.bulk-destroy');
    Route::resource('/admin/users', \App\Http\Controllers\AdminUserController::class)->except(['show'])->names('admin.users');
    Route::post('/admin/pelaku_usaha/bulk-destroy', [\App\Http\Controllers\AdminPelakuUsahaController::class, 'bulkDestroy'])->name('admin.pelaku_usaha.bulk-destroy');
    Route::resource('/admin/pelaku_usaha', \App\Http\Controllers\AdminPelakuUsahaController::class)->only(['index', 'edit', 'update', 'destroy'])->names('admin.pelaku_usaha');
    Route::get('/admin/reviews', [ReviewController::class, 'adminIndex'])->name('admin.reviews.index');
    Route::post('/admin/reviews/{id}/approve', [ReviewController::class, 'approve'])->name('admin.reviews.approve');
    Route::delete('/admin/reviews/{id}', [ReviewController::class, 'destroy'])->name('admin.reviews.destroy');
    
    // Moderasi Informal
    Route::post('/admin/informal-reviews/{id}/approve', [ReviewController::class, 'approveInformal'])->name('admin.informal-reviews.approve');
    Route::delete('/admin/informal-reviews/{id}', [ReviewController::class, 'destroyInformal'])->name('admin.informal-reviews.destroy');
 
    // WhatsApp Gateway Settings (DPN / Super Admin)
    Route::get('/dpn/whatsapp', [PpkprNonBerusahaController::class, 'whatsappSettings'])->name('dpn.whatsapp');
    Route::post('/dpn/whatsapp/save', [PpkprNonBerusahaController::class, 'saveWhatsappSettings'])->name('dpn.whatsapp.save');
    Route::post('/dpn/whatsapp/toggle', [PpkprNonBerusahaController::class, 'toggleWhatsappConnection'])->name('dpn.whatsapp.toggle');
    Route::post('/dpn/whatsapp/save-provider', [PpkprNonBerusahaController::class, 'saveProviderSettings'])->name('dpn.whatsapp.save-provider');
    Route::get('/dpn/contacts', [PpkprNonBerusahaController::class, 'adminContacts'])->name('dpn.contacts');
    Route::post('/dpn/contacts/save', [PpkprNonBerusahaController::class, 'saveAdminContacts'])->name('dpn.contacts.save');
    Route::get('/dpn/kontak-page', [PpkprNonBerusahaController::class, 'adminPublicContact'])->name('dpn.kontak_page');
    Route::post('/dpn/kontak-page/save', [PpkprNonBerusahaController::class, 'saveAdminPublicContact'])->name('dpn.kontak_page.save');
    
    // Holiday Management
    Route::get('/dpn/holidays', [\App\Http\Controllers\HolidayController::class, 'index'])->name('dpn.holidays.index');
    Route::post('/dpn/holidays', [\App\Http\Controllers\HolidayController::class, 'store'])->name('dpn.holidays.store');
    Route::delete('/dpn/holidays/{id}', [\App\Http\Controllers\HolidayController::class, 'destroy'])->name('dpn.holidays.destroy');
    
    // Unduhan Template Persyaratan (Pelaku Usaha)
    Route::get('/templates/berkas-persyaratan', [PpkprNonBerusahaController::class, 'templatePersyaratan'])->name('templates.persyaratan');
    Route::get('/templates/surat-pernyataan', [PpkprNonBerusahaController::class, 'templatePernyataan'])->name('templates.pernyataan');
    Route::get('/templates/surat-kuasa', [PpkprNonBerusahaController::class, 'templateKuasa'])->name('templates.kuasa');
    
    // Pengelolaan Berkas (BPN, PU, Super Admin)
    Route::get('/berkas', [BerkasController::class, 'index'])->name('berkas.index');
    Route::post('/berkas', [BerkasController::class, 'store'])->name('berkas.store');
    Route::post('/berkas/sync', [BerkasController::class, 'sync'])->name('berkas.sync');
    Route::match(['get', 'post'], '/berkas/bulk-destroy', [BerkasController::class, 'bulkDestroy'])->name('berkas.bulk-destroy');
    Route::match(['get', 'post'], '/berkas/bulk_destroy', [BerkasController::class, 'bulkDestroy']);
    Route::match(['get', 'post'], '/berkas/bulk%20destroy', [BerkasController::class, 'bulkDestroy']);
    Route::match(['get', 'post'], '/berkas/bulk{any}', [BerkasController::class, 'bulkDestroy'])->where('any', '.*');
    Route::get('/berkas/{id}/download', [BerkasController::class, 'download'])->name('berkas.download');
    Route::get('/berkas/{id}/preview', [BerkasController::class, 'preview'])->name('berkas.preview');
    Route::delete('/berkas/{id}', [BerkasController::class, 'destroy'])->name('berkas.destroy');

    // Pengelolaan Dokumen Manual (Dokumen Baru)
    Route::get('/dokumen', [DokumenController::class, 'index'])->name('dokumen.index');
    Route::post('/dokumen', [DokumenController::class, 'store'])->name('dokumen.store');
    Route::post('/dokumen/destroy-all', [DokumenController::class, 'destroyAll'])->name('dokumen.destroy_all');
    Route::match(['get', 'post'], '/dokumen/bulk-destroy', [DokumenController::class, 'bulkDestroy'])->name('dokumen.bulk-destroy');
    Route::match(['get', 'post'], '/dokumen/bulk_destroy', [DokumenController::class, 'bulkDestroy']);
    Route::match(['get', 'post'], '/dokumen/bulk%20destroy', [DokumenController::class, 'bulkDestroy']);
    Route::match(['get', 'post'], '/dokumen/bulk-delete', [DokumenController::class, 'bulkDestroy']);
    Route::match(['get', 'post'], '/dokumen/delete-batch', [DokumenController::class, 'bulkDestroy']);
    Route::match(['get', 'post'], '/dokumen/bulk{any}', [DokumenController::class, 'bulkDestroy'])->where('any', '.*');
    Route::post('/dokumen/download-zip', [DokumenController::class, 'downloadZip'])->name('dokumen.download_zip');
    Route::post('/dokumen/download-batch', [DokumenController::class, 'downloadBatch'])->name('dokumen.download_batch');
    Route::get('/dokumen/{id}/download', [DokumenController::class, 'download'])->name('dokumen.download');
    Route::get('/dokumen/{id}/preview', [DokumenController::class, 'preview'])->name('dokumen.preview');
    Route::delete('/dokumen/{id}', [DokumenController::class, 'destroy'])->name('dokumen.destroy');

    // Pengelolaan Master Template Dokumen (CRUD Template)
    Route::get('/admin/templates', [TemplateDokumenController::class, 'index'])->name('admin.templates.index');
    Route::post('/admin/templates', [TemplateDokumenController::class, 'store'])->name('admin.templates.store');
    Route::put('/admin/templates/{id}', [TemplateDokumenController::class, 'update'])->name('admin.templates.update');
    Route::post('/admin/templates/{id}/toggle-active', [TemplateDokumenController::class, 'toggleActive'])->name('admin.templates.toggle_active');
    Route::get('/admin/templates/{id}/download', [TemplateDokumenController::class, 'download'])->name('admin.templates.download');
    Route::get('/admin/templates/{id}/preview', [TemplateDokumenController::class, 'preview'])->name('admin.templates.preview');
    Route::delete('/admin/templates/{id}', [TemplateDokumenController::class, 'destroy'])->name('admin.templates.destroy');

    // Admin Berita
    Route::get('/admin/berita', [\App\Http\Controllers\BeritaController::class, 'index'])->name('admin.berita.index');
    Route::get('/admin/berita/create', [\App\Http\Controllers\BeritaController::class, 'create'])->name('admin.berita.create');
    Route::post('/admin/berita', [\App\Http\Controllers\BeritaController::class, 'store'])->name('admin.berita.store');
    Route::post('/admin/berita/upload', [\App\Http\Controllers\BeritaController::class, 'upload'])->name('admin.berita.upload');
    Route::get('/admin/berita/{beritum}/edit', [\App\Http\Controllers\BeritaController::class, 'edit'])->name('admin.berita.edit');
    Route::put('/admin/berita/{beritum}', [\App\Http\Controllers\BeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/admin/berita/{beritum}', [\App\Http\Controllers\BeritaController::class, 'destroy'])->name('admin.berita.destroy');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Mailbox Routes
    Route::get('/mailbox', [App\Http\Controllers\MailboxController::class, 'index'])->name('mailbox.index');
    Route::get('/mailbox/{id}/read', [App\Http\Controllers\MailboxController::class, 'read'])->name('mailbox.read');
    Route::post('/mailbox/read-all', [App\Http\Controllers\MailboxController::class, 'markAllAsRead'])->name('mailbox.read_all');
    Route::get('/api/notifications/unread', [App\Http\Controllers\MailboxController::class, 'getUnread'])->name('api.notifications.unread');

});

// Rute untuk Halaman Sukses Upload
Route::get('/pengajuan/sukses', function () {
    return view('auth.pengajuan-sukses');
})->name('pengajuan.sukses');

// Rute untuk Download PDF Flowchart
Route::get('/flowchart.pdf', function () {
    $path = base_path('PATEN PAK MIKO FLOWCHART.pdf');
    if (!file_exists($path)) {
        abort(404, 'File not found.');
    }
    return response()->file($path);
});

// ---------------------------------------------------------
// ROUTE SETUP VPS (HAPUS ATAU COMMENT ROUTE INI JIKA SUDAH SELESAI!)
// ---------------------------------------------------------
// Route::get('/setup-vps', function() {
//     return "Disabled for security.";
// });

Route::get('/setup-dokumens', function() {
    if (!\Illuminate\Support\Facades\Schema::hasTable('dokumens')) {
        \Illuminate\Support\Facades\Schema::create('dokumens', function (\Illuminate\Database\Schema\Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_dokumen');
            $table->string('kategori')->nullable();
            $table->string('file_path');
            $table->string('tipe_file', 10)->nullable();
            $table->string('ukuran_file', 20)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
        return "Tabel dokumens berhasil dibuat!";
    }
    return "Tabel dokumens sudah ada.";
});

Route::get('/setup-copy', function() {
    $content = file_get_contents(app_path('Http/Controllers/BerkasController.php'));
    $content = str_replace('BerkasController', 'DokumenController', $content);
    $content = str_replace('use App\Models\Berkas;', 'use App\Models\Dokumen;', $content);
    $content = str_replace('Berkas::', 'Dokumen::', $content);
    $content = str_replace('$berkas', '$dokumen', $content);
    $content = str_replace('berkas.', 'dokumen.', $content);
    $content = str_replace('berkas/', 'dokumen/', $content);
    $content = str_replace('nama_berkas', 'nama_dokumen', $content);
    $content = str_replace('berkas', 'dokumen', $content);
    $content = str_replace('Berkas', 'Dokumen', $content);
    file_put_contents(app_path('Http/Controllers/DokumenController.php'), $content);

    $viewContent = file_get_contents(resource_path('views/berkas/index.blade.php'));
    $viewContent = str_replace('Berkas', 'Dokumen', $viewContent);
    $viewContent = str_replace('berkas', 'dokumen', $viewContent);
    $viewContent = str_replace('nama_berkas', 'nama_dokumen', $viewContent);
    
    $viewPath = resource_path('views/dokumen');
    if (!file_exists($viewPath)) {
        mkdir($viewPath, 0777, true);
    }
    file_put_contents($viewPath.'/index.blade.php', $viewContent);

    return "Copy done!";
});

Route::get('/debug-kat', function() {
    $berkas = \App\Models\Berkas::where('nama_berkas', 'like', '%[PKKPR Berusaha]%')->pluck('kategori')->unique();
    return response()->json($berkas);
});

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
use App\Http\Controllers\AdminDpnController;
use App\Http\Controllers\KbliController;
use Illuminate\Support\Facades\Route;
use App\Models\Review;
 
// Halaman utama / Landing Page
Route::get('/', function () {
    $formalReviews = Review::with('user')
        ->where('is_approved', true)
        ->latest()
        ->take(6)
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
        ->take(6)
        ->get()
        ->map(function ($item) {
            $item->module_label_display = 'INFORMAL - ' . strtoupper($item->informal_type);
            $item->reviewer_name = $item->name ?? ($item->user->name ?? ($item->user->username ?? 'Publik'));
            $item->reviewer_initial = strtoupper(substr($item->reviewer_name, 0, 2));
            return $item;
        });

    $reviews = $formalReviews->concat($informalReviews)->sortByDesc('created_at')->take(6);

    // Kalkulasi rata-rata keseluruhan (Review + InformalRating)
    $avgReview = Review::where('is_approved', true)->avg('rating') ?? 0;
    $countReview = Review::where('is_approved', true)->count();
    
    $avgInformal = \App\Models\InformalRating::where('is_approved', true)->avg('rating') ?? 0;
    $countInformal = \App\Models\InformalRating::where('is_approved', true)->count();
    
    $totalCount = $countReview + $countInformal;
    $averageRating = 0;
    if ($totalCount > 0) {
        $averageRating = (($avgReview * $countReview) + ($avgInformal * $countInformal)) / $totalCount;
    }
    $averageRating = number_format($averageRating, 1);
    
    // Hitung visitor
    $visitorFile = 'visitor_stats.json';
    $visitorCount = 0;
    if (\Illuminate\Support\Facades\Storage::exists($visitorFile)) {
        $visitorCount = json_decode(\Illuminate\Support\Facades\Storage::get($visitorFile), true)['count'] ?? 0;
    }
    
    $isNewVisitor = false;
    if (!request()->cookie('visited')) {
        $visitorCount++;
        \Illuminate\Support\Facades\Storage::put($visitorFile, json_encode(['count' => $visitorCount]));
        $isNewVisitor = true;
    }

    $response = response()->view('welcome', compact('reviews', 'averageRating', 'visitorCount'));
    if ($isNewVisitor) {
        $response->cookie('visited', true, 60 * 24); // 24 jam
    }
    
    return $response;
});

// Rute Peta Publik Informal (Tanpa Login)
Route::get('/informal', [InformalController::class, 'index'])->name('informal.index');

// Rute LAPOLPAK (Bisa Tanpa Login & Dengan Login)
Route::get('/lapolpak', [LapolpaController::class, 'index'])->name('lapolpa.index');
Route::post('/lapolpak', [LapolpaController::class, 'store'])->name('lapolpa.store');
Route::put('/lapolpak/{id}', [LapolpaController::class, 'updateStatus'])->name('lapolpa.update');
Route::post('/informal/rating', [InformalController::class, 'storeRating'])->name('informal.rating.store');

// Rute Publik PTP Form
Route::get('/permohonan-ptp', [AuthController::class, 'showPtpForm'])->name('ptp.create');
Route::post('/permohonan-ptp', [AuthController::class, 'storePtpForm'])->name('ptp.store');

// Entrypoint Publik PPKPR Baru (Guest dialihkan ke PTP form secara otomatis di Controller)
Route::get('/berusaha/baru', [PpkprBerusahaController::class, 'create'])->name('berusaha.create');
Route::post('/berusaha/baru', [PpkprBerusahaController::class, 'store'])->name('berusaha.store');
Route::get('/non-berusaha/baru', [PpkprNonBerusahaController::class, 'create'])->name('non-berusaha.create');
Route::post('/non-berusaha/baru', [PpkprNonBerusahaController::class, 'store'])->name('non-berusaha.store');
Route::get('/kebijakan/baru', [KebijakanController::class, 'create'])->name('kebijakan.create');
Route::post('/kebijakan/baru', [KebijakanController::class, 'store'])->name('kebijakan.store');
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
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/admin_dpn', [AdminDpnController::class, 'index'])->name('admin_dpn.index');
    Route::post('/admin_dpn', [AdminDpnController::class, 'update'])->name('admin_dpn.update');
    Route::post('/souvenir/send/{type}/{id}', [AdminDpnController::class, 'markSouvenirSent'])->name('souvenir.mark_sent');
    Route::post('/application/rollback/{type}/{id}', [AdminDpnController::class, 'rollbackStatus'])->name('application.rollback');
    
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    
    // PPKPR Non-Berusaha (Pelaku Usaha & Petugas Verifikasi)
    Route::get('/non-berusaha', [PpkprNonBerusahaController::class, 'index'])->name('non-berusaha.index');
    Route::get('/non-berusaha/{id}', [PpkprNonBerusahaController::class, 'show'])->name('non-berusaha.show');
    Route::get('/non-berusaha/{id}/ptp', [PpkprNonBerusahaController::class, 'ptpPdf'])->name('non-berusaha.ptp_pdf');
    Route::post('/non-berusaha/{id}/verifikasi', [PpkprNonBerusahaController::class, 'verify'])->name('non-berusaha.verify');
 
    // Kebijakan Khusus & Tanah Timbul
    Route::get('/kebijakan', [KebijakanController::class, 'index'])->name('kebijakan.index');
    Route::get('/kebijakan/{id}', [KebijakanController::class, 'show'])->name('kebijakan.show');
    Route::get('/kebijakan/{id}/ptp', [KebijakanController::class, 'ptpPdf'])->name('kebijakan.ptp_pdf');
    Route::post('/kebijakan/{id}/verifikasi', [KebijakanController::class, 'verify'])->name('kebijakan.verify');

    // Tanah Timbul
    Route::get('/tanah-timbul', [TanahTimbulController::class, 'index'])->name('tanah-timbul.index');
    Route::get('/tanah-timbul/{id}', [TanahTimbulController::class, 'show'])->name('tanah-timbul.show');
    Route::get('/tanah-timbul/{id}/ptp', [TanahTimbulController::class, 'ptpPdf'])->name('tanah-timbul.ptp_pdf');
    Route::post('/tanah-timbul/{id}/verifikasi', [TanahTimbulController::class, 'verify'])->name('tanah-timbul.verify');

    // PSN (Proyek Strategis Nasional)
    Route::get('/psn', [PsnController::class, 'index'])->name('psn.index');
    Route::get('/psn/{id}', [PsnController::class, 'show'])->name('psn.show');
    Route::get('/psn/{id}/ptp', [PsnController::class, 'ptpPdf'])->name('psn.ptp_pdf');
    Route::post('/psn/{id}/verifikasi', [PsnController::class, 'verify'])->name('psn.verify');
 
    // PPKPR Berusaha (Pelaku Usaha, BPN, Dinas PU, & Satu Pintu)
    Route::get('/berusaha', [PpkprBerusahaController::class, 'index'])->name('berusaha.index');
    Route::get('/berusaha/{id}', [PpkprBerusahaController::class, 'show'])->name('berusaha.show');
    Route::get('/berusaha/{id}/ptp', [PpkprBerusahaController::class, 'ptpPdf'])->name('berusaha.ptp_pdf');
    Route::post('/berusaha/{id}/verifikasi', [PpkprBerusahaController::class, 'verify'])->name('berusaha.verify');
    
    // Fitur Ulasan (Review)
    Route::get('/ulasan', [ReviewController::class, 'index'])->name('ulasan.index');
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
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
    
    // Unduhan Template Persyaratan (Pelaku Usaha)
    Route::get('/templates/berkas-persyaratan', [PpkprNonBerusahaController::class, 'templatePersyaratan'])->name('templates.persyaratan');
    Route::get('/templates/surat-pernyataan', [PpkprNonBerusahaController::class, 'templatePernyataan'])->name('templates.pernyataan');
    Route::get('/templates/surat-kuasa', [PpkprNonBerusahaController::class, 'templateKuasa'])->name('templates.kuasa');
    
    // Pengelolaan Berkas (BPN, PU, Super Admin)
    Route::get('/berkas', [BerkasController::class, 'index'])->name('berkas.index');
    Route::post('/berkas', [BerkasController::class, 'store'])->name('berkas.store');
    Route::post('/berkas/sync', [BerkasController::class, 'sync'])->name('berkas.sync');
    Route::get('/berkas/{id}/download', [BerkasController::class, 'download'])->name('berkas.download');
    Route::get('/berkas/{id}/preview', [BerkasController::class, 'preview'])->name('berkas.preview');
    Route::delete('/berkas/{id}', [BerkasController::class, 'destroy'])->name('berkas.destroy');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

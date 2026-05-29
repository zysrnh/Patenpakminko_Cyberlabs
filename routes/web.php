<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PpkprNonBerusahaController;
use App\Http\Controllers\KebijakanController;
use App\Http\Controllers\PpkprBerusahaController;
use App\Http\Controllers\LapolpaController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\InformalController;
use Illuminate\Support\Facades\Route;
use App\Models\Review;
 
// Halaman utama / Landing Page
Route::get('/', function () {
    $reviews = Review::with('user')
        ->where('is_approved', true)
        ->latest()
        ->take(6)
        ->get();
    return view('welcome', compact('reviews'));
});

// Rute Peta Publik Informal (Tanpa Login)
Route::get('/informal', [InformalController::class, 'index'])->name('informal.index');

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
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    
    // PPKPR Non-Berusaha (Pelaku Usaha & Petugas Verifikasi)
    Route::get('/non-berusaha', [PpkprNonBerusahaController::class, 'index'])->name('non-berusaha.index');
    Route::get('/non-berusaha/{id}', [PpkprNonBerusahaController::class, 'show'])->name('non-berusaha.show');
    Route::post('/non-berusaha/{id}/verifikasi', [PpkprNonBerusahaController::class, 'verify'])->name('non-berusaha.verify');
 
    // Kebijakan Khusus (Pelaku Usaha & Petugas Verifikasi)
    Route::get('/kebijakan', [KebijakanController::class, 'index'])->name('kebijakan.index');
    Route::get('/kebijakan/{id}', [KebijakanController::class, 'show'])->name('kebijakan.show');
    Route::post('/kebijakan/{id}/verifikasi', [KebijakanController::class, 'verify'])->name('kebijakan.verify');
 
    // PPKPR Berusaha (Pelaku Usaha, BPN, Dinas PU, & Satu Pintu)
    Route::get('/berusaha', [PpkprBerusahaController::class, 'index'])->name('berusaha.index');
    Route::get('/berusaha/{id}', [PpkprBerusahaController::class, 'show'])->name('berusaha.show');
    Route::post('/berusaha/{id}/verifikasi', [PpkprBerusahaController::class, 'verify'])->name('berusaha.verify');
    
    // LAPOLPA (Layanan Pelaporan / Booking Jadwal Pelaporan)
    Route::get('/lapolpa', [LapolpaController::class, 'index'])->name('lapolpa.index');
    Route::post('/lapolpa', [LapolpaController::class, 'store'])->name('lapolpa.store');
    Route::put('/lapolpa/{id}', [LapolpaController::class, 'updateStatus'])->name('lapolpa.update');
 
    // Fitur Ulasan (Review)
    Route::get('/ulasan', [ReviewController::class, 'index'])->name('ulasan.index');
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
    Route::get('/admin/reviews', [ReviewController::class, 'adminIndex'])->name('admin.reviews.index');
    Route::post('/admin/reviews/{id}/approve', [ReviewController::class, 'approve'])->name('admin.reviews.approve');
    Route::delete('/admin/reviews/{id}', [ReviewController::class, 'destroy'])->name('admin.reviews.destroy');
 
    // WhatsApp Gateway Settings (DPN / Super Admin)
    Route::get('/dpn/whatsapp', [PpkprNonBerusahaController::class, 'whatsappSettings'])->name('dpn.whatsapp');
    Route::post('/dpn/whatsapp/save', [PpkprNonBerusahaController::class, 'saveWhatsappSettings'])->name('dpn.whatsapp.save');
    Route::post('/dpn/whatsapp/toggle', [PpkprNonBerusahaController::class, 'toggleWhatsappConnection'])->name('dpn.whatsapp.toggle');
    
    // Unduhan Template Persyaratan (Pelaku Usaha)
    Route::get('/templates/berkas-persyaratan', [PpkprNonBerusahaController::class, 'templatePersyaratan'])->name('templates.persyaratan');
    Route::get('/templates/surat-pernyataan', [PpkprNonBerusahaController::class, 'templatePernyataan'])->name('templates.pernyataan');
    Route::get('/templates/surat-kuasa', [PpkprNonBerusahaController::class, 'templateKuasa'])->name('templates.kuasa');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PpkprNonBerusahaController;
use Illuminate\Support\Facades\Route;

// Halaman utama / Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Rute untuk tamu (Guest Only)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
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
    Route::get('/non-berusaha/baru', [PpkprNonBerusahaController::class, 'create'])->name('non-berusaha.create');
    Route::post('/non-berusaha/baru', [PpkprNonBerusahaController::class, 'store'])->name('non-berusaha.store');
    Route::get('/non-berusaha/{id}', [PpkprNonBerusahaController::class, 'show'])->name('non-berusaha.show');
    Route::post('/non-berusaha/{id}/verifikasi', [PpkprNonBerusahaController::class, 'verify'])->name('non-berusaha.verify');
    
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

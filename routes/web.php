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
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

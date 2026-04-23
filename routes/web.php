<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\Auth\LoginController;

// 1. Rute Auth (Publik)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout'); 

// 2. Rute yang butuh Login
Route::middleware(['auth'])->group(function () {
    
    // Halaman Utama: Langsung arahkan ke dashboard masing-masing
    Route::get('/', [AdminController::class, 'index'])->name('home');

    // DASHBOARD UNTUK SEMUA ROLE (Agar Login tidak 404)
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/guru/dashboard', [AdminController::class, 'index'])->name('guru.dashboard');
    Route::get('/siswa/dashboard', [AdminController::class, 'index'])->name('siswa.dashboard');
    Route::get('/petugas/dashboard', [AdminController::class, 'index'])->name('petugas.dashboard');
    Route::get('/kepsek/dashboard', [AdminController::class, 'index'])->name('kepsek.dashboard');

    // FITUR KHUSUS ADMIN (No 12-19)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('siswa', SiswaController::class);
        Route::resource('guru', GuruController::class);
    });

    // FITUR INPUT ASPIRASI (No 3 & 16: Siswa & Admin)
    Route::middleware(['role:siswa|admin'])->group(function () {
        Route::get('/aspirasi/input', [AspirasiController::class, 'create'])->name('aspirasi.create');
        Route::post('/aspirasi/input', [AspirasiController::class, 'store'])->name('aspirasi.store');
    });

    // FITUR LIHAT ASPIRASI (No 8-11: Guru, Petugas, Kepsek, Admin)
    Route::middleware(['role:admin|guru|petugas|kepsek'])->group(function () {
        Route::get('/aspirasi/lihat', [AspirasiController::class, 'index'])->name('aspirasi.index');
    });
});

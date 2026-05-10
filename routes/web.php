<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\KepsekController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\DashboardSiswaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KelasController; 
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\Auth\LoginController;

// 1. Rute Publik
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// 2. Rute yang butuh Login
Route::middleware(['auth'])->group(function () {
    
    // Dashboard Utama
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // --- FITUR KHUSUS ADMIN ---
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard.admin');
        
        // Resource ini sudah otomatis mencakup semua fungsi CRUD (Index, Create, Store, Edit, Update, Destroy)
        Route::resource('siswa', SiswaController::class);
        Route::resource('guru', GuruController::class);
        Route::resource('petugas', PetugasController::class);
        Route::resource('kepsek', KepsekController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('ruangan', RuanganController::class);
        
        // CRUD KELAS & JURUSAN
        Route::resource('kelas', KelasController::class);
        Route::resource('jurusan', JurusanController::class);
    });

    // --- FITUR KHUSUS SISWA ---
    Route::middleware(['role:siswa'])->group(function () {
        Route::get('/aspirasi/input', [AspirasiController::class, 'create'])->name('siswa.create');
        Route::post('/aspirasi/simpan', [AspirasiController::class, 'store'])->name('aspirasi.store');
        Route::get('/aspirasi/histori', [AspirasiController::class, 'history'])->name('aspirasi.history');
    });

    // --- FITUR MONITORING (Admin, Guru, Petugas, Kepsek) ---
    Route::middleware(['role:admin|guru|petugas|kepsek'])->group(function () {
        Route::get('/aspirasi/monitoring', [AspirasiController::class, 'index'])->name('aspirasi.index');
        Route::get('/aspirasi/lihat', [AspirasiController::class, 'lihatSemua'])->name('aspirasi.lihat');
        Route::post('/aspirasi/update-status/{id}', [AspirasiController::class, 'updateStatus'])->name('aspirasi.updateStatus');
        Route::get('/aspirasi/detail/{id}', [AspirasiController::class, 'show'])->name('aspirasi.show');
    });

    // --- DASHBOARD ROLE LAIN ---
    // Route::middleware(['role:guru'])->prefix('guru')->group(function () {
    //     Route::get('/dashboard', [GuruController::class, 'index'])->name('guru.dashboard');
    // });

    Route::middleware(['role:petugas'])->prefix('petugas')->group(function () {
        Route::get('/dashboard', [PetugasController::class, 'index'])->name('petugas.dashboard');
    });

    Route::middleware(['role:kepsek'])->prefix('kepsek')->group(function () {
        Route::get('/dashboard', [KepsekController::class, 'index'])->name('kepsek.dashboard');
    });

});

    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\SiswaController;
    use App\Http\Controllers\GuruController;
    use App\Http\Controllers\PetugasController;
    use App\Http\Controllers\KepsekController;
    use App\Http\Controllers\AspirasiController;
    use App\Http\Controllers\KategoriController;
    use App\Http\Controllers\RuanganController;
    use App\Http\Controllers\Auth\LoginController;

    // 1. Rute Publik (Arahkan langsung ke login)
    Route::get('/', function () {
        return redirect()->route('login');
    });

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    // Cari baris ini di web.php dan ubah POST jadi GET
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    // Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); 

    // 2. Rute yang butuh Login (Semua Role)
    Route::middleware(['auth'])->group(function () {
        
        // Dashboard Utama (Logika pengalihan role biasanya ada di sini)
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // --- FITUR KHUSUS ADMIN ---
// Tambahkan ->name('admin.') di sini
Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard.admin');
    
    Route::resource('siswa', SiswaController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('petugas', PetugasController::class);
    Route::resource('kepsek', KepsekController::class);
    
    Route::resource('kategori', KategoriController::class);
    Route::resource('ruangan', RuanganController::class);

    Route::get('/kelas', [AdminController::class, 'kelas'])->name('kelas');
    Route::get('/jurusan', [AdminController::class, 'jurusan'])->name('jurusan');
});


    // --- FITUR KHUSUS SISWA ---
    Route::middleware(['role:siswa'])->group(function () { // Hapus prefix('siswa')
    Route::get('/aspirasi/input', [AspirasiController::class, 'create'])->name('siswa.create');
        // Pastikan diarahkan ke SiswaController, bukan AdminController
        Route::get('/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');
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

        // Tambahkan ini di bawah grup Admin atau Siswa
    Route::middleware(['role:guru'])->prefix('guru')->group(function () {
        Route::get('/guru/dashboard', [GuruController::class, 'index'])->name('guru.dashboard');
    });

    Route::middleware(['role:petugas'])->prefix('petugas')->group(function () {
        Route::get('/petugas/dashboard', [PetugasController::class, 'index'])->name('petugas.dashboard');
    });

    Route::middleware(['role:kepsek'])->prefix('kepsek')->group(function () {
        Route::get('/kepsek/dashboard', [KepsekController::class, 'index'])->name('kepsek.dashboard');
    });

    });

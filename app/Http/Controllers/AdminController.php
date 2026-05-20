<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Aspirasi;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Petugas;
use App\Models\Kepsek;
use Spatie\Permission\Models\Role; 

class AdminController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        // 1. DASHBOARD UNTUK ADMIN (statistik lengkap)
        if ($user->hasRole('admin')) {
            // Total data master (pakai model masing-masing)
            $totalSiswa = Siswa::count();
            $totalGuru = Guru::count();
            $totalKepsek = Kepsek::count();
            $totalPetugas = Petugas::count();
            $totalAspirasi = Aspirasi::count();
            
            // Statistik berdasarkan status
            $aspirasiMenunggu = Aspirasi::where('status', 'menunggu')->count();
            $aspirasiProses = Aspirasi::where('status', 'proses')->count();
            $aspirasiSelesai = Aspirasi::where('status', 'selesai')->count();
            
            // 5 aspirasi terbaru
            $aspirasiTerbaru = Aspirasi::with(['siswa', 'guru', 'kategori'])
                                ->orderBy('created_at', 'DESC')
                                ->limit(5)
                                ->get();

            return view('admin.dashboard.admin', compact(
                'totalSiswa', 
                'totalGuru', 
                'totalKepsek', 
                'totalPetugas', 
                'totalAspirasi',
                'aspirasiMenunggu',
                'aspirasiProses',
                'aspirasiSelesai',
                'aspirasiTerbaru'
            ));
        } 
        
        // 2. DASHBOARD UNTUK GURU
        if ($user->hasRole('guru')) {
            return redirect()->route('guru.monitoring');
        } 

        // 3. DASHBOARD UNTUK SISWA (arahkan ke form buat aspirasi)
        if ($user->hasRole('siswa')) {
            return redirect()->route('siswa.create');
        }

        // 4. DASHBOARD UNTUK PETUGAS
        if ($user->hasRole('petugas')) {
            return redirect()->route('aspirasi.monitoring');
        }

        // 5. DASHBOARD UNTUK KEPSEK
        if ($user->hasRole('kepsek')) {
            return redirect()->route('aspirasi.monitoring');
        }

        // Jika user login tapi tidak punya role di atas
        abort(403, 'Anda tidak memiliki akses ke dashboard mana pun.');
    }
}
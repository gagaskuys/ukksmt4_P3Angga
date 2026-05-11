<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Spatie\Permission\Models\Role; 

class AdminController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        // 1. Logika untuk ADMIN (Nomor 4)
        if ($user->hasRole('admin')) {
            $totalSiswa = User::role('siswa')->count();
            $totalGuru = User::role('guru')->count();
            $totalKepsek = User::role('kepsek')->count();
            $totalPetugas = User::role('petugas')->count();
            $totalAspirasi = \App\Models\Aspirasi::count(); 

            return view('admin.dashboard.admin', compact('totalSiswa', 'totalGuru', 'totalKepsek', 'totalPetugas',  'totalAspirasi'));
        } 
        
        // 2. Logika untuk GURU (Nomor 5)
        if ($user->hasRole('guru')) {
            return view('admin.guru.index');
        } 

        // 3. Logika untuk SISWA (Nomor 6)
        if ($user->hasRole('siswa')) {
            $totalAspirasiSaya = \App\Models\Aspirasi::where('siswa_id', $user->id)->count();
            return view('siswa.create', compact('totalAspirasiSaya'));
        }

        // 4. Logika untuk PETUGAS (Nomor 7)
        if ($user->hasRole('petugas')) {
            return view('admin.petugas.index');
        }

        // 5. Logika untuk KEPSEK (Nomor 8)
        if ($user->hasRole('kepsek')) {
            return view('admin.kepsek.index');
        }

        // Jika user login tapi tidak punya role di atas
        abort(403, 'Anda tidak memiliki akses ke dashboard mana pun.');
    }
}

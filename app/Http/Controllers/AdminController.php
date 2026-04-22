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
            $totalAspirasi = 0; // Nanti diisi jika tabel aspirasi sudah ada

            return view('admin.dashboard.admin', compact('totalSiswa', 'totalGuru', 'totalAspirasi'));
        } 
        
        // 2. Logika untuk GURU (Nomor 5)
        if ($user->hasRole('guru')) {
            return view('guru.dashboard.guru');
        } 

        // 3. Logika untuk SISWA (Nomor 6)
        if ($user->hasRole('siswa')) {
            return view('siswa.dashboard.siswa');
        }

        // 4. Logika untuk PETUGAS (Nomor 7)
        if ($user->hasRole('petugas')) {
            return view('petugas.dashboard.petugas');
        }

        // 5. Logika untuk KEPSEK (Nomor 8)
        if ($user->hasRole('kepsek')) {
            return view('kepsek.dashboard.kepsek');
        }

        // Jika user login tapi tidak punya role di atas
        abort(403, 'Anda tidak memiliki akses ke dashboard mana pun.');
    }
}

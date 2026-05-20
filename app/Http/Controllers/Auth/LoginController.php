<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
        public function showLoginForm() {
            return view('auth.login');
        }
        public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            /** @var \App\Models\User $user */
            $user = Auth::user();

            // ✅ SUDAH DIPERBAIKI SEMUA RUTE
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } 
            
            if ($user->role === 'guru') {
                return redirect()->route('guru.dashboard'); // <-- Bisa juga ke sini biar masuk menu guru
                // return redirect()->route('aspirasi.monitoring'); // <-- Atau tetap ke sini, sama saja
            } 
            
            if ($user->role === 'siswa') {
                return redirect()->intended(route('siswa.create'));
            } 
            
            // ✅ UBAH: Petugas & Kepsek diarahkan ke rute yang ADA & AKTIF
            if ($user->role === 'petugas') {
                return redirect()->intended(route('aspirasi.monitoring'));
            } 
            
            if ($user->role === 'kepsek') {
                return redirect()->intended(route('aspirasi.monitoring'));
            }

            // Default jika tidak ada role khusus
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

        public function logout(Request $request) 
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
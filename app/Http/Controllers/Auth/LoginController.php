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

        // REDIRECT DISESUAIKAN DENGAN RUTE DI WEB.PHP
        if ($user->hasRole('admin')) {
            return redirect()->intended('/admin/dashboard');
        } 
        
        if ($user->hasRole('guru')) {
            return redirect()->intended('/guru/dashboard');
        } 
        
        if ($user->hasRole('siswa')) {
            // Kita arahkan ke dashboard siswa dulu baru dia bisa pilih menu input
            return redirect()->intended('/siswa/dashboard'); 
        } 
        
        if ($user->hasRole('petugas')) {
            return redirect()->intended('/petugas/dashboard');
        } 
        
        if ($user->hasRole('kepsek')) {
            return redirect()->intended('/kepsek/dashboard');
        }

        // Default jika tidak ada role khusus
        return redirect()->intended('/');
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

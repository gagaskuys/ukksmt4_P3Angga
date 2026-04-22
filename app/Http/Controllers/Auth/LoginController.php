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
            
            /** @var \App\Models\User $user */ // <--- Tambahkan baris ini
            $user = Auth::user();

            // Sekarang garis merah di bawah hasRole harusnya hilang
            if ($user->hasRole('admin')) return redirect()->intended('/admin/dashboard');
            if ($user->hasRole('siswa')) return redirect()->intended('/aspirasi/input');
            
            return redirect()->intended('/aspirasi/lihat');
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

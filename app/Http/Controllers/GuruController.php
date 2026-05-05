<?php

namespace App\Http\Controllers;

use App\Models\Guru; // Jangan lupa tambahkan pemanggilan Model Guru
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        // Ambil semua data guru dari tabel
        $gurus = Guru::latest()->get();

        // Kirim variabel $gurus ke tampilan
        return view('guru.dashboard.guru', compact('gurus'));
    }
}
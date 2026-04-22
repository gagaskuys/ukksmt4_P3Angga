<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import Model User karena data siswa ada di sana

class SiswaController extends Controller
{
    public function index()
    {
        // Mengambil semua user yang memiliki role 'siswa'
        $siswas = User::role('siswa')->get();

        // Mengarahkan ke view (kita akan buat view ini setelah ini)
        return view('admin.siswa.index', compact('siswas'));
    }
}

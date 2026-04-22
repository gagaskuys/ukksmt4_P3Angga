<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        // Untuk sementara diarahkan ke view dashboard guru
        return view('guru.dashboard.guru');
    }
}

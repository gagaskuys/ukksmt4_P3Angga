<?php

namespace App\Http\Controllers; // Harus persis begini

use Illuminate\Http\Request;

class DashboardSiswaController extends Controller // Nama class harus sama dengan nama file
{
    public function index()
    {
        return view('siswa.dashboard.siswa'); // Pastikan view ini ada di resources/views/siswa/dashboard/siswa.blade.php
    }
}

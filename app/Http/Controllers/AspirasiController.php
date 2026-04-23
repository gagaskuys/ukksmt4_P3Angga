<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Aspirasi; // Nanti aktifkan ini jika model Aspirasi sudah dibuat

class AspirasiController extends Controller
{
    public function index()
{
    // 1. Ambil data aspirasi (nanti kalau sudah ada tabelnya)
    // $aspirasi = Aspirasi::all(); 

    // 2. Arahkan ke halaman riwayat aspirasi, BUKAN ke dashboard admin
    return view('aspirasi.index'); 
}

    public function create()
{
    // Arahkan ke file form, bukan ke dashboard lagi
    return view('siswa.create');
}
public function store(Request $request)
{
    // 1. Validasi data
    $request->validate([
        'topik' => 'required',
        'cerita' => 'required',
    ]);

    // 2. Logika Simpan (Nanti kita hubungkan ke Database setelah buat tabel)
    // Untuk sekarang, kita kembalikan ke dashboard dengan pesan sukses dulu
    return redirect()->back()->with('success', 'Aspirasi berhasil dikirim!');
}

}

<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori; // Tambahkan ini jika butuh list kategori di form
use App\Models\Ruangan;  // Tambahkan ini jika butuh list ruangan di form
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    /**
     * Menampilkan Form Input Aspirasi (No. 16)
     */
    // Di AspirasiController.php
public function create()
{
    // Ambil semua data kategori
    $kategoris = \App\Models\Kategori::all();
    
    // Ambil semua data ruangan
    $ruangans = \App\Models\Ruangan::all();

    // Kirim ke tampilan
    return view('siswa.create', compact('kategoris', 'ruangans'));
}
    /**
     * Menyimpan Data Aspirasi (No. 16)
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'ruangan_id' => 'required',
            'deskripsi_laporan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Proses simpan foto jika ada
        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('aspirasi', 'public');
        }

        // Ambil data siswa yang sedang login melalui relasi user -> siswa
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            return redirect()->back()->with('error', 'Data profil siswa tidak ditemukan.');
        }

        Aspirasi::create([
            'siswa_id'          => $siswa->id,
            'kategori_id'       => $request->kategori_id,
            'ruangan_id'        => $request->ruangan_id,
            'deskripsi_laporan' => $request->deskripsi_laporan,
            'foto'              => $path,
            'status'            => 'menunggu', // Status default
        ]);

        return redirect()->route('aspirasi.history')->with('success', 'Aspirasi berhasil dikirim!');
    }

    /**
     * Menampilkan Histori Aspirasi Siswa (No. 17)
     */
    public function history()
    {
        $siswa = Auth::user()->siswa;
        
        // Ambil aspirasi hanya milik siswa yang login
        $aspirasis = Aspirasi::where('siswa_id', $siswa->id)->latest()->get();

        // Mengarah ke resources/views/siswa/history.blade.php (buat file ini jika belum ada)
        return view('siswa.history', compact('aspirasis'));
    }

    /**
     * Menampilkan Monitoring Aspirasi untuk Admin/Guru/Kepsek (No. 19)
     */
    public function index()
{
    // 1. Ambil data untuk tabel
    $aspirasis = Aspirasi::with(['siswa', 'kategori', 'ruangan'])->latest()->get();

    // 2. Ambil data statistik per kategori
    // Kita kelompokkan berdasarkan kategori_id dan hitung jumlahnya
    $statistikKategori = Aspirasi::with('kategori')
        ->select('kategori_id', DB::raw('count(*) as total'))
        ->groupBy('kategori_id')
        ->get();

    return view('aspirasi.monitoring', compact('aspirasis', 'statistikKategori'));
}

    public function lihatSemua()
{
    // Mengambil semua data aspirasi
    $aspirasis = Aspirasi::with(['siswa', 'kategori', 'ruangan'])->latest()->get();
    
    // Mengarah ke file view yang kamu inginkan (misal: aspirasi/index.blade.php)
    return view('aspirasi.index', compact('aspirasis'));
}

}

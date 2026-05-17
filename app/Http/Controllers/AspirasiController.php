<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori; 
use App\Models\Ruangan;  
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    /**
     * Menampilkan Form Input Aspirasi (No. 16)
     */
    public function create()
    {
        $kategoris = Kategori::all();
        $ruangans = Ruangan::all();

        // Diarahkan ke resources/views/siswa/create.blade.php sesuai struktur filemu
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

        // Proses simpan foto jika diunggah oleh siswa
        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('aspirasi', 'public');
        }

        // Menggunakan method pencarian instan agar aman dari error Object Null
        $user = Auth::user();
        $siswa = \App\Models\Siswa::where('user_id', $user->id)->first();

        if (!$siswa) {
            return redirect()->back()->withErrors(['error' => 'Profil identitas Siswa Anda tidak ditemukan di sistem. Harap hubungi Admin.'])->withInput();
        }

        Aspirasi::create([
            'siswa_id'          => $siswa->id, // Mengunci ke ID tabel siswas menggunakan kolom 'id'
            'kategori_id'       => $request->kategori_id,
            'ruangan_id'        => $request->ruangan_id,
            'deskripsi_laporan' => $request->deskripsi_laporan,
            'foto'              => $path,
            'status'            => 'menunggu', 
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Aspirasi berhasil dikirim!');
    }

    /**
     * Menampilkan Histori Aspirasi Siswa (No. 17)
     */
    public function history()
    {
        $user = Auth::user();
        $siswa = \App\Models\Siswa::where('user_id', $user->id)->first();
        
        if (!$siswa) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        }
        
        // Ambil aspirasi hanya milik siswa yang login
        $aspirasis = Aspirasi::where('siswa_id', $siswa->id)->latest()->get();

        return view('siswa.history', compact('aspirasis'));
    }

    /**
     * Menampilkan Monitoring Aspirasi untuk Admin/Guru/Kepsek (No. 19)
     */
    public function index()
    {
        $aspirasis = Aspirasi::with(['siswa', 'kategori', 'ruangan'])->latest()->get();

        $statistikKategori = Aspirasi::with('kategori')
            ->select('kategori_id', DB::raw('count(*) as total'))
            ->groupBy('kategori_id')
            ->get();

        return view('aspirasi.monitoring', compact('aspirasis', 'statistikKategori'));
    }

    public function lihatSemua()
    {
        $aspirasis = Aspirasi::with(['siswa', 'kategori', 'ruangan'])->latest()->get();
        
        return view('aspirasi.index', compact('aspirasis'));
    }
}

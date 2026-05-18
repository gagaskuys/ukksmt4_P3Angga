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
     * Menampilkan Form Input Aspirasi 
     */
    public function create()
    {
        $kategoris = Kategori::all();
        $ruangans = Ruangan::all();

        return view('siswa.create', compact('kategoris', 'ruangans'));
    }

    /**
     * Menyimpan Data Aspirasi 
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'ruangan_id' => 'required',
            'deskripsi_laporan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Proses simpan foto jika diunggah
        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('aspirasi', 'public');
        }

        // Ambil data user & siswa yang sedang LOGIN
        $user = Auth::user();
        $siswa = \App\Models\Siswa::where('user_id', $user->id)->first();

        if (!$siswa) {
            return redirect()->back()->withErrors(['error' => 'Profil identitas Siswa Anda tidak ditemukan di sistem. Harap hubungi Admin.'])->withInput();
        }

        // ✅ SIMPAN DATA TANPA NOMOR PROGRES
        Aspirasi::create([
            'siswa_id'          => $siswa->id,
            'kategori_id'       => $request->kategori_id,
            'ruangan_id'        => $request->ruangan_id,
            'deskripsi_laporan' => $request->deskripsi_laporan,
            'foto'              => $path,
            'status'            => 'menunggu', 
        ]);

        return redirect()->route('aspirasi.history')->with('success', 'Aspirasi berhasil dikirim!');
    }

    /**
     * Menampilkan Histori Aspirasi Siswa 
     */
    public function history()
    {
        $user = Auth::user();
        $siswa = \App\Models\Siswa::where('user_id', $user->id)->first();
        
        if (!$siswa) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        }
        
        // ✅ Ambil data urut dari yang TERBARU masuk ke paling atas (pakai waktu)
        $aspirasis = Aspirasi::where('siswa_id', $siswa->id)
                        ->with(['kategori', 'ruangan']) // Ambil nama kategori & ruangan
                        ->orderBy('created_at', 'DESC') // Urut berdasarkan waktu dibuat
                        ->get();

        return view('aspirasi.history', compact('aspirasis'));
    }

    /**
     * Menampilkan Monitoring Aspirasi untuk Admin/Guru/Kepsek 
     */
    /**
 * Menampilkan Monitoring Aspirasi untuk Admin/Guru/Kepsek
 */
public function index()
{
    // Ubah ->get() menjadi ->paginate(10)
    $aspirasis = Aspirasi::with(['siswa', 'kategori', 'ruangan'])->latest()->paginate(10);

    $statistikKategori = Aspirasi::with('kategori')
        ->select('kategori_id', DB::raw('count(*) as total'))
        ->groupBy('kategori_id')
        ->get();

    return view('aspirasi.monitoring', compact('aspirasis', 'statistikKategori'));
}

public function lihatSemua()
{
    // Ubah ->get() menjadi ->paginate(10)
    $aspirasis = Aspirasi::with(['siswa', 'kategori', 'ruangan'])->latest()->paginate(10);
    
    return view('aspirasi.index', compact('aspirasis'));
}
}
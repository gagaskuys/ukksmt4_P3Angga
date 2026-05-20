<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    public function monitoring(Request $request)
{
    $query = Aspirasi::with(['siswa', 'guru', 'kategori', 'ruangan'])->orderBy('created_at', 'DESC');

    // 🔍 FILTER BERDASARKAN STATUS
    if ($request->status && $request->status != 'all') {
        $query->where('status', $request->status);
    }
    
    // 🔍 FILTER BERDASARKAN KATEGORI
    if ($request->kategori_id) {
        $query->where('kategori_id', $request->kategori_id);
    }
    
    // 🔍 FILTER BERDASARKAN TANGGAL
    if ($request->tanggal) {
        $query->whereDate('created_at', $request->tanggal);
    }
    
    // 🔍 PENCARIAN NAMA PELAPOR (SISWA/GURU)
    if ($request->search_nama) {
        $query->where(function($q) use ($request) {
            $q->whereHas('siswa', function($sq) use ($request) {
                $sq->where('name', 'like', '%' . $request->search_nama . '%');
            })->orWhereHas('guru', function($gq) use ($request) {
                $gq->where('name', 'like', '%' . $request->search_nama . '%');
            });
        });
    }
    
    // 🔍 PENCARIAN TEKS LAPORAN
    if ($request->search_laporan) {
        $query->where('deskripsi_laporan', 'like', '%' . $request->search_laporan . '%');
    }

    // Untuk route guru.laporan.selesai
    if (request()->routeIs('guru.laporan.selesai')) {
        $query->where('status', 'selesai');
    }

    $aspirasis = $query->paginate(10);
    
    // Ambil data kategori untuk dropdown filter
    $kategoris = Kategori::all();

    return view('aspirasi.monitoring', compact('aspirasis', 'kategoris'));
}

    public function create()
    {
        $kategoris = Kategori::all();
        $ruangans = Ruangan::all();
        return view('siswa.create', compact('kategoris', 'ruangans'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'kategori_id'       => 'required',
            'ruangan_id'        => 'required',
            'deskripsi_laporan' => 'required',
            'foto'              => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $dataInput = [
            'kategori_id'       => $request->kategori_id,
            'ruangan_id'        => $request->ruangan_id,
            'deskripsi_laporan' => $request->deskripsi_laporan,
            'status'            => 'menunggu',
            'feedback_admin'    => null,
        ];

        $user = auth()->user();

        if ($user->role === 'siswa') { 
            $dataInput['siswa_id'] = $user->siswa->id;
            $dataInput['guru_id']  = null;
        } 
        elseif ($user->role === 'guru') { 
            $dataInput['guru_id']  = $user->guru->id; 
            $dataInput['siswa_id'] = null;
        }
        else {
            $dataInput['siswa_id'] = null;
            $dataInput['guru_id']  = null;
        }

        // ✅ BAGIAN SIMPAN FOTO - PALING SIMPEL DAN PASTI BERHASIL
if ($request->hasFile('foto')) {
    $file = $request->file('foto');
    $namaFile = time() . '_' . $file->getClientOriginalName();
    
    // Simpan ke public/aspirasi/ (biar rapi)
    $tujuan = public_path('aspirasi');
    
    // Buat folder jika belum ada
    if (!file_exists($tujuan)) {
        mkdir($tujuan, 0777, true);
    }
    
    $file->move($tujuan, $namaFile);
    
    // Simpan path ke database: aspirasi/nama_file.jpg
    $dataInput['foto'] = 'aspirasi/' . $namaFile; 
}
        
        Aspirasi::create($dataInput);
        return redirect()->route('aspirasi.history')->with('success', 'Laporan aspirasi berhasil dikirim!');
    }

    public function history()
    {
        $user = auth()->user();

        // ✅ Filter data sesuai akun yang login
        $aspirasis = Aspirasi::with(['kategori', 'ruangan', 'siswa', 'guru'])
                        ->when($user->role === 'siswa', function($q) use ($user){
                            return $q->where('siswa_id', $user->siswa->id);
                        })
                        ->when($user->role === 'guru', function($q) use ($user){
                            return $q->where('guru_id', $user->guru->id);
                        })
                        ->orderBy('created_at', 'DESC')
                        ->paginate(10);

        return view('aspirasi.history', compact('aspirasis'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status'         => 'required|in:menunggu,proses,selesai',
            'feedback_admin' => 'nullable|string',
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update([
            'status'         => $request->status,
            'feedback_admin' => $request->feedback_admin,
        ]);

        return redirect()->back()->with('success', 'Status dan tanggapan berhasil diperbarui!');
    }

    public function show($id)
    {
        $aspirasi = Aspirasi::with(['siswa', 'guru', 'kategori', 'ruangan'])->findOrFail($id);
        return view('aspirasi.detail', compact('aspirasi'));
    }
    public function hapus($id)
{
    $aspirasi = Aspirasi::findOrFail($id);

    // HAPUS FILE FOTO DARI PUBLIC/ASPIRASI/
    if($aspirasi->foto) {
        $pathFoto = public_path($aspirasi->foto); // langsung pakai path dari database
        if(file_exists($pathFoto)){
            unlink($pathFoto);
        }
    }

    $aspirasi->delete();
    return redirect()->route('aspirasi.monitoring')->with('success', '✅ Berhasil dihapus!');
}
}
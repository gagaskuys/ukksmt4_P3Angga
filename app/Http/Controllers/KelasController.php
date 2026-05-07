<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelass = Kelas::latest()->get();
        // PERBAIKAN: Arahkan ke folder kelas, bukan siswa
        return view('admin.kelas.index', compact('kelass'));
    }

    public function create()
    {
        // PERBAIKAN: Arahkan ke folder kelas
        return view('admin.kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
        ]);

        // PERBAIKAN: Gunakan 'admin.kelas.index' sesuai web.php kamu
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function edit(int $id) // Tambahkan 'int' agar warning $id hilang
    {
        $kelas = Kelas::findOrFail($id);
        // PERBAIKAN: Arahkan ke folder kelas dan samakan nama variabelnya
        return view('admin.kelas.update', compact('kelas'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
        ]);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}

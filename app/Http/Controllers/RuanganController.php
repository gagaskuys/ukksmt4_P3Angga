<?php

namespace App\Http\Controllers;

use App\Models\Ruangan; // WAJIB TAMBAHKAN INI
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Menampilkan daftar semua ruangan
     */
    public function index()
    {
        $ruangans = Ruangan::latest()->get();
        return view('admin.ruangan.index', compact('ruangans'));
    }

    /**
     * Menampilkan form tambah ruangan (jika dipisah halamannya)
     */
    public function create()
    {
        return view('admin.ruangan.create');
    }

    /**
     * Menyimpan data ruangan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_ruangan' => 'required|unique:ruangans,nama_ruangan',
        ]);

        Ruangan::create([
            'nama_ruangan' => $request->nama_ruangan
        ]);

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail ruangan (opsional)
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Menampilkan form edit ruangan
     */
    public function edit(string $id)
    {
        $ruangans = Ruangan::findOrFail($id);
        return view('admin.ruangan.update', compact('ruangans'));
    }

    /**
     * Memperbarui data ruangan
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_ruangan' => 'required|unique:ruangans,nama_ruangan,' . $id,
        ]);

        $ruangans = Ruangan::findOrFail($id);
        $ruangans->update([
            'nama_ruangan' => $request->nama_ruangan
        ]);

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil diperbarui!');
    }

    /**
     * Menghapus data ruangan
     */
    public function destroy(string $id)
    {
        $ruangans = Ruangan::findOrFail($id);
        $ruangans->delete();

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil dihapus!');
    }
}

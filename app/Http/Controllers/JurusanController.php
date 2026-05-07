<?php

namespace App\Http\Controllers;

use App\Models\Jurusan; // Gunakan ini agar kode lebih pendek
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::all();
        return view('admin.jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        return view('admin.jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
        ]);

        Jurusan::create([
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        // Sesuaikan nama rute dengan prefix 'admin.' dari web.php
        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    // Tambahkan 'int' di depan $id agar error Intelephense hilang
    public function edit(int $id)
    {
        $jurusans = Jurusan::findOrFail($id);
        return view('admin.jurusan.update', compact('jurusans')); // Pastikan nama variabelnya sesuai dengan yang dikirim ke view
    }

    // Tambahkan 'int' di depan $id
    public function update(Request $request, int $id)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
        ]);     

        $jurusans = Jurusan::findOrFail($id);
        $jurusans->update([
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil diperbarui.');
    }

    // Tambahkan 'int' di depan $id
    public function destroy(int $id)
    {
        $jurusans = Jurusan::findOrFail($id);
        $jurusans->delete();

        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil dihapus.');
    }
}

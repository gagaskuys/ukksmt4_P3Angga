<?php

namespace App\Http\Controllers;

use App\Models\Petugas; // Jangan lupa tambahkan pemanggilan Model Petugas
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::all();
        return view('admin.petugas.index', compact('petugas'));
        // return view('admin.petugas.index');
    }
    public function create()
    {
        return view('admin.petugas.create');
    }
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'name' => 'required',
            'nip' => 'required|unique:petugas,nip',
            'jabatan' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
        ]); 
        // Simpan data ke database
        Petugas::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
        ]);

        // Redirect ke halaman daftar petugas dengan pesan sukses
        return redirect()->route('admin.petugas.index')->with('success', 'Data petugas berhasil disimpan.');
}

    public function edit($id)
    {
        $petugas = Petugas::findOrFail($id);
        return view('admin.petugas.edit', compact('petugas'));
    }
    public function update(Request $request, $id)
    {
        // Validasi data yang masuk
        $request->validate([
            'nama_petugas' => 'required',
            'email' => 'required|email|unique:petugas,email,' . $id,
        ]);

        $petugas = Petugas::findOrFail($id);
        $petugas->update([
            'name' => $request->name,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.petugas.index')->with('success', 'Data petugas berhasil diperbarui.');
}
    public function destroy($id)
    {
        $petugas = Petugas::findOrFail($id);
        $petugas->delete();

        return redirect()->route('admin.petugas.index')->with('success', 'Data petugas berhasil dihapus.');
    }
}
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
            'nama_petugas' => 'required',
            'email' => 'required|email|unique:petugas,email',
            'password' => 'required|min:6',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]); 
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
            'nama_petugas' => $request->nama_petugas,
            'email' => $request->email,
            // Jika password diisi, update passwordnya
            'password' => $request->password ? bcrypt($request->password) : $petugas->password,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
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
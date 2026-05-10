<?php

namespace App\Http\Controllers;

use App\Models\Kepsek; // Jangan lupa tambahkan pemanggilan Model Kepsek
use Illuminate\Http\Request;

class KepsekController extends Controller
{
    public function index()
    {
        $kepseks = Kepsek::all();
        return view('admin.kepsek.index', compact('kepseks'));
        //return view('admin.kepsek.index');
    }
    public function create()
    {
        return view('admin.kepsek.create');
    }
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'nama_kepsek' => 'required',
            'email' => 'required|email|unique:kepseks,email',
            'password' => 'required|min:6',
        ]);

        // Simpan data ke database
        Kepsek::create([
            'nama_kepsek' => $request->nama_kepsek,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Enkripsi password
        ]);

        // Redirect ke halaman daftar kepsek dengan pesan sukses
        return redirect()->route('admin.kepsek.index')->with('success', 'Data kepala sekolah berhasil disimpan.');
    }

    public function edit($id)
    {
        $kepseks = Kepsek::findOrFail($id);
        return view('admin.kepsek.edit', compact('kepseks'));
    }
    public function update(Request $request, $id)
    {
        // Validasi data yang masuk
        $request->validate([
            'nama_kepsek' => 'required',
            'email' => 'required|email|unique:kepseks,email,' . $id,
        ]);

        $kepseks = Kepsek::findOrFail($id);
        $kepseks->update([
            'nama_kepsek' => $request->nama_kepsek,
            'email' => $request->email,
            // Jika password diisi, update passwordnya
            'password' => $request->password ? bcrypt($request->password) : $kepseks->password,
        ]);

        return redirect()->route('admin.kepsek.index')->with('success', 'Data kepala sekolah berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $kepseks = Kepsek::findOrFail($id);
        $kepseks->delete();

        return redirect()->route('admin.kepsek.index')->with('success', 'Data kepala sekolah berhasil dihapus.');
        // return redirect()->route('kepsek.dashboard')->with('success', 'Data kepala sekolah berhasil dihapus.'); --- IGNORE --- 
    }
}
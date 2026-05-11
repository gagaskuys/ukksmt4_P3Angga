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
            'name' => 'required',
            'nip' => 'required|unique:kepseks,nip',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
        ]);

        // Simpan data ke database
        Kepsek::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
        ]);

        // Redirect ke halaman daftar kepsek dengan pesan sukses
        return redirect()->route('admin.kepsek.index')->with('success', 'Data kepala sekolah berhasil disimpan.');
    }

    public function edit($id)
    {
        $kepseks = Kepsek::findOrFail($id);
        return view('admin.kepsek.update', compact('kepseks'));
    }
    public function update(Request $request, $id)
    {
        // Validasi data yang masuk
        $request->validate([
            'name' => 'required',
            'nip' => 'required|unique:kepseks,nip,' . $id,
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
        ]);

        $kepseks = Kepsek::findOrFail($id);
        $kepseks->update([
            'name' => $request->name,
            'nip' => $request->nip,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
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
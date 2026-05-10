<?php

namespace App\Http\Controllers;

use App\Models\Guru; // Jangan lupa tambahkan pemanggilan Model Guru
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        // Ambil semua data guru dari tabel
        $gurus = Guru::latest()->get();

        // Kirim variabel $gurus ke tampilan
        return view('admin.guru.index', compact('gurus'));
    }
    public function create()
    {
        return view('admin.guru.create');
    }
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'nama_guru' => 'required',
            'nip' => 'required|unique:gurus,nip',
            'email' => 'required|email|unique:gurus,email',
            'password' => 'required|min:6',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        // Simpan data ke database
        Guru::create([
            'nama_guru' => $request->nama_guru,
            'nip' => $request->nip,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Enkripsi password
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        // Redirect ke halaman daftar guru        return redirect()->route('guru.dashboard')->with('success', 'Data guru berhasil disimpan.');
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil disimpan.');

    }

    public function edit($id)
    {
        $gurus = Guru::findOrFail($id);
        return view('admin.guru.edit', compact('gurus'));
    }
    public function update(Request $request, $id)
    {
        // Validasi data yang masuk
        $request->validate([
            'nama_guru' => 'required',
            'nip' => 'required|unique:gurus,nip,' . $id,
            'email' => 'required|email|unique:gurus,email,' . $id,
            'password' => 'nullable|min:6',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        // Temukan guru berdasarkan ID
        $gurus = Guru::findOrFail($id);

        // Update data guru
        $gurus->nama_guru = $request->nama_guru;
        $gurus->nip = $request->nip;
        $gurus->email = $request->email;
        if ($request->password) {
            $gurus->password = bcrypt($request->password); // Enkripsi password jika diubah
        }
        $gurus->no_hp = $request->no_hp;
        $gurus->alamat = $request->alamat;
        $gurus->save();

        // Redirect ke halaman daftar guru dengan pesan sukses
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $gurus = Guru::findOrFail($id);
        $gurus->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus.');
    }

}
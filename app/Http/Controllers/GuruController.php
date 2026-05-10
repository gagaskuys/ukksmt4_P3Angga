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
        return view('guru.dashboard.index', compact('gurus'));
    }
    public function create()
    {
        return view('guru.create');
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
        return redirect()->route('guru.dashboard')->with('success', 'Data guru berhasil disimpan.');

    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.edit', compact('guru'));
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
        $guru = Guru::findOrFail($id);

        // Update data guru
        $guru->nama_guru = $request->nama_guru;
        $guru->nip = $request->nip;
        $guru->email = $request->email;
        if ($request->password) {
            $guru->password = bcrypt($request->password); // Enkripsi password jika diubah
        }
        $guru->no_hp = $request->no_hp;
        $guru->alamat = $request->alamat;
        $guru->save();

        // Redirect ke halaman daftar guru dengan pesan sukses
        return redirect()->route('guru.dashboard')->with('success', 'Data guru berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();

        return redirect()->route('guru.dashboard')->with('success', 'Data guru berhasil dihapus.');
    }

}
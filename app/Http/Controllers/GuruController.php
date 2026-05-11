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
            'nip' => 'required|unique:gurus,nip',
            'name' => 'required',
            'mata_pelajaran' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'no_telepon' => 'required',
        ]);

        // Simpan data ke database
        Guru::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'mata_pelajaran' => $request->mata_pelajaran,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
        ]);

        // Redirect ke halaman daftar guru        return redirect()->route('guru.dashboard')->with('success', 'Data guru berhasil disimpan.');
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil disimpan.');

    }

    public function edit($id)
    {
        $gurus = Guru::findOrFail($id);
        return view('admin.guru.update', compact('gurus'));
    }
    public function update(Request $request, $id)
    {
        // Validasi data yang masuk
        $request->validate([
            'name' => 'required',
            'nip' => 'required|unique:gurus,nip,' . $id,
            'mata_pelajaran' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
            'no_telepon' => 'required',
            'alamat' => 'required',
        ]);

        // Temukan guru berdasarkan ID
        $gurus = Guru::findOrFail($id);

        // Update data guru
        $gurus->name = $request->name;
        $gurus->nip = $request->nip;
        $gurus->mata_pelajaran = $request->mata_pelajaran;
        $gurus->jenis_kelamin = $request->jenis_kelamin;
        $gurus->tanggal_lahir = $request->tanggal_lahir;
        $gurus->no_telepon = $request->no_telepon;
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
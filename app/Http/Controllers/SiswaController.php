<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    // 1. Menampilkan daftar semua siswa dari tabel siswas
    public function index()
    {
        // Mengambil data dari tabel siswas (bukan users) agar data identitas muncul
        $siswas = Siswa::latest()->get();
        return view('admin.siswa.index', compact('siswas'));
    }

    // 2. Menampilkan halaman tambah siswa baru
    public function create()
    {
        return view('admin.siswa.create');
    }

    // 3. Menyimpan data ke tabel users dan tabel siswas
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Gunakan DB Transaction agar jika satu gagal, semua dibatalkan
        DB::transaction(function () use ($request) {
            // Simpan ke tabel users (untuk akun login)
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'siswa',
            ]);

            // Simpan ke tabel siswas (untuk identitas siswa)
            Siswa::create([
                'user_id' => $user->id,
                'name' => $request->nama,
                'nis' => $request->nis ?? '-', // Tambahkan NIS jika ada di form
            ]);
        });

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    // 4. Menampilkan halaman ubah data
    public function edit(string $id)
    {
        // Cari di tabel siswas
        $siswa = Siswa::findOrFail($id);
        return view('admin.siswa.edit', compact('siswa'));
    }

    // 5. Memperbarui data di kedua tabel
    public function update(Request $request, string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $user = User::findOrFail($siswa->user_id);

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        DB::transaction(function () use ($request, $siswa, $user) {
            // Update tabel users
            $userData = [
                'name' => $request->nama,
                'email' => $request->email,
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }
            $user->update($userData);

            // Update tabel siswas
            $siswa->update([
                'name' => $request->nama,
                'nis' => $request->nis ?? $siswa->nis,
            ]);
        });

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    // 6. Menghapus data dari kedua tabel
    public function destroy(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        
        DB::transaction(function () use ($siswa) {
            // Hapus akun di tabel users dulu
            User::where('id', $siswa->user_id)->delete();
            // Hapus data di tabel siswas
            $siswa->delete();
        });

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}

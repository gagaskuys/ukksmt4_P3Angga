<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Jurusan;
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
        $kelass = Kelas::all(); // Ambil data kelas untuk dropdown
        $jurusans = Jurusan::all(); // Ambil data jurusan untuk dropdown

        return view('admin.siswa.create', compact('kelass', 'jurusans'));
    }

    // 3. Menyimpan data ke tabel users dan tabel siswas
    public function store(Request $request)
{
    // 1. Validasi semua data yang diwajibkan di migrasi
    $request->validate([
        'nama' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'nis' => 'required|unique:siswas,nis',
        'kelas_id' => 'required',
        'jurusan_id' => 'required',
        'jenis_kelamin' => 'required',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required',
        'no_telepon' => 'required',
    ]);

    DB::transaction(function () use ($request) {
        // 2. Simpan ke tabel users (untuk akun login)
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        // 3. Simpan ke tabel siswas (Lengkapi semua field migrasi)
        Siswa::create([
            'user_id' => $user->id,
            'name' => $request->nama,
            'nis' => $request->nis,
            'kelas_id' => $request->kelas_id,
            'jurusan_id' => $request->jurusan_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Sesuai migrasimu
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    });

    return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
}

    // 4. Menampilkan halaman ubah data
    public function edit(string $id)
    {
        // Cari di tabel siswas
        $siswa = Siswa::findOrFail($id);
        $kelass = Kelas::all(); // Ambil data kelas untuk dropdown
        $jurusans = Jurusan::all(); // Ambil data jurusan untuk dropdown
        return view('admin.siswa.update', compact('siswa', 'kelass', 'jurusans'));
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

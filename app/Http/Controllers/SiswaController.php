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
        'name' => 'required',
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
try {
            // 2. Simpan ke tabel users (untuk akun login)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // <-- HAPUS Hash::make di sini
            'role' => 'siswa',
        ]);

        // 3. Simpan ke tabel siswas
        Siswa::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'nis' => $request->nis,
            'kelas_id' => $request->kelas_id,
            'jurusan_id' => $request->jurusan_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'password' => $request->password, // <-- HAPUS juga Hash::make di sini jika kolom password di tabel siswas ingin disamakan
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
        ]);

    } catch (\Exception $e) {

    dd($e->getMessage());

}

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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        DB::transaction(function () use ($request, $siswa, $user) {
            // Update tabel users
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }
            $user->update($userData);

            // Update tabel siswas
            $siswa->update([
                'name' => $request->name,
                'nis' => $request->nis ?? $siswa->nis,
                'created_at' => $request->created_at,
                'updated_at' => $request->updated_at,   
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

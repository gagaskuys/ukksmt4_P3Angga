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
        $siswas = Siswa::latest()->get();
        return view('admin.siswa.index', compact('siswas'));
    }

    // 2. Menampilkan halaman tambah siswa baru
    public function create()
    {
        $kelass = Kelas::all(); 
        $jurusans = Jurusan::all(); 
        return view('admin.siswa.create', compact('kelass', 'jurusans'));
    }

    // 3. Menyimpan data ke tabel users dan tabel siswas
    public function store(Request $request)
    {
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
            DB::transaction(function () use ($request) {
                // ✅ PERBAIKAN 1: PASSWORD WAJIB DI-ENCRYPT / DI-ACAK
                // Kalau tidak pakai Hash::make, password tersimpan teks biasa, gak bakal bisa login!
                $user = User::create([
                    'name'     => $request->name,
                    'email'    => $request->email,
                    'password' => Hash::make($request->password), // ✅ WAJIB PAKAI Hash::make()
                    'role'     => 'siswa',
                ]);

                // ✅ PERBAIKAN 2: SIMPAN user_id DENGAN BENAR
                // Ini kuncinya! $user->id adalah ID yang baru saja dibuat di tabel users
                Siswa::create([
                    'user_id'      => $user->id, // ✅ INI YANG DICARI SISTEM, DULU SUDAH BENAR TAPI KITA PASTIKAN LAGI
                    'name'         => $request->name,
                    'nis'          => $request->nis,
                    'kelas_id'     => $request->kelas_id,
                    'jurusan_id'   => $request->jurusan_id,
                    'jenis_kelamin'=> $request->jenis_kelamin,
                    'email'        => $request->email,
                    'tanggal_lahir'=> $request->tanggal_lahir,
                    'alamat'       => $request->alamat,
                    'no_telepon'   => $request->no_telepon,
                    // ❌ JANGAN SIMPAN PASSWORD DI TABEL SISWAS, itu tidak perlu dan berisiko
                ]);
            });

        } catch (\Exception $e) {
            dd('Error: ' . $e->getMessage());
        }

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    // 4. Menampilkan halaman ubah data
    public function edit(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $kelass = Kelas::all(); 
        $jurusans = Jurusan::all(); 
        return view('admin.siswa.update', compact('siswa', 'kelass', 'jurusans'));
    }

    // 5. Memperbarui data di kedua tabel
    public function update(Request $request, string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $user = User::findOrFail($siswa->user_id);

        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        DB::transaction(function () use ($request, $siswa, $user) {
            // Update tabel users
            $userData = [
                'name'  => $request->name,
                'email' => $request->email,
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }
            $user->update($userData);

            // ✅ PERBAIKAN 3: PERBAIKI BAGIAN UPDATE
            // Dulu kamu cuma update sedikit kolom, sekarang kita lengkapi biar sinkron
            $siswa->update([
                'name'          => $request->name,
                'nis'           => $request->nis ?? $siswa->nis,
                'kelas_id'      => $request->kelas_id ?? $siswa->kelas_id,
                'jurusan_id'    => $request->jurusan_id ?? $siswa->jurusan_id,
                'jenis_kelamin' => $request->jenis_kelamin ?? $siswa->jenis_kelamin,
                'email'         => $request->email,
                'tanggal_lahir' => $request->tanggal_lahir ?? $siswa->tanggal_lahir,
                'alamat'        => $request->alamat ?? $siswa->alamat,
                'no_telepon'    => $request->no_telepon ?? $siswa->no_telepon,
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
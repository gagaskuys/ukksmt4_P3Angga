<?php

namespace App\Http\Controllers;

use App\Models\Guru; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::latest()->get();
        return view('admin.guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

        public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:gurus,nip',
            'name' => 'required', 
            'email' => 'required|email|unique:users,email', 
            'password' => 'required|min:6', 
            'mata_pelajaran' => 'required', 
            'jenis_kelamin' => 'required', 
            'tanggal_lahir' => 'required|date', 
            'alamat' => 'required', 
            'no_telepon' => 'required', 
        ]);

        // Melakukan penyimpanan ganda secara aman
        DB::transaction(function () use ($request) {
            // 1. WAJIB: Buat User Login Terlebih Dahulu
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Password di-hash agar bisa login
                'role' => 'guru',
            ]);

            // 2. Buat Data Profil Guru
            Guru::create([ 
                'user_id' => $user->id, // Menghubungkan ID akun ke profil guru
                'name' => $request->name, 
                'nip' => $request->nip, 
                'mata_pelajaran' => $request->mata_pelajaran, 
                'jenis_kelamin' => $request->jenis_kelamin, 
                'tanggal_lahir' => $request->tanggal_lahir, 
                'alamat' => $request->alamat, 
                'no_telepon' => $request->no_telepon, 
            ]);
        });

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil disimpan.');
    }

    public function edit($id)
    {
        // Menggunakan where('id', $id) agar dipaksa mencari kolom 'id' di database phpMyAdmin
        $gurus = Guru::where('id', $id)->firstOrFail();
        
        return view('admin.guru.update', compact('gurus'));
    }

                public function update(Request $request, $id)
    {
        // 1. Ambil data guru secara manual menggunakan kolom 'id'
        $guru = Guru::where('id', $id)->firstOrFail();

        // 2. Validasi data yang masuk dengan aman
        $request->validate([
            'name' => 'required',
            // MEMAKSA Laravel mencari keunikan NIP berdasarkan kolom 'id' secara manual
            'nip' => [
                'required',
                \Illuminate\Validation\Rule::unique('gurus', 'nip')->ignore($id, 'id')
            ],
            'mata_pelajaran' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
            'no_telepon' => 'required',
            'alamat' => 'required',
            'email' => [
                'required',
                'email',
                \Illuminate\Validation\Rule::unique('users', 'email')->ignore($guru->user_id, 'id')
            ],
            'password' => 'nullable|min:6', 
        ]);

        // 3. Simpan perubahan ke database menggunakan transaksi
        DB::transaction(function () use ($request, $guru) {
            // Update akun login di tabel users
            $user = User::findOrFail($guru->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // Update data di tabel gurus
            $guru->name = $request->name;
            $guru->nip = $request->nip;
            $guru->mata_pelajaran = $request->mata_pelajaran;
            $guru->jenis_kelamin = $request->jenis_kelamin;
            $guru->tanggal_lahir = $request->tanggal_lahir;
            $guru->no_telepon = $request->no_telepon;
            $guru->alamat = $request->alamat;
            $guru->save();
        });

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }



    public function destroy($id)
    {
        $gurus = Guru::where('id', $id)->firstOrFail();
            // Hapus data guru dan akun user terkait dalam satu transaksi
        $gurus->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
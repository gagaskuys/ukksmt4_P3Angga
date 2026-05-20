<?php

namespace App\Http\Controllers;

use App\Models\Guru; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 
use Illuminate\Validation\Rule; // ✅ Saya rapikan baris ini biar rapi

class GuruController extends Controller
{
    public function index()
    {
        // ✅ Ditambahkan: ambil data user biar nama/email langsung terbaca
        $gurus = Guru::with('user')->latest()->get();
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

        DB::transaction(function () use ($request) {
            // 1. Buat Akun Login
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'guru', // ✅ Role otomatis 'guru'
            ]);

            // 2. Buat Profil Guru
            Guru::create([ 
                'user_id'        => $user->id, // Hubungkan ke akun
                'name'           => $request->name, 
                'nip'            => $request->nip, 
                'mata_pelajaran' => $request->mata_pelajaran, 
                'jenis_kelamin'  => $request->jenis_kelamin, 
                'tanggal_lahir'  => $request->tanggal_lahir, 
                'alamat'         => $request->alamat, 
                'no_telepon'     => $request->no_telepon, 
            ]);
        });

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil disimpan.');
    }

    public function edit($id)
    {
        $guru = Guru::where('id', $id)->firstOrFail(); // ✅ Diubah nama variabel jadi $guru (lebih pas)
        return view('admin.guru.update', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::where('id', $id)->firstOrFail();

        $request->validate([
            'name' => 'required',
            'nip' => [
                'required',
                Rule::unique('gurus', 'nip')->ignore($id, 'id')
            ],
            'mata_pelajaran' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
            'no_telepon' => 'required',
            'alamat' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($guru->user_id, 'id')
            ],
            'password' => 'nullable|min:6', 
        ]);

        DB::transaction(function () use ($request, $guru) {
            // Update akun User
            $user = User::findOrFail($guru->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // Update data Guru
            $guru->name           = $request->name;
            $guru->nip            = $request->nip;
            $guru->mata_pelajaran = $request->mata_pelajaran;
            $guru->jenis_kelamin  = $request->jenis_kelamin;
            $guru->tanggal_lahir  = $request->tanggal_lahir;
            $guru->no_telepon     = $request->no_telepon;
            $guru->alamat         = $request->alamat;
            $guru->save();
        });

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // ✅ PERBAIKAN UTAMA:
        // Dulu cuma hapus tabel guru, sekarang sekalian hapus akun loginnya biar bersih
        $guru = Guru::where('id', $id)->firstOrFail();

        DB::transaction(function () use ($guru) {
            // 1. Hapus akun user di tabel users
            User::where('id', $guru->user_id)->delete();
            
            // 2. Hapus data profil guru
            $guru->delete();
        });

        return redirect()->route('admin.guru.index')->with('success', 'Data guru & akun login berhasil dihapus.');
    }
}
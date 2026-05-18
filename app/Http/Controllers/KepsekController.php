<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Kepsek;
use App\Models\User;

class KepsekController extends Controller
{
    public function index()
    {
        // Disamakan dengan Guru: Mengambil data master kepala sekolah terbaru beserta akun loginnya
        $kepseks = Kepsek::with('user')->latest()->get();
        return view('admin.kepsek.index', compact('kepseks'));
    }

    public function create()
    {
        return view('admin.kepsek.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:kepseks,nip',
            'name' => 'required', 
            'email' => 'required|email|unique:users,email', 
            'password' => 'required|min:6', 
            'jenis_kelamin' => 'required', 
            'no_hp' => 'required', 
        ]);

        // Melakukan penyimpanan ganda secara aman (Sama persis dengan gaya Guru)
        DB::transaction(function () use ($request) {
            // 1. Buat User Login Terlebih Dahulu
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Menggunakan Hash::make manual sesuai Guru
                'role' => 'kepsek',
            ]);

            // 2. Buat Data Profil Kepala Sekolah
            Kepsek::create([ 
                'user_id' => $user->id, // Menghubungkan ID akun ke profil kepsek
                'name' => $request->name, 
                'nip' => $request->nip, 
                'jenis_kelamin' => $request->jenis_kelamin, 
                'no_hp' => $request->no_hp, 
            ]);
        });

        return redirect()->route('admin.kepsek.index')->with('success', 'Data kepala sekolah berhasil disimpan.');
    }

    public function edit($id)
    {
        // Disamakan dengan Guru: Dipaksa menggunakan where('id', $id) dan mengarah ke view 'update'
        $kepsek = Kepsek::where('id', $id)->firstOrFail();
        return view('admin.kepsek.update', compact('kepsek'));
    }

    public function update(Request $request, $id)
{
    // 1. Ambil data kepala sekolah berdasarkan ID
    $kepsek = Kepsek::where('id', $id)->firstOrFail();

    // 2. Validasi data input form
    $request->validate([
        'name'          => 'required',
        'nip'           => ['required', \Illuminate\Validation\Rule::unique('kepseks', 'nip')->ignore($id, 'id')],
        'jenis_kelamin' => 'required',
        'no_hp'         => 'required',
        'email'         => ['required', 'email', \Illuminate\Validation\Rule::unique('users', 'email')->ignore($kepsek->user_id, 'id')],
        'password'      => 'nullable|min:6', 
    ]);

    // 3. Proses simpan menggunakan Database Transaction (Aman & Sinkron)
    DB::transaction(function () use ($request, $kepsek) {
        // A. Update data di tabel users
        $user = User::findOrFail($kepsek->user_id);
        $user->name  = $request->name;
        $user->email = $request->email;
        
        // Hanya update password jika kolom password diisi oleh admin
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // B. Update data di tabel kepseks
        $kepsek->name          = $request->name;
        $kepsek->nip           = $request->nip;
        $kepsek->jenis_kelamin = $request->jenis_kelamin;
        $kepsek->no_hp         = $request->no_hp;
        $kepsek->save();
    });

    // 4. Kembali ke halaman utama dengan pesan sukses
    return redirect()->route('admin.kepsek.index')->with('success', 'Data kepala sekolah berhasil diperbarui.');
}

    public function destroy($id)
    {
        // Disamakan dengan Guru: Pencarian ID manual dan transaksi hapus bersambung
        $kepsek = Kepsek::where('id', $id)->firstOrFail();
        
        DB::transaction(function () use ($kepsek) {
            // Hapus akun login di tabel users terlebih dahulu
            User::where('id', $kepsek->user_id)->delete();
            // Hapus profil kepala sekolah
            $kepsek->delete();
        });

        return redirect()->route('admin.kepsek.index')->with('success', 'Data kepala sekolah berhasil dihapus.');
    }
}

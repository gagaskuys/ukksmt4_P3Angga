<?php

namespace App\Http\Controllers;

use App\Models\Petugas; 
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PetugasController extends Controller
{
    public function index()
    {
        // Disamakan dengan Guru: Mengambil data petugas terbaru beserta akun loginnya
        $petugas = Petugas::with('user')->latest()->get();
        return view('admin.petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip'           => 'required|unique:petugas,nip',
            'name'          => 'required', 
            'email'         => 'required|email|unique:users,email', 
            'password'      => 'required|min:6', 
            'jabatan'       => 'required', 
            'jenis_kelamin' => 'required', 
            'no_hp'         => 'required', 
        ]);

        // Melakukan penyimpanan ganda secara aman (Sama persis dengan gaya Guru)
        DB::transaction(function () use ($request) {
            // 1. Buat Akun Login Terlebih Dahulu di tabel users
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password), // Password di-hash manual sesuai Guru
                'role'     => 'petugas',
            ]);

            // 2. Buat Data Profil Petugas
            Petugas::create([ 
                'user_id'       => $user->id, // Menghubungkan ID akun ke profil petugas
                'name'          => $request->name, 
                'nip'           => $request->nip, 
                'jabatan'       => $request->jabatan, 
                'jenis_kelamin' => $request->jenis_kelamin, 
                'no_hp'         => $request->no_hp, 
            ]);
        });

        return redirect()->route('admin.petugas.index')->with('success', 'Data petugas berhasil disimpan.');
    }

    public function edit($id)
    {
        // Disamakan dengan Guru: Menggunakan query manual 'where' dan mengarah ke view 'update'
        $petugas = Petugas::where('id', $id)->firstOrFail();
        return view('admin.petugas.update', compact('petugas'));
    }

    public function update(Request $request, $id)
    {
        // 1. Ambil data secara manual menggunakan kolom 'id'
        $petugas = Petugas::where('id', $id)->firstOrFail();

        // 2. Validasi data yang masuk dengan aman
        $request->validate([
            'name'          => 'required',
            'nip'           => [
                'required',
                Rule::unique('petugas', 'nip')->ignore($id, 'id')
            ],
            'jabatan'       => 'required',
            'jenis_kelamin' => 'required',
            'no_hp'         => 'required',
            'email'         => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($petugas->user_id, 'id')
            ],
            'password'      => 'nullable|min:6', 
        ]);

        // 3. Simpan perubahan ke database menggunakan transaksi (Sama persis gaya Guru)
        DB::transaction(function () use ($request, $petugas) {
            // Update akun login di tabel users
            $user = User::findOrFail($petugas->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // Update data di tabel petugas
            $petugas->name          = $request->name;
            $petugas->nip           = $request->nip;
            $petugas->jabatan       = $request->jabatan;
            $petugas->jenis_kelamin = $request->jenis_kelamin;
            $petugas->no_hp         = $request->no_hp;
            $petugas->save();
        });

        return redirect()->route('admin.petugas.index')->with('success', 'Data petugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Disamakan dengan Guru: Pencarian ID manual dan transaksi hapus bersambung (cascade)
        $petugas = Petugas::where('id', $id)->firstOrFail();
        
        DB::transaction(function () use ($petugas) {
            // Hapus akun login di tabel users terlebih dahulu
            User::where('id', $petugas->user_id)->delete();
            // Hapus data profil petugas
            $petugas->delete();
        });

        return redirect()->route('admin.petugas.index')->with('success', 'Data petugas berhasil dihapus.');
    }
}

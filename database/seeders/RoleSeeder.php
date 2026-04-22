<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // TAMBAHKAN INI
use Spatie\Permission\Models\Role; // TAMBAHKAN INI
use Illuminate\Support\Facades\Hash; // TAMBAHKAN INI

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Role (Gunakan firstOrCreate agar tidak error jika dijalankan ulang)
        $admin  = Role::firstOrCreate(['name' => 'admin']);
        $guru   = Role::firstOrCreate(['name' => 'guru']);
        $siswa  = Role::firstOrCreate(['name' => 'siswa']);
        $petugas = Role::firstOrCreate(['name' => 'petugas']);
        $kepsek = Role::firstOrCreate(['name' => 'kepsek']);

        // 2. Buat/Cari User Admin (Gunakan updateOrCreate agar data selalu ada)
        $userAdmin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Cari berdasarkan email
            [
                'name' => 'Administrator',
                'password' => Hash::make('123456'), // Password default dari tabelmu
            ]
        );

        // 3. Pasangkan Role ke User
        $userAdmin->assignRole($admin);

        // Lakukan hal yang sama untuk user lain (opsional tapi bagus untuk testing)
        $userSiswa = User::updateOrCreate(
            ['email' => 'siswa@gmail.com'],
            ['name' => 'Siswa Contoh', 'password' => Hash::make('123456')]
        );
        $userSiswa->assignRole($siswa);
    }
}

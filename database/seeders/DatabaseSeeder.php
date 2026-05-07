<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run(): void
{
    // 1. Panggil RolePermissionSeeder (tempat kamu buat role admin, guru, dll)
    $this->call([
        RolePermissionSeeder::class,
    ]);

    // 2. Baru buat user dan assign role-nya
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('123456'),
        'role' => 'admin',
    ]);
    $admin->assignRole('admin');

    $guru = User::create([
        'name' => 'Guru User',
        'email' => 'guru@gmail.com',
        'password' => bcrypt('123456'),
        'role' => 'guru',
    ]);
    $guru->assignRole('guru');

    // Tambahkan user petugas dan kepsek di bawah sini dengan cara yang sama...

    $siswa = User::create([
        'name' => 'Siswa User',
        'email' => 'siswa@gmail.com',
        'password' => bcrypt('123456'),
        'role' => 'siswa',
    ]);
    $siswa->assignRole('siswa');

    $kepsek = User::create([
        'name' => 'Kepsek User',
        'email' => 'kepsek@gmail.com',
        'password' => bcrypt('123456'),
        'role' => 'kepsek',
    ]);
    $kepsek->assignRole('kepsek');

    // 3. Panggil seeder lainnya jika perlu, misal JurusanSeeder, KelasSeeder, dll
    // $this->call([
    //     JurusanSeeder::class,
    //     KelasSeeder::class,
    // ]);
}

}

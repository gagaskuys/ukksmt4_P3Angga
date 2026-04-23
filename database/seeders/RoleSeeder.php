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
    // 1. Pastikan semua Role ada
    $roles = ['admin', 'guru', 'siswa', 'petugas', 'kepsek'];
    foreach ($roles as $role) {
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => $role]);
    }

    // 2. Data Akun Demo
    $users = [
        ['name' => 'Admin User', 'email' => 'admin@gmail.com', 'role' => 'admin'],
        ['name' => 'Guru User', 'email' => 'guru@gmail.com', 'role' => 'guru'],
        ['name' => 'Petugas User', 'email' => 'petugas@gmail.com', 'role' => 'petugas'],
        ['name' => 'Kepsek User', 'email' => 'kepsek@gmail.com', 'role' => 'kepsek'],
        ['name' => 'Siswa User', 'email' => 'siswa@gmail.com', 'role' => 'siswa'],
    ];

    foreach ($users as $u) {
        $user = \App\Models\User::updateOrCreate(
            ['email' => $u['email']],
            [
                'name' => $u['name'],
                'password' => bcrypt('123456'), // Password semua disamakan
            ]
        );
        $user->syncRoles($u['role']); // Memberikan role sesuai data
    }
}

}

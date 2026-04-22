<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Role sesuai tabelmu
        $roles = ['admin', 'guru', 'siswa', 'petugas', 'kepsek'];
        
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // 2. Buat Akun Demo & Assign Role (Sesuai gambar tabel "Akun Demo")
        $users = [
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'role' => 'admin'
            ],
            [
                'name' => 'Ibu Guru',
                'email' => 'guru@gmail.com',
                'role' => 'guru'
            ],
            [
                'name' => 'Petugas Sarpras',
                'email' => 'petugas@gmail.com',
                'role' => 'petugas'
            ],
            [
                'name' => 'Siswa Aktif',
                'email' => 'siswa@gmail.com',
                'role' => 'siswa'
            ],
            [
                'name' => 'Kepala Sekolah',
                'email' => 'kepsek@gmail.com',
                'role' => 'kepsek'
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('123456'), // Password default dari tabelmu
                ]
            );
            $user->assignRole($userData['role']);
        }
    }
}

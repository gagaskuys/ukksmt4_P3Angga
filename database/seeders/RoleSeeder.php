<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // =========================
        // 1. Buat Role
        // =========================
        $roles = ['admin', 'guru', 'siswa', 'petugas', 'kepsek'];

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role
            ]);
        }

        // =========================
        // 2. Data User Demo
        // =========================
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
            ],
            [
                'name' => 'Guru User',
                'email' => 'guru@gmail.com',
                'role' => 'guru',
            ],
            [
                'name' => 'Petugas User',
                'email' => 'petugas@gmail.com',
                'role' => 'petugas',
            ],
            [
                'name' => 'Kepsek User',
                'email' => 'kepsek@gmail.com',
                'role' => 'kepsek',
            ],
            [
                'name' => 'Siswa User',
                'email' => 'siswa@gmail.com',
                'role' => 'siswa',
            ],
        ];

        // =========================
        // 3. Buat User + Assign Role
        // =========================
        foreach ($users as $u) {

            $user = User::updateOrCreate(
                ['email' => $u['email']],
                [
                    'name' => $u['name'],
                    'password' => Hash::make('123456'),
                    'role' => $u['role'], // kolom role di tabel users
                ]
            );

            // assign role spatie
            $user->syncRoles([$u['role']]);
        }
    }
}
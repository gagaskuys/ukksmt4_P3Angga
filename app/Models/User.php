<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ✅ SUDAH BENAR: Relasi cari data guru lewat user_id
    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'user_id', 'id');
    }

    public function guru()
    {
        return $this->hasOne(Guru::class, 'user_id', 'id');
    }

    public function kepsek()
    {
        return $this->hasOne(Kepsek::class, 'user_id', 'id');
    }

    public function petugas()
    {
        return $this->hasOne(Petugas::class, 'user_id', 'id');
    }
}
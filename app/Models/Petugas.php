<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'id'; // Sesuaikan dengan nama primary key di tabel petugas
    protected $fillable = [
        'user_id',
        'name',
        'nip',
        'email',
        'password',
        'jabatan',
        'jenis_kelamin',
        'no_hp',
    ];
    public $timestamps = true; // Tetap aktifkan timestamps agar bisa diisi manual
    public function getKeyName()
    {
        return 'id';
    }
    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

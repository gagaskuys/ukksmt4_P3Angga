<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kepsek extends Model
{
    protected $table = 'kepseks';
        protected $primaryKey = 'id'; // Sesuaikan dengan nama primary key di tabel kepseks
    protected $fillable = [
        'user_id',
        'name',
        'nip',
        'jenis_kelamin',
        'no_hp',
        'email',
        'password',
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

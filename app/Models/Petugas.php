<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $fillable = [
        'name',
        'nip',
        'jabatan',
        'jenis_kelamin',
        'no_hp',
    ];
    public $timestamps = true; // Tetap aktifkan timestamps agar bisa diisi manual
}

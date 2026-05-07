<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $fillable = [
        'nama_petugas',
        'email',
        'password',
    ];
    public $timestamps = true; // Tetap aktifkan timestamps agar bisa diisi manual
}

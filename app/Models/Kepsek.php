<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kepsek extends Model
{
    protected $table = 'kepseks';
    protected $fillable = [
        'nama_kepsek',
        'email',
        'password',
    ];

    public $timestamps = true; // Tetap aktifkan timestamps agar bisa diisi manual
}

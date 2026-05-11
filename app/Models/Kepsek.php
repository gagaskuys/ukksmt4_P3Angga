<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kepsek extends Model
{
    protected $table = 'kepseks';
    protected $fillable = [
        'name',
        'nip',
        'jenis_kelamin',
        'no_hp',
    ];

    public $timestamps = true; // Tetap aktifkan timestamps agar bisa diisi manual
}

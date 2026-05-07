<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusans';

    protected $fillable = [
        'nama_jurusan',
    ];
    public $timestamps = true; // Tetap aktifkan timestamps agar bisa diisi manual
}

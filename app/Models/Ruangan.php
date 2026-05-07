<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    // app/Models/Ruangan.php
protected $table = 'ruangans';
protected $primaryKey = 'id_ruangan'; // Sesuai yang dipakai di tampilan
protected $fillable = ['nama_ruangan', 'lokasi'];

    // 3. Relasi ke Model Aspirasi (Satu ruangan bisa punya banyak aspirasi)
    public function aspirasis()
    {
        return $this->hasMany(Aspirasi::class, 'ruangan_id');
    }
    public $timestamps = true; // Tetap aktifkan timestamps agar bisa diisi manual
}

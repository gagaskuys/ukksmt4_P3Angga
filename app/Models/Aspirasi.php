<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi - SUDAH DIBERSIHKAN
    protected $fillable = [
        'siswa_id',
        'kategori_id',
        'ruangan_id',
        'deskripsi_laporan',
        'foto',
        'status',
    ];

    // Hubungan ke Tabel Kategori - SESUAI id_kategori KAMU
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id_kategori');
    }

    // Hubungan ke Tabel Ruangan
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    use HasFactory;

    // ✅ SUDAH LENGKAP: Semua kolom wajib ada di sini biar masuk ke DB
    protected $fillable = [
        'siswa_id',
        'guru_id',
        'kategori_id',
        'ruangan_id',
        'deskripsi_laporan',
        'foto', // <-- Ini kunci biar nama foto masuk
        'status',
        'feedback_admin',
    ];

    // ✅ Relasi ke Guru
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }

    // ✅ Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    // ✅ Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id_kategori');
    }

    // ✅ Relasi ke Ruangan
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id');
    }
}
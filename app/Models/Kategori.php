<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'kategoris';

    // Tambahkan baris ini: tentukan nama kolom kunci utama yang benar
    protected $primaryKey = 'id_kategori'; // Ubah sesuai nama kolom di tabelmu

    // Kolom yang boleh diisi
    protected $fillable = [
        'nama_kategori',
    ];

    // Relasi ke Model Aspirasi
    public function aspirasis()
    {
        return $this->hasMany(Aspirasi::class, 'kategori_id');
    }
}
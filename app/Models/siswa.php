<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // Gunakan Model biasa, bukan Authenticatable jika login pakai tabel users

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';

    // Sesuaikan dengan phpMyAdmin kamu yang kolomnya cuma 'id'
    protected $primaryKey = 'id'; 

    // Kolom ini harus SAMA PERSIS dengan yang ada di phpMyAdmin kamu
    protected $fillable = [
        'user_id',
        'name',
        'nis',
        'kelas_id',
        'jurusan_id',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

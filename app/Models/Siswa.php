<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'user_id',
        'name',
        'nis',
        'kelas_id',
        'jurusan_id',
        'jenis_kelamin',
        'email',
        'password',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
    ];

    public $timestamps = true;

     // TAMBAHKAN KODE INI: Mengubah string tanggal menjadi objek Carbon secara otomatis
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
    // Relasi ke tabel Users
    // 2. Tambahkan fungsi ini untuk mengunci nama kolom ID saat proses Delete/Update
    public function getKeyName()
    {
        return 'id';
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // TENTU KAN RELASI KE JURUSAN (Tambahan Baru)
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    // TENTU KAN RELASI KE KELAS (Tambahan Baru)
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
        
}

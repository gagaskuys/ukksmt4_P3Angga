<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus';

    // 1. Paksakan primary key menggunakan 'id'
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'user_id',
        'name',
        'nip',
        'mata_pelajaran',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
    ];

        public $timestamps = true;
    
        // TAMBAHKAN KODE INI: Mengubah string tanggal menjadi objek Carbon secara otomatis
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
    // 2. Tambahkan fungsi ini untuk mengunci nama kolom ID saat proses Delete/Update
    public function getKeyName()
    {
        return 'id';
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

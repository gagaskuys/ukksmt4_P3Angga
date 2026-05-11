<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus'; // Sesuaikan dengan nama tabel di database
    protected $primaryKey = 'id_guru'; // Sesuaikan jika kunci utamanya bukan 'id'

    protected $fillable = [
        'nip',
        'name',
        'mata_pelajaran',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'alamat'
    ];
    public $timestamps = true; // Tetap aktifkan timestamps agar bisa diisi manual
}
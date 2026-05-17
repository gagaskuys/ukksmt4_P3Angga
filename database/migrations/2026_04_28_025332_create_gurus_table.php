<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            //  relasi dengan tabel users, setiap guru memiliki satu akun user  
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Menghubungkan dengan tabel users

            // Menambahkan kolom-kolom khusus untuk guru
            $table->string('nip', 20)->unique(); // NIP unik untuk setiap guru
            $table->string('name', 100);
            $table->string('mata_pelajaran', 50);   
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_lahir');
            $table->string('alamat', 255);
            $table->string('no_telepon', 15);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};

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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Menghubungkan dengan tabel users
            $table->string('nis', 20)->unique(); // NIS unik untuk setiap siswa
            $table->string('name', 100);
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade'); // Menghubungkan dengan tabel kelas
            $table->foreignId('jurusan_id')->constrained('jurusans')->onDelete('cascade'); // Menghubungkan dengan tabel jurusan
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_lahir');
            $table->string('alamat', 255);
            $table->string('no_telepon', 15);
            $table->string('foto', 255)->nullable(); // Menyimpan path foto siswa, bisa nullable jika tidak wajib
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};

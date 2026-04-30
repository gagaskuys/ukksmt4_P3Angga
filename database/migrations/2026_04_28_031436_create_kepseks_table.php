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
        Schema::create('kepseks', function (Blueprint $table) {
            $table->id();
            // relasi ke table kepsek dengan table users, setiap kepala sekolah memiliki satu akun user
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Menambahkan kolom-kolom khusus untuk kepala sekolah
            $table->string('nip', 20)->unique(); // NIP unik untuk setiap
            $table->string('name', 100);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('no_hp', 15);
            $table->string('foto', 255)->nullable(); // Menyimpan path foto kepala sekolah, bisa nullable jika tidak wajib
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepseks');
    }
};

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
        Schema::create('petugas', function (Blueprint $table) {
            $table->id();
            //relasi ke table petugas dengan table users, setiap petugas memiliki satu akun user
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            // Menambahkan kolom-kolom khusus untuk petugas
            $table->string('nip', 20)->unique(); // NIP unik untuk setiap petugas
            $table->string('name', 100);
            $table->string('jabatan', 50);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('no_hp', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petugas');
    }
};

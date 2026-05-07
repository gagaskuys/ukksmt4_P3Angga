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
        Schema::create('kategoris', function (Blueprint $table) {
            //menggunakan id_kategori sesuai dengan kebutuhan aplikasi, misalnya untuk mengelompokkan aspirasi berdasarkan jenis masalah atau bidang tertentu.
            $table->id('id_kategori')->unique(); // ID kategori unik untuk setiap kategori
            $table->string('nama_kategori', 50); // Nama kategori, misalnya
            $table->timestamps('created_at')->useCurrent();
            $table->timestamps('updated_at')->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategoris');
    }
};

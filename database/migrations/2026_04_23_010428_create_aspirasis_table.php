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
    Schema::create('aspirasis', function (Blueprint $table) {
        $table->id();
        // ID Siswa yang kirim aspirasi
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('topik');
        $table->text('cerita');
        // Status awal otomatis 'menunggu'
        $table->enum('status', ['menunggu', 'proses', 'selesai'])->default('menunggu');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasis');
    }
};

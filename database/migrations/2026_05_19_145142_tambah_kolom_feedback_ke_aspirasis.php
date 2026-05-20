<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('aspirasis', function (Blueprint $table) {
        // Tambah kolom buat simpan balasan/feedback admin
        $table->text('feedback_admin')->nullable()->after('status'); 
    });
}

public function down(): void
{
    Schema::table('aspirasis', function (Blueprint $table) {
        $table->dropColumn('feedback_admin');
    });
}
};

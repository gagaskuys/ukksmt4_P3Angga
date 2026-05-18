<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToMultipleTables extends Migration
{
    public function up()
    {
        // 1. Tambah ke tabel GURU
        if (Schema::hasTable('gurus')) {
            Schema::table('gurus', function (Blueprint $table) {
                $table->timestamps(); // Ini yang MEMBUAT kolom created_at & updated_at
            });
        }

        // 2. Tambah ke tabel PETUGAS
        if (Schema::hasTable('petugas')) {
            Schema::table('petugas', function (Blueprint $table) {
                $table->timestamps(); // Ini yang MEMBUAT kolom created_at & updated_at
            });
        }
        if (Schema::hasTable('kelas')) {
            Schema::table('kelas', function (Blueprint $table) {
                $table->timestamps(); // Ini yang MEMBUAT kolom created_at & updated_at
            });
        }

        if (Schema::hasTable('jurusans')) {
            Schema::table('jurusans', function (Blueprint $table) {
                $table->timestamps(); // Ini yang MEMBUAT kolom created_at & updated_at
            });
        }

        if (Schema::hasTable('siswas')) {
            Schema::table('siswas', function (Blueprint $table) {
                $table->timestamps(); // Ini yang MEMBUAT kolom created_at & updated_at
            });
        }

        if (Schema::hasTable('kategoris')) {
            Schema::table('kategoris', function (Blueprint $table) {
                $table->timestamps(); // Ini yang MEMBUAT kolom created_at & updated_at
            });
        }

        if (Schema::hasTable('ruangans')) {
            Schema::table('ruangans', function (Blueprint $table) {
                $table->timestamps(); // Ini yang MEMBUAT kolom created_at & updated_at
            });
        }

        if (Schema::hasTable('aspirasis')) {
            Schema::table('aspirasis', function (Blueprint $table) {
                $table->timestamps(); // Ini yang MEMBUAT kolom created_at & updated_at
            });
        }

        // 3. Tambah ke tabel KEPSEK
        if (Schema::hasTable('kepseks')) {
            Schema::table('kepseks', function (Blueprint $table) {
                $table->timestamps(); // Ini yang MEMBUAT kolom created_at & updated_at
            });
        }
    }

    public function down()
    {
        // Dikosongkan karena Anda tidak ingin membuat fitur hapus/rollback
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailAndPasswordToMultipleTables extends Migration
{
    public function up()
    {
        // 1. Tambah ke tabel GURU (sesuaikan jika nama tabelnya 'gurus')
        if (Schema::hasTable('gurus')) {
            Schema::table('gurus', function (Blueprint $table) {
                $table->string('email')->unique()->nullable()->after('name');
                $table->string('password')->nullable()->after('email');
            });
        }

        // 2. Tambah ke tabel PETUGAS (sesuaikan jika nama tabelnya 'petugases')
        if (Schema::hasTable('petugas')) {
            Schema::table('petugas', function (Blueprint $table) {
                $table->string('email')->unique()->nullable()->after('name');
                $table->string('password')->nullable()->after('email');
            });
        }

        // 3. Tambah ke tabel KEPSEK (sesuaikan jika nama tabelnya 'kepseks')
        if (Schema::hasTable('kepseks')) {
            Schema::table('kepseks', function (Blueprint $table) {
                $table->string('email')->unique()->nullable()->after('name');
                $table->string('password')->nullable()->after('email');
            });
        }
    }

    public function down()
    {
        // Fitur Rollback jika ingin membatalkan migration
        if (Schema::hasTable('gurus')) {
            Schema::table('gurus', function (Blueprint $table) {
                $table->dropColumn(['email', 'password']);
            });
        }
        if (Schema::hasTable('petugas')) {
            Schema::table('petugas', function (Blueprint $table) {
                $table->dropColumn(['email', 'password']);
            });
        }
        if (Schema::hasTable('kepseks')) {
            Schema::table('kepseks', function (Blueprint $table) {
                $table->dropColumn(['email', 'password']);
            });
        }
    }
}

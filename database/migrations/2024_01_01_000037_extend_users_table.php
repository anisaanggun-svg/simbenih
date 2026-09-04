<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->after('name');
            $table->string('role')->nullable()->after('username');
            $table->string('wewenang_data')->nullable()->after('role');
            $table->unsignedBigInteger('id_pegawai')->nullable()->after('wewenang_data');
            $table->string('id_satgas')->nullable()->after('id_pegawai');
            $table->string('kode_kabupaten')->nullable()->after('id_satgas');
            $table->string('id_komoditas')->nullable()->after('kode_kabupaten');

            $table->index('username');
            $table->index('role');
            $table->index('id_pegawai');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['username']);
            $table->dropIndex(['role']);
            $table->dropIndex(['id_pegawai']);

            $table->dropColumn([
                'username',
                'role',
                'wewenang_data',
                'id_pegawai',
                'id_satgas',
                'kode_kabupaten',
                'id_komoditas',
            ]);
        });
    }
};

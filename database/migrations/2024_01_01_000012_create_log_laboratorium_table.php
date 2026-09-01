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
        Schema::create('log_laboratorium', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->comment('Nama Pengguna');
            $table->text('log')->comment('Aksi/Log');
            $table->dateTime('logdate')->comment('Tanggal Log');
            $table->string('username')->comment('Username');
            $table->index('logdate');
            $table->index('username');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_laboratorium');
    }
};

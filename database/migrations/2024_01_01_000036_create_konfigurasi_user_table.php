<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel `konfigurasi_user` (Master Konfigurasi User) mengikuti struktur dari
     * sistem sumber atur_konfigurasi. Field:
     *   - nama_konfigurasi   : Nama konfigurasi (contoh: tahun, satgas, Otomatisasi no asal).
     *   - nilai_konfigurasi  : Nilai konfigurasi (string dinamis sesuai kebutuhan sistem).
     */
    public function up(): void
    {
        Schema::create('konfigurasi_user', function (Blueprint $table) {
            $table->id();
            $table->string('nama_konfigurasi')->comment('Nama konfigurasi (contoh: tahun, satgas, Otomatisasi no asal)');
            $table->text('nilai_konfigurasi')->nullable()->comment('Nilai konfigurasi (string dinamis, contoh: 2026, Surabaya, false)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konfigurasi_user');
    }
};

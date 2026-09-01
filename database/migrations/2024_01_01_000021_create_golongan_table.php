<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel `golongan` (Master Kumpulan) mengikuti struktur dari sistem sumber atur_gangan.
     * Field:
     *   - kode_golongan    : Kode Kumpulan (unik, max 5 char)
     *   - nama_golongan    : Nama Kumpulan
     *   - komoditas_id     : Foreign key ke tabel `komoditas` (Master Golongan / parent)
     *   - jenis_golongan   : B=Buah, S=Sayur, P=Pangan, L=Lainnya
     *   - status_golongan  : 1=Aktif, 0=Tidak Aktif
     */
    public function up(): void
    {
        Schema::create('golongan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_golongan', 5)->unique()->comment('Kode Kumpulan');
            $table->string('nama_golongan')->comment('Nama Kumpulan');
            $table->unsignedBigInteger('komoditas_id')->nullable()->comment('FK ke tabel komoditas (Master Golongan)');
            $table->enum('jenis_golongan', ['B', 'S', 'P', 'L'])->default('L')->comment('B=Buah, S=Sayur, P=Pangan, L=Lainnya');
            $table->enum('status_golongan', ['0', '1'])->default('1')->comment('Status: 1=Aktif, 0=Tidak Aktif');

            $table->foreign('komoditas_id')
                ->references('id')
                ->on('komoditas')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('golongan');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel `kecamatan` (Master Kecamatan) mengikuti struktur dari sistem sumber atur_kecamatan.
     * Field:
     *   - kode_kecamatan             : Kode kecamatan (unik, contoh: 0001, 0002)
     *   - kode_kecamatan_nasional    : Kode kecamatan Nasional (contoh: 130, 110)
     *   - nama_kecamatan             : Nama kecamatan (contoh: Arosbaya, Bangkalan)
     *   - kabupaten_id               : Foreign key ke tabel kabupaten
     *   - status_kecamatan           : 1=Aktif, 0=Tidak Aktif
     */
    public function up(): void
    {
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kecamatan', 10)->comment('Kode kecamatan');
            $table->string('kode_kecamatan_nasional', 10)->comment('Kode kecamatan Nasional');
            $table->string('nama_kecamatan')->comment('Nama kecamatan');
            $table->unsignedBigInteger('kabupaten_id')->comment('Foreign key ke kabupaten');
            $table->enum('status_kecamatan', ['0', '1'])->default('1')->comment('Status: 1=Aktif, 0=Tidak Aktif');

            $table->foreign('kabupaten_id')->references('id')->on('kabupaten')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kecamatan');
    }
};

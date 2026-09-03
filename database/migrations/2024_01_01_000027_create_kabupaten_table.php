<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel `kabupaten` (Master Kabupaten) mengikuti struktur dari sistem sumber atur_kabupaten.
     * Field:
     *   - kode_satkab               : Kode Satgas-Kabupaten (unik, contoh: 101, 102)
     *   - kode_kabupaten_nasional   : Kode Kabupaten Nasional (contoh: 78, 15)
     *   - nama_kabupaten            : Nama Kabupaten (contoh: Surabaya, Sidoarjo)
     *   - satgas                    : ID/Index satgas (1=Surabaya, 2=Madiun, 3=Kediri,
     *                                 4=Malang, 5=Jember, 6=Banyuwangi) sesuai sumber.
     *   - status_kabupaten          : 1=Aktif, 0=Tidak Aktif
     */
    public function up(): void
    {
        Schema::create('kabupaten', function (Blueprint $table) {
            $table->id();
            $table->string('kode_satkab', 10)->unique()->comment('Kode Satgas-Kabupaten');
            $table->string('kode_kabupaten_nasional', 10)->comment('Kode Kabupaten Nasional');
            $table->string('nama_kabupaten')->comment('Nama Kabupaten');
            $table->unsignedTinyInteger('satgas')->default(0)->comment('1=Surabaya, 2=Madiun, 3=Kediri, 4=Malang, 5=Jember, 6=Banyuwangi');
            $table->enum('status_kabupaten', ['0', '1'])->default('1')->comment('Status: 1=Aktif, 0=Tidak Aktif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kabupaten');
    }
};
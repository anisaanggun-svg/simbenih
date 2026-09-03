<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel `satgas` (Master Wilayah Kerja) mengikuti struktur dari sistem sumber atur_satgas.
     * Field:
     *   - kode_satgas   : Kode Wilayah Kerja / Satgas (unik, numerik 0-6, contoh: 1=Surabaya, 2=Madiun)
     *   - nama_satgas   : Nama Wilayah Kerja (contoh: Surabaya, Madiun, Kediri, Malang, Jawa Timur)
     *   - status_satgas : 1=Aktif, 0=Tidak Aktif
     *
     * Catatan: tabel ini menjadi acuan untuk kolom `kabupaten.satgas`
     *          yang menyimpan index satgas (1=Surabaya, 2=Madiun, dst).
     */
    public function up(): void
    {
        Schema::create('satgas', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('kode_satgas')->unique()->comment('Kode Wilayah Kerja / Satgas (1=Surabaya, 2=Madiun, 3=Kediri, 4=Malang, 5=Jember, 6=Banyuwangi, 0=Lainnya)');
            $table->string('nama_satgas')->comment('Nama Wilayah Kerja');
            $table->enum('status_satgas', ['0', '1'])->default('1')->comment('Status: 1=Aktif, 0=Tidak Aktif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('satgas');
    }
};
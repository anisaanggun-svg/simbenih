<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel `kelas_benih` (Master Kelas Benih) mengikuti struktur dari sistem sumber atur_kelas_benih.
     * Field:
     *   - kode_kb                   : Kode Kelas Benih (unik, max 5 char)
     *   - nama_kb                   : Nama Kelas Benih
     *   - grup_kelas_benih_id       : Relasi ke Master Grup Kelas Benih (Gol Kelas Benih)
     *   - status_kelas_benih        : 1=Aktif, 0=Tidak Aktif
     */
    public function up(): void
    {
        Schema::create('kelas_benih', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kb', 5)->comment('Kode Kelas Benih');
            $table->string('nama_kb')->comment('Nama Kelas Benih');
            $table->unsignedBigInteger('grup_kelas_benih_id')->nullable()->comment('Relasi ke Grup Kelas Benih');
            $table->enum('status_kelas_benih', ['0', '1'])->default('1')->comment('Status: 1=Aktif, 0=Tidak Aktif');

            $table->foreign('grup_kelas_benih_id')
                ->references('id')
                ->on('grup_kelas_benih')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas_benih');
    }
};

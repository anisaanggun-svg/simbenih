<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel `grup_kelas_benih` (Master Gol Kelas Benih) mengikuti struktur dari sistem sumber atur_grup_kelas_benih.
     * Field:
     *   - kode_grup_kelas_benih    : Kode Grup Kelas Benih (unik, max 10 char)
     *   - nama_grup_kelas_benih    : Nama Grup Kelas Benih
     *   - digit                   : Digit Label (Angka)
     *   - warna_label             : Warna Label
     *   - status_grup             : 1=Aktif, 0=Tidak Aktif
     */
    public function up(): void
    {
        Schema::create('grup_kelas_benih', function (Blueprint $table) {
            $table->id();
            $table->string('kode_grup_kelas_benih', 10)->unique()->comment('Kode Grup Kelas Benih');
            $table->string('nama_grup_kelas_benih')->comment('Nama Grup Kelas Benih');
            $table->string('digit', 10)->comment('Digit Label (Angka)');
            $table->string('warna_label', 50)->comment('Warna Label');
            $table->enum('status_grup', ['0', '1'])->default('1')->comment('Status: 1=Aktif, 0=Tidak Aktif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grup_kelas_benih');
    }
};

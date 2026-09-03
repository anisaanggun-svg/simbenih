<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel `penyakit` (Master Penyakit) mengikuti struktur dari sistem sumber atur_penyakit.
     * Field:
     *   - kode_penyakit        : Kode Penyakit (unik)
     *   - kelompok_penyakit    : Bakteri | Virus | Hama | Hama Vektor | Jamur
     *   - nama_penyakit        : Nama Penyakit
     *   - ket_penyakit         : Keterangan Penyakit
     *   - status_penyakit      : 1=Aktif, 0=Tidak Aktif
     */
    public function up(): void
    {
        Schema::create('penyakit', function (Blueprint $table) {
            $table->id();
            $table->string('kode_penyakit', 10)->unique()->comment('Kode Penyakit');
            $table->enum('kelompok_penyakit', ['Bakteri', 'Virus', 'Hama', 'Hama Vektor', 'Jamur'])
                ->default('Hama')
                ->comment('Kelompok Penyakit');
            $table->string('nama_penyakit')->comment('Nama Penyakit');
            $table->string('ket_penyakit')->nullable()->comment('Keterangan Penyakit');
            $table->enum('status_penyakit', ['0', '1'])->default('1')->comment('Status: 1=Aktif, 0=Tidak Aktif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyakit');
    }
};
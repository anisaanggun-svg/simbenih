<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel `mata_anggaran` (Master M. Anggaran) mengikuti struktur dari sistem sumber atur_mata_anggaran.
     * Field:
     *   - kode_mata_anggaran   : Kode Mata Anggaran (unik, contoh: N, D, P, AL).
     *   - nama_mata_anggaran   : Nama Mata Anggaran (contoh: APBN, APBD, Pemurnian, Anggaran Lain).
     *   - status_mata_anggaran : 1=Aktif, 0=Tidak Aktif
     */
    public function up(): void
    {
        Schema::create('mata_anggaran', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mata_anggaran', 50)->unique()->comment('Kode Mata Anggaran (unik, contoh: N=APBN, D=APBD, P=Pemurnian, AL=Anggaran Lain)');
            $table->string('nama_mata_anggaran')->comment('Nama Mata Anggaran (contoh: APBN, APBD, Pemurnian, Anggaran Lain)');
            $table->enum('status_mata_anggaran', ['0', '1'])->default('1')->comment('Status: 1=Aktif, 0=Tidak Aktif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_anggaran');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel `status` (Master Status) mengikuti struktur dari sistem sumber atur_status.
     * Field:
     *   - kode_status   : Kode Status (unik, numerik, contoh: 1=Dinas Pusat, 2=Dinas Propinsi, dst.)
     *   - nama_status   : Nama Status (contoh: Dinas Pusat, Dinas Propinsi, PT Pertani, dst.)
     *   - status_status : 1=Aktif, 0=Tidak Aktif
     */
    public function up(): void
    {
        Schema::create('status', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('kode_status')->unique()->comment('Kode Status (numerik, contoh: 1=Dinas Pusat, 2=Dinas Propinsi, 3=Dinas Kabupaten, dst.)');
            $table->string('nama_status')->comment('Nama Status (contoh: Dinas Pusat, Dinas Propinsi, PT Pertani, PT SHS, Swasta)');
            $table->enum('status_status', ['0', '1'])->default('1')->comment('Status: 1=Aktif, 0=Tidak Aktif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status');
    }
};
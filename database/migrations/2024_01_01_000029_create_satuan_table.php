<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel `satuan` (Master Satuan) mengikuti struktur dari sistem sumber atur_satuan.
     * Field:
     *   - kode_satuan    : Kode Satuan (unik, contoh: Ton, Kg, Gr, Btg, Knol, Planlet, Ha)
     *   - nama_satuan    : Nama Satuan (contoh: Ton, Kilogram, Gram)
     *   - jenis_satuan   : Satuan Berat | Satuan Jumlah | Satuan Luas
     *   - pengali        : Pengali ke satuan terkecil (MiliGram untuk Berat, Meter Persegi untuk Luas).
     *                     Isi "1" bila satuan tidak dapat dikonversikan.
     *   - status_satuan  : 1=Aktif, 0=Tidak Aktif
     */
    public function up(): void
    {
        Schema::create('satuan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_satuan', 50)->unique()->comment('Kode Satuan');
            $table->string('nama_satuan')->comment('Nama Satuan');
            $table->enum('jenis_satuan', ['Satuan Berat', 'Satuan Jumlah', 'Satuan Luas'])
                ->default('Satuan Jumlah')
                ->comment('Jenis Satuan');
            $table->unsignedInteger('pengali')->default(1)->comment('Pengali ke satuan terkecil');
            $table->enum('status_satuan', ['0', '1'])->default('1')->comment('Status: 1=Aktif, 0=Tidak Aktif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('satuan');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel `jenis_tanaman` (Master Jenis Tanaman) mengikuti struktur dari sistem sumber atur_jenis_tanaman.
     */
    public function up(): void
    {
        Schema::create('jenis_tanaman', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tanaman', 10)->unique()->comment('Kode Tanaman');
            $table->string('nama_tanaman')->comment('Nama Tanaman');
            $table->string('klasifikasi', 20)->nullable()->comment('Jenis Perbanyakan: Hibrida / Non Hibrida');
            $table->string('nama_perbanyakan')->nullable()->comment('Nama Perbanyakan');
            $table->string('satuan_penangkaran', 50)->nullable()->comment('Satuan Penangkaran');
            $table->string('satuan_produk', 50)->nullable()->comment('Satuan Produk');
            $table->string('nama_satuan', 50)->nullable()->comment('Satuan Kemasan');
            $table->integer('populasi_pemeriksaan')->nullable()->comment('Populasi pemeriksaan');
            $table->integer('populasi_pemeriksaan_jantan')->nullable()->comment('Populasi pemeriksaan Jantan');
            $table->integer('populasi_pemeriksaan_betina')->nullable()->comment('Populasi pemeriksaan Betina');
            $table->enum('pendahuluan', ['Ya', 'Tidak'])->nullable()->comment('Fase Pendahuluan');
            $table->enum('vegetatif', ['Ya', 'Tidak'])->nullable()->comment('Fase Vegetatif');
            $table->enum('vegetatif1', ['Ya', 'Tidak'])->nullable()->comment('Fase Vegetatif 1');
            $table->enum('vegetatif2', ['Ya', 'Tidak'])->nullable()->comment('Fase Vegetatif 2');
            $table->enum('vegetatif3', ['Ya', 'Tidak'])->nullable()->comment('Fase Vegetatif 3');
            $table->enum('vegetatif_ulangan', ['Ya', 'Tidak'])->nullable()->comment('Fase Vegetatif Ulangan');
            $table->enum('berbunga1', ['Ya', 'Tidak'])->nullable()->comment('Fase Berbunga 1');
            $table->enum('berbunga2', ['Ya', 'Tidak'])->nullable()->comment('Fase Berbunga 2');
            $table->enum('berbunga3', ['Ya', 'Tidak'])->nullable()->comment('Fase Berbunga 3');
            $table->enum('berbunga_ulangan', ['Ya', 'Tidak'])->nullable()->comment('Fase Berbunga Ulangan');
            $table->enum('masak', ['Ya', 'Tidak'])->nullable()->comment('Fase Masak');
            $table->enum('masak_ulangan', ['Ya', 'Tidak'])->nullable()->comment('Fase Masak Ulangan');
            $table->enum('panen', ['Ya', 'Tidak'])->nullable()->comment('Fase Panen');
            $table->enum('pengolahan', ['Ya', 'Tidak'])->nullable()->comment('Fase Pengolahan');
            $table->enum('siap_siar', ['Ya', 'Tidak'])->nullable()->comment('Siap Siar');
            $table->enum('pengambilan_contoh', ['Ya', 'Tidak'])->nullable()->comment('Pengambilan Contoh');
            $table->enum('pengiriman_contoh', ['Ya', 'Tidak'])->nullable()->comment('Pengiriman Contoh');
            $table->enum('kaji_ulang', ['Ya', 'Tidak'])->nullable()->comment('Kaji Ulang');
            $table->enum('uji_kadar_air', ['Ya', 'Tidak'])->nullable()->comment('Uji Kadar Air');
            $table->enum('uji_kemurnian', ['Ya', 'Tidak'])->nullable()->comment('Uji Kemurnian');
            $table->enum('uji_cvl', ['Ya', 'Tidak'])->nullable()->comment('Uji CVL');
            $table->enum('uji_warna_lain', ['Ya', 'Tidak'])->nullable()->comment('Uji Warna Lain');
            $table->enum('penilaian', ['Ya', 'Tidak'])->nullable()->comment('Penilaian');
            $table->enum('seri_label', ['Ya', 'Tidak'])->nullable()->comment('Seri Label');
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif')->comment('Status data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_tanaman');
    }
};

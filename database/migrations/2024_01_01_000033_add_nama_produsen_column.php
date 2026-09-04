<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Menambahkan kolom `nama_produsen` ke tabel `produsen` jika belum ada.
     *
     * Kolom ini dipakai oleh Master Produsen (mengikuti struktur form
     * sistem sumber atur_produsen). Pada tabel legacy, kolom nama
     * produsen disimpan sebagai `nama`; untuk menjaga kompatibilitas
     * dengan modul sertifikasi & laboratorium yang masih menggunakan
     * `nama`, kita tambahkan `nama_produsen` dan meng-copy isi `nama`
     * ke `nama_produsen` agar data lama tetap tersedia.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('produsen', 'nama_produsen')) {
            Schema::table('produsen', function (Blueprint $table) {
                $table->string('nama_produsen', 255)->nullable()->after('id');
            });

            // Backfill dari kolom 'nama' yang sudah ada agar data lama
            // (sample PT. Sumber Benih, CV. Makmur Jaya, dsb) tetap
            // tersedia di Master Produsen.
            if (Schema::hasColumn('produsen', 'nama')) {
                DB::statement('UPDATE produsen SET nama_produsen = nama WHERE nama_produsen IS NULL');
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('produsen', 'nama_produsen')) {
            Schema::table('produsen', function (Blueprint $table) {
                $table->dropColumn('nama_produsen');
            });
        }
    }
};

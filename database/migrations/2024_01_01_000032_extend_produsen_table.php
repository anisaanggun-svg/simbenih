<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Menambahkan kolom-kolom yang dibutuhkan oleh Master Produsen
     * mengikuti struktur dari sistem sumber atur_produsen.
     */
    public function up(): void
    {
        Schema::table('produsen', function (Blueprint $table) {
            // No Induk Nasional Produsen (tidak wajib, mengikuti sistem sumber)
            if (!Schema::hasColumn('produsen', 'no_induk_produsen_nasional')) {
                $table->string('no_induk_produsen_nasional', 100)->nullable()->after('id');
            }

            // No TDPB (wajib, harus unik)
            if (!Schema::hasColumn('produsen', 'no_tdpb')) {
                $table->string('no_tdpb', 100)->nullable()->after('no_induk_produsen_nasional');
            }

            // Badan Usaha (PT / CV / UD / kosong)
            if (!Schema::hasColumn('produsen', 'badan_usaha')) {
                $table->string('badan_usaha', 50)->nullable()->after('no_tdpb');
            }

            // Kabupaten (relasi ke tabel kabupaten)
            if (!Schema::hasColumn('produsen', 'kabupaten_id')) {
                $table->unsignedInteger('kabupaten_id')->nullable()->after('badan_usaha');
                $table->index('kabupaten_id');
            }

            // Nomor Telepon
            if (!Schema::hasColumn('produsen', 'no_telp')) {
                $table->string('no_telp', 50)->nullable()->after('alamat');
            }

            // Relasi ke Master Status (sesuai sumber atur_produsen: "Nama status")
            if (!Schema::hasColumn('produsen', 'status_id')) {
                $table->unsignedInteger('status_id')->nullable()->after('no_telp');
                $table->index('status_id');
            }

            // Nama Kontak
            if (!Schema::hasColumn('produsen', 'nama_kontak')) {
                $table->string('nama_kontak', 150)->nullable()->after('status_id');
            }

            // Jabatan Kontak
            if (!Schema::hasColumn('produsen', 'jabatan_kontak')) {
                $table->string('jabatan_kontak', 100)->nullable()->after('nama_kontak');
            }

            // Status aktif/tidak aktif (master status)
            if (!Schema::hasColumn('produsen', 'status_produsen')) {
                $table->char('status_produsen', 1)->default('1')->after('jabatan_kontak');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produsen', function (Blueprint $table) {
            $columns = [
                'no_induk_produsen_nasional',
                'no_tdpb',
                'badan_usaha',
                'kabupaten_id',
                'no_telp',
                'status_id',
                'nama_kontak',
                'jabatan_kontak',
                'status_produsen',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('produsen', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};

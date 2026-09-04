<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Menambahkan kolom-kolom yang dibutuhkan oleh Master Pegawai
     * mengikuti struktur dari sistem sumber atur_pegawai.
     *
     * Struktur form sumber:
     *   NIP_PEGAWAI, NAMA_PEGAWAI, satgas (FK -> satgas.kode_satgas),
     *   JABATAN, NO_TELP, STATUS (Aktif/Tidak Aktif), IS_KA_SATGAS (YA/Tidak)
     */
    public function up(): void
    {
        Schema::table('pegawai', function (Blueprint $table) {
            if (!Schema::hasColumn('pegawai', 'nip_pegawai')) {
                $table->string('nip_pegawai', 50)->nullable()->after('id');
            }
            if (!Schema::hasColumn('pegawai', 'nama_pegawai')) {
                $table->string('nama_pegawai', 255)->nullable()->after('nip_pegawai');
            }
            if (!Schema::hasColumn('pegawai', 'satgas_id')) {
                $table->unsignedInteger('satgas_id')->nullable()->after('nama_pegawai');
            }
            if (!Schema::hasColumn('pegawai', 'jabatan')) {
                $table->string('jabatan', 200)->nullable()->after('satgas_id');
            }
            if (!Schema::hasColumn('pegawai', 'no_telp')) {
                $table->string('no_telp', 50)->nullable()->after('jabatan');
            }
            if (!Schema::hasColumn('pegawai', 'status_pegawai')) {
                $table->char('status_pegawai', 1)->default('1')->after('no_telp');
            }
            if (!Schema::hasColumn('pegawai', 'is_ka_satgas')) {
                $table->char('is_ka_satgas', 1)->default('0')->after('status_pegawai');
            }
        });

        // Backfill nama_pegawai dari kolom 'nama' agar data lama tetap tersedia.
        if (Schema::hasColumn('pegawai', 'nama')) {
            DB::statement('UPDATE pegawai SET nama_pegawai = nama WHERE nama_pegawai IS NULL');
        }
    }

    public function down(): void
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $columns = [
                'nip_pegawai',
                'nama_pegawai',
                'satgas_id',
                'jabatan',
                'no_telp',
                'status_pegawai',
                'is_ka_satgas',
            ];
            foreach ($columns as $column) {
                if (Schema::hasColumn('pegawai', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};

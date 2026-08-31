<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('uji_laboratorium', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('no_induk_lapangan', 100)->nullable();
            $table->string('no_berkas', 100)->nullable();
            $table->string('nama_produsen', 150)->nullable();
            $table->text('alamat_produsen')->nullable();
            $table->string('no_asal', 100)->nullable();
            $table->string('no_lab', 100)->nullable();
            $table->string('jenis_tanaman', 100)->nullable();
            $table->string('varietas', 100)->nullable();
            $table->string('kelas_benih', 50)->nullable();
            $table->string('no_lot', 50)->nullable();
            $table->date('tgl_panen_awal')->nullable();
            $table->date('tgl_panen_akhir')->nullable();
            $table->string('luas_lulus', 100)->nullable();
            $table->string('tonase', 100)->nullable();
            $table->date('tgl_selesai_pengujian')->nullable();
            $table->decimal('kadar_air', 8, 2)->nullable();
            $table->decimal('benih_murni', 8, 2)->nullable();
            $table->decimal('kotoran_benih', 8, 2)->nullable();
            $table->decimal('btl_gulma', 8, 2)->nullable();
            $table->integer('daya_berkecambah')->nullable();
            $table->integer('biji_keras')->nullable();
            $table->string('benih_warna_lain', 50)->nullable();
            $table->string('no_induk_lhu', 100)->nullable();
            $table->date('tgl_lhu')->nullable();
            $table->integer('petugas_lhu')->nullable();
            $table->date('tgl_kadaluarsa')->nullable();
            $table->string('kesimpulan', 10)->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('id_pegawai_ttd')->nullable();
            $table->timestamps();
        });

        // Seed sample data (migrated from the legacy hardcoded controller data)
        DB::table('uji_laboratorium')->insert([
            [
                'id' => 1673,
                'no_induk_lapangan' => 'PdnQI.P.3523070.0041.0001',
                'no_berkas' => 'TP24.107.0001',
                'nama_produsen' => 'UD. AGRO TANI',
                'alamat_produsen' => 'Desa Sokosari, Kec. Soko, Kab. Tuban',
                'no_asal' => 'SP.0229.11.124',
                'no_lab' => 'S.0202.1.24',
                'jenis_tanaman' => 'Padi Inbrida',
                'varietas' => 'Inpari 32 HDB',
                'kelas_benih' => 'BP',
                'no_lot' => '01/01',
                'tgl_panen_awal' => '2024-04-03',
                'tgl_panen_akhir' => '2024-04-05',
                'luas_lulus' => '5.5 Ha (Fase Terakhir)',
                'tonase' => '17500 Kilogram',
                'tgl_selesai_pengujian' => '2024-06-21',
                'kadar_air' => 11.8,
                'benih_murni' => 99.7,
                'kotoran_benih' => 0.3,
                'btl_gulma' => 0.0,
                'daya_berkecambah' => 93,
                'biji_keras' => 0,
                'benih_warna_lain' => '-',
                'no_induk_lhu' => 'PdnQI.P.3523070.0041.0001',
                'tgl_lhu' => '2024-06-21',
                'petugas_lhu' => 434,
                'tgl_kadaluarsa' => '2024-12-21',
                'kesimpulan' => '1',
                'keterangan' => '',
                'id_pegawai_ttd' => 270,
            ],
            [
                'id' => 1674,
                'no_induk_lapangan' => 'PdnSE.P.3514090.0279.0027',
                'no_berkas' => 'TP24.107.0002',
                'nama_produsen' => 'UD. SUMBER REJEKI',
                'alamat_produsen' => 'Desa Sumberrejo, Kec. Ngawi, Kab. Ngawi',
                'no_asal' => 'SP.0230.12.124',
                'no_lab' => 'S.0203.1.24',
                'jenis_tanaman' => 'Jagung',
                'varietas' => 'P-15',
                'kelas_benih' => 'BS',
                'no_lot' => '02/01',
                'tgl_panen_awal' => '2024-05-01',
                'tgl_panen_akhir' => '2024-05-10',
                'luas_lulus' => '3.2 Ha',
                'tonase' => '12000 Kilogram',
                'tgl_selesai_pengujian' => '2024-07-15',
                'kadar_air' => 12.5,
                'benih_murni' => 98.5,
                'kotoran_benih' => 1.0,
                'btl_gulma' => 0.5,
                'daya_berkecambah' => 90,
                'biji_keras' => 0,
                'benih_warna_lain' => '-',
                'no_induk_lhu' => 'PdnSE.P.3514090.0279.0027',
                'tgl_lhu' => '2024-07-15',
                'petugas_lhu' => 418,
                'tgl_kadaluarsa' => '2025-01-15',
                'kesimpulan' => '1',
                'keterangan' => '',
                'id_pegawai_ttd' => 280,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uji_laboratorium');
    }
};

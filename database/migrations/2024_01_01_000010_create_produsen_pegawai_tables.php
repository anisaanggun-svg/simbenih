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
        Schema::create('produsen', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('nama', 150);
            $table->text('alamat')->nullable();
            $table->timestamps();
        });

        Schema::create('pegawai', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('nama', 150);
            $table->timestamps();
        });

        // Seed sample data (referenced from the legacy hibrida system)
        DB::table('produsen')->insert([
            ['id' => 1538, 'nama' => 'PT. Sumber Benih', 'alamat' => 'Desa Genteng, Kec. Genteng, Kota Surabaya'],
            ['id' => 1539, 'nama' => 'CV. Makmur Jaya', 'alamat' => 'Desa Tlekung, Kec. Junrejo, Kota Batu'],
            ['id' => 1540, 'nama' => 'UD. Tani Subur', 'alamat' => 'Desa Wonokasian, Kec. Turen, Kab. Malang'],
            ['id' => 1541, 'nama' => 'PT. Benih Pertiwi', 'alamat' => 'Desa Pandanrejo, Kec. Bumiaji, Kota Batu'],
            ['id' => 1542, 'nama' => 'Koperasi Tani Makmur', 'alamat' => 'Desa Gondanglegi, Kec. Gondanglegi, Kab. Malang'],
        ]);

        DB::table('pegawai')->insert([
            ['id' => 270, 'nama' => 'Budi Santoso'],
            ['id' => 271, 'nama' => 'Sri Wahyuni'],
            ['id' => 272, 'nama' => 'Ahmad Fauzi'],
            ['id' => 273, 'nama' => 'Dewi Lestari'],
            ['id' => 274, 'nama' => 'Joko Susilo'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
        Schema::dropIfExists('produsen');
    }
};

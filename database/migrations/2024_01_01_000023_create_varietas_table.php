<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('varietas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_varietas')->unique();
            $table->string('nama_varietas');
            $table->foreignId('jenis_tanaman_id')->nullable()->constrained('jenis_tanaman')->nullOnDelete();
            $table->string('status_varietas')->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('varietas');
    }
};

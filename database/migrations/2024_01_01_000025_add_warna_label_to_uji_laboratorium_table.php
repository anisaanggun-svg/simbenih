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
        Schema::table('uji_laboratorium', function (Blueprint $table) {
            $table->string('warna_label', 50)->nullable()->after('kelas_benih');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('uji_laboratorium', function (Blueprint $table) {
            $table->dropColumn('warna_label');
        });
    }
};

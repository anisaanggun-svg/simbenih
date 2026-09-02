<?php

namespace Database\Seeders;

use App\Models\Varietas;
use Illuminate\Database\Seeder;

class VarietasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kode_varietas' => 'V001', 'nama_varietas' => 'Varietas Padi IR64', 'jenis_tanaman_id' => 1, 'status_varietas' => 'Aktif'],
            ['kode_varietas' => 'V002', 'nama_varietas' => 'Varietas Padi Ciherang', 'jenis_tanaman_id' => 1, 'status_varietas' => 'Aktif'],
            ['kode_varietas' => 'V003', 'nama_varietas' => 'Varietas Jagung Bisi 18', 'jenis_tanaman_id' => 2, 'status_varietas' => 'Aktif'],
            ['kode_varietas' => 'V004', 'nama_varietas' => 'Varietas Jagung Pioneer 21', 'jenis_tanaman_id' => 2, 'status_varietas' => 'Tidak Aktif'],
            ['kode_varietas' => 'V005', 'nama_varietas' => 'Varietas Kedelai Wilis', 'jenis_tanaman_id' => 3, 'status_varietas' => 'Aktif'],
            ['kode_varietas' => 'V006', 'nama_varietas' => 'Varietas Kedelai Detam 1', 'jenis_tanaman_id' => 3, 'status_varietas' => 'Aktif'],
            ['kode_varietas' => 'V007', 'nama_varietas' => 'Varietas Kacang Tanah Kelinci', 'jenis_tanaman_id' => 4, 'status_varietas' => 'Aktif'],
            ['kode_varietas' => 'V008', 'nama_varietas' => 'Varietas Kacang Tanah Domba', 'jenis_tanaman_id' => 4, 'status_varietas' => 'Tidak Aktif'],
            ['kode_varietas' => 'V009', 'nama_varietas' => 'Varietas Cabai Keriting', 'jenis_tanaman_id' => 5, 'status_varietas' => 'Aktif'],
            ['kode_varietas' => 'V010', 'nama_varietas' => 'Varietas Cabai Rawit', 'jenis_tanaman_id' => 5, 'status_varietas' => 'Aktif'],
        ];

        foreach ($data as $item) {
            Varietas::create($item);
        }
    }
}

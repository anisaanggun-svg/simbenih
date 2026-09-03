<?php

namespace Database\Seeders;

use App\Models\Satgas;
use Illuminate\Database\Seeder;

class SatgasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Data initial Wilayah Kerja (Satgas) mengikuti sistem sumber atur_satgas:
     *   1=Surabaya, 2=Madiun, 3=Kediri, 4=Malang, 5=Jember, 6=Banyuwangi.
     */
    public function run(): void
    {
        $data = [
            ['kode_satgas' => 1, 'nama_satgas' => 'Surabaya',    'status_satgas' => '1'],
            ['kode_satgas' => 2, 'nama_satgas' => 'Madiun',      'status_satgas' => '1'],
            ['kode_satgas' => 3, 'nama_satgas' => 'Kediri',      'status_satgas' => '1'],
            ['kode_satgas' => 4, 'nama_satgas' => 'Malang',      'status_satgas' => '1'],
            ['kode_satgas' => 5, 'nama_satgas' => 'Jember',      'status_satgas' => '1'],
            ['kode_satgas' => 6, 'nama_satgas' => 'Banyuwangi',  'status_satgas' => '1'],
            ['kode_satgas' => 0, 'nama_satgas' => 'Jawa Timur',  'status_satgas' => '0'],
        ];

        foreach ($data as $item) {
            // updateOrCreate agar seeder aman dijalankan berulang kali.
            Satgas::updateOrCreate(
                ['kode_satgas' => $item['kode_satgas']],
                $item
            );
        }
    }
}
<?php

namespace Database\Seeders;

use App\Models\GrupKelasBenih;
use App\Models\KelasBenih;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasBenihSeeder extends Seeder
{
    /**
     * Seed data Master Kelas Benih dan Grup Kelas Benih
     * berdasarkan sistem sumber atur_kelas_benih.
     */
    public function run(): void
    {
        // Pastikan Grup Kelas Benih yang dibutuhkan tersedia
        $grupList = [
            ['kode_grup_kelas_benih' => 'KI', 'nama_grup_kelas_benih' => 'Keterangan Mutu Benih', 'digit' => '0', 'warna_label' => 'abu-abu', 'status_grup' => '1'],
            ['kode_grup_kelas_benih' => 'NS', 'nama_grup_kelas_benih' => 'Benih inti', 'digit' => '7', 'warna_label' => 'kuning', 'status_grup' => '1'],
            ['kode_grup_kelas_benih' => 'BP', 'nama_grup_kelas_benih' => 'Benih Penjenis', 'digit' => '7', 'warna_label' => 'merah', 'status_grup' => '1'],
            ['kode_grup_kelas_benih' => 'BD', 'nama_grup_kelas_benih' => 'Benih Dasar', 'digit' => '7', 'warna_label' => 'hijau', 'status_grup' => '1'],
            ['kode_grup_kelas_benih' => 'BPK', 'nama_grup_kelas_benih' => 'Benih Pokok', 'digit' => '7', 'warna_label' => 'oranye', 'status_grup' => '1'],
            ['kode_grup_kelas_benih' => 'BS', 'nama_grup_kelas_benih' => 'Benih Sebar', 'digit' => '7', 'warna_label' => 'biru', 'status_grup' => '1'],
        ];

        foreach ($grupList as $grup) {
            GrupKelasBenih::firstOrCreate(
                ['kode_grup_kelas_benih' => $grup['kode_grup_kelas_benih']],
                $grup
            );
        }

        // Data Kelas Benih dari sumber atur_kelas_benih
        $kelasList = [
            // [kode_kb, nama_kb, grup_nama, status]
            ['kode_kb' => '-', 'nama_kb' => '-', 'grup_nama' => 'Keterangan Mutu Benih', 'status_kelas_benih' => '1'],
            ['kode_kb' => 'N', 'nama_kb' => 'NS', 'grup_nama' => 'Benih inti', 'status_kelas_benih' => '1'],
            ['kode_kb' => 'S', 'nama_kb' => 'BS', 'grup_nama' => 'Benih Penjenis', 'status_kelas_benih' => '1'],
            ['kode_kb' => 'S1', 'nama_kb' => 'BS1', 'grup_nama' => 'Benih Penjenis', 'status_kelas_benih' => '0'],
            ['kode_kb' => 'S2', 'nama_kb' => 'BS2', 'grup_nama' => 'Benih Penjenis', 'status_kelas_benih' => '0'],
            ['kode_kb' => 'S3', 'nama_kb' => 'BS3', 'grup_nama' => 'Benih Penjenis', 'status_kelas_benih' => '0'],
            ['kode_kb' => 'S4', 'nama_kb' => 'BS4', 'grup_nama' => 'Benih Penjenis', 'status_kelas_benih' => '0'],
            ['kode_kb' => 'D', 'nama_kb' => 'BD', 'grup_nama' => 'Benih Dasar', 'status_kelas_benih' => '1'],
            ['kode_kb' => 'D1', 'nama_kb' => 'BD1', 'grup_nama' => 'Benih Dasar', 'status_kelas_benih' => '0'],
            ['kode_kb' => 'D2', 'nama_kb' => 'BD2', 'grup_nama' => 'Benih Dasar', 'status_kelas_benih' => '0'],
        ];

        foreach ($kelasList as $kelas) {
            $grup = GrupKelasBenih::where('nama_grup_kelas_benih', $kelas['grup_nama'])->first();
            KelasBenih::firstOrCreate(
                ['kode_kb' => $kelas['kode_kb']],
                [
                    'kode_kb' => $kelas['kode_kb'],
                    'nama_kb' => $kelas['nama_kb'],
                    'grup_kelas_benih_id' => $grup ? $grup->id : null,
                    'status_kelas_benih' => $kelas['status_kelas_benih'],
                ]
            );
        }
    }
}

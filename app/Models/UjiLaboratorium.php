<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UjiLaboratorium extends Model
{
    protected $table = 'uji_laboratorium';

    protected $fillable = [
        'no_induk_lapangan',
        'no_berkas',
        'nama_produsen',
        'alamat_produsen',
        'no_asal',
        'no_lab',
        'jenis_tanaman',
        'varietas',
        'kelas_benih',
        'warna_label',
        'no_lot',
        'tgl_panen_awal',
        'tgl_panen_akhir',
        'luas_lulus',
        'tonase',
        'tgl_selesai_pengujian',
        'kadar_air',
        'benih_murni',
        'kotoran_benih',
        'btl_gulma',
        'daya_berkecambah',
        'biji_keras',
        'benih_warna_lain',
        'no_induk_lhu',
        'tgl_lhu',
        'petugas_lhu',
        'tgl_kadaluarsa',
        'kesimpulan',
        'keterangan',
        'id_pegawai_ttd',
    ];

    protected $casts = [
        'tgl_panen_awal' => 'date',
        'tgl_panen_akhir' => 'date',
        'tgl_selesai_pengujian' => 'date',
        'tgl_lhu' => 'date',
        'tgl_kadaluarsa' => 'date',
    ];

    /**
     * Mendapatkan label kesimpulan (Memenuhi Syarat / Tidak Memenuhi Syarat / Belum Ditentukan).
     */
    public function getKesimpulanLabelAttribute(): string
    {
        return match ($this->kesimpulan) {
            '1' => 'Memenuhi Syarat',
            '0' => 'Tidak Memenuhi Syarat',
            default => 'Belum Ditentukan',
        };
    }

    /**
     * Mendapatkan kelas badge untuk kesimpulan (warna AdminLTE).
     */
    public function getKesimpulanBadgeAttribute(): string
    {
        return match ($this->kesimpulan) {
            '1' => 'badge-success',
            '0' => 'badge-danger',
            default => 'badge-warning',
        };
    }
}

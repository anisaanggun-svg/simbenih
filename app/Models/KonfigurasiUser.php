<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KonfigurasiUser extends Model
{
    /**
     * Tabel yang digunakan oleh model ini.
     * Mengikuti struktur dari sistem sumber atur_konfigurasi.
     */
    protected $table = 'konfigurasi_user';

    /**
     * Field yang boleh diisi secara mass-assignment.
     */
    protected $fillable = [
        'nama_konfigurasi',
        'nilai_konfigurasi',
    ];

    /**
     * Sumber sistem asal tidak memakai timestamps Laravel.
     */
    public $timestamps = false;

    /**
     * Mendapatkan helper untuk memotong nilai konfigurasi yang panjang.
     */
    public function getNilaiSingkatAttribute(): string
    {
        $value = (string) $this->nilai_konfigurasi;
        if (mb_strlen($value) > 60) {
            return mb_substr($value, 0, 60) . '…';
        }
        return $value;
    }
}

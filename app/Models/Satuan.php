<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    /**
     * Tabel yang digunakan oleh model ini.
     * Mengikuti struktur dari sistem sumber atur_satuan.
     */
    protected $table = 'satuan';

    /**
     * Field yang boleh diisi secara mass-assignment.
     */
    protected $fillable = [
        'kode_satuan',
        'nama_satuan',
        'jenis_satuan',
        'pengali',
        'status_satuan',
    ];

    /**
     * Sumber sistem asal tidak memakai timestamps Laravel.
     */
    public $timestamps = false;

    /**
     * Konstanta jenis satuan sesuai sistem sumber atur_satuan.
     */
    public const JENIS_SATUAN_BERAT = 'Satuan Berat';
    public const JENIS_SATUAN_JUMLAH = 'Satuan Jumlah';
    public const JENIS_SATUAN_LUAS = 'Satuan Luas';

    /**
     * Mendapatkan label status (Aktif / Tidak Aktif).
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->status_satuan == '1' ? 'Aktif' : 'Tidak Aktif';
    }

    /**
     * Mendapatkan kelas badge untuk status (warna AdminLTE).
     */
    public function getStatusBadgeAttribute(): string
    {
        return $this->status_satuan == '1' ? 'badge-success' : 'badge-danger';
    }

    /**
     * Mendapatkan label jenis satuan (mengikuti sistem sumber).
     */
    public function getJenisSatuanLabelAttribute(): string
    {
        return $this->jenis_satuan ?: '-';
    }

    /**
     * Mendapatkan kelas badge untuk jenis satuan.
     */
    public function getJenisSatuanBadgeAttribute(): string
    {
        $map = [
            self::JENIS_SATUAN_BERAT  => 'badge-primary',
            self::JENIS_SATUAN_JUMLAH => 'badge-info',
            self::JENIS_SATUAN_LUAS   => 'badge-warning',
        ];

        return $map[$this->jenis_satuan] ?? 'badge-secondary';
    }

    /**
     * Daftar opsi jenis satuan (untuk dropdown) sesuai sistem sumber.
     *
     * @return array<int, string>
     */
    public static function jenisSatuanOptions(): array
    {
        return [
            self::JENIS_SATUAN_BERAT,
            self::JENIS_SATUAN_JUMLAH,
            self::JENIS_SATUAN_LUAS,
        ];
    }
}

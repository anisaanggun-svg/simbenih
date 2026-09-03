<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    /**
     * Tabel yang digunakan oleh model ini.
     * Mengikuti struktur dari sistem sumber atur_kabupaten.
     */
    protected $table = 'kabupaten';

    /**
     * Field yang boleh diisi secara mass-assignment.
     */
    protected $fillable = [
        'kode_satkab',
        'kode_kabupaten_nasional',
        'nama_kabupaten',
        'satgas',
        'status_kabupaten',
    ];

    /**
     * Sumber sistem asal tidak memakai timestamps Laravel.
     */
    public $timestamps = false;

    /**
     * Konstanta satgas sesuai sistem sumber atur_kabupaten.
     * 1=Surabaya, 2=Madiun, 3=Kediri, 4=Malang, 5=Jember, 6=Banyuwangi.
     */
    public const SATGAS_SURABAYA   = 1;
    public const SATGAS_MADIUN     = 2;
    public const SATGAS_KEDIRI     = 3;
    public const SATGAS_MALANG     = 4;
    public const SATGAS_JEMBER     = 5;
    public const SATGAS_BANYUWANGI = 6;

    /**
     * Mendapatkan label status (Aktif / Tidak Aktif).
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->status_kabupaten == '1' ? 'Aktif' : 'Tidak Aktif';
    }

    /**
     * Mendapatkan kelas badge untuk status (warna AdminLTE).
     */
    public function getStatusBadgeAttribute(): string
    {
        return $this->status_kabupaten == '1' ? 'badge-success' : 'badge-danger';
    }

    /**
     * Mendapatkan label satgas berdasarkan kode satgas.
     */
    public function getSatgasLabelAttribute(): string
    {
        $map = self::satgasOptions();
        return $map[(int) $this->satgas] ?? '-';
    }

    /**
     * Mendapatkan kelas badge untuk satgas (warna AdminLTE).
     */
    public function getSatgasBadgeAttribute(): string
    {
        $map = [
            self::SATGAS_SURABAYA   => 'badge-primary',
            self::SATGAS_MADIUN     => 'badge-info',
            self::SATGAS_KEDIRI     => 'badge-warning',
            self::SATGAS_MALANG     => 'badge-success',
            self::SATGAS_JEMBER     => 'badge-secondary',
            self::SATGAS_BANYUWANGI => 'badge-danger',
        ];

        return $map[(int) $this->satgas] ?? 'badge-secondary';
    }

    /**
     * Daftar opsi satgas (untuk dropdown) sesuai sistem sumber.
     *
     * @return array<int, string>
     */
    public static function satgasOptions(): array
    {
        return [
            self::SATGAS_SURABAYA   => 'Surabaya',
            self::SATGAS_MADIUN     => 'Madiun',
            self::SATGAS_KEDIRI     => 'Kediri',
            self::SATGAS_MALANG     => 'Malang',
            self::SATGAS_JEMBER     => 'Jember',
            self::SATGAS_BANYUWANGI => 'Banyuwangi',
        ];
    }

    /**
     * Relasi ke Master Kecamatan (child).
     * Seorang kabupaten dapat memiliki banyak kecamatan.
     */
    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class, 'kabupaten_id');
    }
}
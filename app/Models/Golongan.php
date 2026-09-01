<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Golongan extends Model
{
    /**
     * Tabel yang digunakan oleh model ini.
     * Mengikuti struktur dari sistem sumber atur_gongan.
     */
    protected $table = 'golongan';

    /**
     * Field yang boleh diisi secara mass-assignment.
     */
    protected $fillable = [
        'kode_golongan',
        'nama_golongan',
        'komoditas_id',
        'jenis_golongan',
        'status_golongan',
    ];

    /**
     * Sumber sistem asal tidak memakai timestamps Laravel.
     */
    public $timestamps = false;

    /**
     * Konstanta jenis golongan sesuai sistem sumber.
     */
    public const JENIS_BUAH = 'B';
    public const JENIS_SAYUR = 'S';
    public const JENIS_PANGAN = 'P';
    public const JENIS_LAINNYA = 'L';

    /**
     * Relasi ke Master Golongan (Komoditas) sebagai parent.
     */
    public function komoditas(): BelongsTo
    {
        return $this->belongsTo(Komoditas::class, 'komoditas_id');
    }

    /**
     * Mendapatkan label status (Aktif / Tidak Aktif).
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->status_golongan == '1' ? 'Aktif' : 'Tidak Aktif';
    }

    /**
     * Mendapatkan kelas badge untuk status (warna AdminLTE).
     */
    public function getStatusBadgeAttribute(): string
    {
        return $this->status_golongan == '1' ? 'badge-success' : 'badge-danger';
    }

    /**
     * Mendapatkan label teks untuk jenis golongan.
     */
    public function getJenisLabelAttribute(): string
    {
        $map = [
            self::JENIS_BUAH => 'Buah',
            self::JENIS_SAYUR => 'Sayur',
            self::JENIS_PANGAN => 'Pangan',
            self::JENIS_LAINNYA => 'Lainnya',
        ];

        return $map[$this->jenis_golongan] ?? 'Lainnya';
    }

    /**
     * Mendapatkan kelas badge untuk jenis golongan.
     */
    public function getJenisBadgeAttribute(): string
    {
        $map = [
            self::JENIS_BUAH => 'badge-warning',
            self::JENIS_SAYUR => 'badge-info',
            self::JENIS_PANGAN => 'badge-primary',
            self::JENIS_LAINNYA => 'badge-secondary',
        ];

        return $map[$this->jenis_golongan] ?? 'badge-secondary';
    }

    /**
     * Daftar opsi jenis golongan (untuk dropdown).
     *
     * @return array<string, string>
     */
    public static function jenisOptions(): array
    {
        return [
            self::JENIS_BUAH => 'Buah',
            self::JENIS_SAYUR => 'Sayur',
            self::JENIS_PANGAN => 'Pangan',
            self::JENIS_LAINNYA => 'Lainnya',
        ];
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    /**
     * Tabel yang digunakan oleh model ini.
     * Mengikuti struktur dari sistem sumber atur_penyakit.
     */
    protected $table = 'penyakit';

    /**
     * Field yang boleh diisi secara mass-assignment.
     */
    protected $fillable = [
        'kode_penyakit',
        'kelompok_penyakit',
        'nama_penyakit',
        'ket_penyakit',
        'status_penyakit',
    ];

    /**
     * Sumber sistem asal tidak memakai timestamps Laravel.
     */
    public $timestamps = false;

    /**
     * Konstanta kelompok penyakit sesuai sistem sumber.
     */
    public const KELOMPOK_BAKTERI = 'Bakteri';
    public const KELOMPOK_VIRUS = 'Virus';
    public const KELOMPOK_HAMA = 'Hama';
    public const KELOMPOK_HAMA_VEKTOR = 'Hama Vektor';
    public const KELOMPOK_JAMUR = 'Jamur';

    /**
     * Mendapatkan label status (Aktif / Tidak Aktif).
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->status_penyakit == '1' ? 'Aktif' : 'Tidak Aktif';
    }

    /**
     * Mendapatkan kelas badge untuk status (warna AdminLTE).
     */
    public function getStatusBadgeAttribute(): string
    {
        return $this->status_penyakit == '1' ? 'badge-success' : 'badge-danger';
    }

    /**
     * Mendapatkan kelas badge untuk kelompok penyakit (warna AdminLTE).
     */
    public function getKelompokBadgeAttribute(): string
    {
        $map = [
            self::KELOMPOK_BAKTERI => 'badge-warning',
            self::KELOMPOK_VIRUS => 'badge-info',
            self::KELOMPOK_HAMA => 'badge-danger',
            self::KELOMPOK_HAMA_VEKTOR => 'badge-primary',
            self::KELOMPOK_JAMUR => 'badge-secondary',
        ];

        return $map[$this->kelompok_penyakit] ?? 'badge-secondary';
    }

    /**
     * Daftar opsi kelompok penyakit (untuk dropdown).
     *
     * @return array<string, string>
     */
    public static function kelompokOptions(): array
    {
        return [
            self::KELOMPOK_BAKTERI => 'Bakteri',
            self::KELOMPOK_VIRUS => 'Virus',
            self::KELOMPOK_HAMA => 'Hama',
            self::KELOMPOK_HAMA_VEKTOR => 'Hama Vektor',
            self::KELOMPOK_JAMUR => 'Jamur',
        ];
    }
}
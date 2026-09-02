<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KelasBenih extends Model
{
    /**
     * Tabel yang digunakan oleh model ini.
     * Mengikuti struktur dari sistem sumber atur_kelas_benih.
     */
    protected $table = 'kelas_benih';

    /**
     * Field yang boleh diisi secara mass-assignment.
     */
    protected $fillable = [
        'kode_kb',
        'nama_kb',
        'grup_kelas_benih_id',
        'status_kelas_benih',
    ];

    /**
     * Sumber sistem asal tidak memakai timestamps Laravel.
     */
    public $timestamps = false;

    /**
     * Relasi ke Master Grup Kelas Benih (Gol Kelas Benih) sebagai parent.
     */
    public function grupKelasBenih(): BelongsTo
    {
        return $this->belongsTo(GrupKelasBenih::class, 'grup_kelas_benih_id');
    }

    /**
     * Mendapatkan label status (Aktif / Tidak Aktif).
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->status_kelas_benih == '1' ? 'Aktif' : 'Tidak Aktif';
    }

    /**
     * Mendapatkan kelas badge untuk status (warna AdminLTE).
     */
    public function getStatusBadgeAttribute(): string
    {
        return $this->status_kelas_benih == '1' ? 'badge-success' : 'badge-danger';
    }

    /**
     * Mendapatkan nama grup kelas benih dari relasi.
     */
    public function getNamaGrupKelasBenihAttribute(): string
    {
        return $this->grupKelasBenih ? $this->grupKelasBenih->nama_grup_kelas_benih : '-';
    }
}

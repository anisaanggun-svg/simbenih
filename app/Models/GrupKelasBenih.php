<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GrupKelasBenih extends Model
{
    /**
     * Tabel yang digunakan oleh model ini.
     * Mengikuti struktur dari sistem sumber atur_grup_kelas_benih.
     */
    protected $table = 'grup_kelas_benih';

    /**
     * Field yang boleh diisi secara mass-assignment.
     */
    protected $fillable = [
        'kode_grup_kelas_benih',
        'nama_grup_kelas_benih',
        'digit',
        'warna_label',
        'status_grup',
    ];

    /**
     * Sumber sistem asal tidak memakai timestamps Laravel.
     */
    public $timestamps = false;

    /**
     * Mendapatkan label status (Aktif / Tidak Aktif).
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->status_grup == '1' ? 'Aktif' : 'Tidak Aktif';
    }

    /**
     * Mendapatkan kelas badge untuk status (warna AdminLTE).
     */
    public function getStatusBadgeAttribute(): string
    {
        return $this->status_grup == '1' ? 'badge-success' : 'badge-danger';
    }

    /**
     * Relasi ke Master Kelas Benih sebagai child.
     */
    public function kelasBenih(): HasMany
    {
        return $this->hasMany(KelasBenih::class, 'grup_kelas_benih_id');
    }
}

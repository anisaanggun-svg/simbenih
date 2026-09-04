<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataAnggaran extends Model
{
    /**
     * Tabel yang digunakan oleh model ini.
     * Mengikuti struktur dari sistem sumber atur_mata_anggaran.
     */
    protected $table = 'mata_anggaran';

    /**
     * Field yang boleh diisi secara mass-assignment.
     */
    protected $fillable = [
        'kode_mata_anggaran',
        'nama_mata_anggaran',
        'status_mata_anggaran',
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
        return $this->status_mata_anggaran == '1' ? 'Aktif' : 'Tidak Aktif';
    }

    /**
     * Mendapatkan kelas badge untuk status (warna AdminLTE).
     */
    public function getStatusBadgeAttribute(): string
    {
        return $this->status_mata_anggaran == '1' ? 'badge-success' : 'badge-danger';
    }
}

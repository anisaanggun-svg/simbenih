<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /**
     * Tabel yang digunakan oleh model ini.
     * Mengikuti struktur dari sistem sumber atur_status.
     */
    protected $table = 'status';

    /**
     * Field yang boleh diisi secara mass-assignment.
     */
    protected $fillable = [
        'kode_status',
        'nama_status',
        'status_status',
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
        return $this->status_status == '1' ? 'Aktif' : 'Tidak Aktif';
    }

    /**
     * Mendapatkan kelas badge untuk status (warna AdminLTE).
     */
    public function getStatusBadgeAttribute(): string
    {
        return $this->status_status == '1' ? 'badge-success' : 'badge-danger';
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satgas extends Model
{
    /**
     * Tabel yang digunakan oleh model ini.
     * Mengikuti struktur dari sistem sumber atur_satgas (Master Wilayah Kerja).
     */
    protected $table = 'satgas';

    /**
     * Field yang boleh diisi secara mass-assignment.
     */
    protected $fillable = [
        'kode_satgas',
        'nama_satgas',
        'status_satgas',
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
        return $this->status_satgas == '1' ? 'Aktif' : 'Tidak Aktif';
    }

    /**
     * Mendapatkan kelas badge untuk status (warna AdminLTE).
     */
    public function getStatusBadgeAttribute(): string
    {
        return $this->status_satgas == '1' ? 'badge-success' : 'badge-danger';
    }

    /**
     * Relasi ke Master Kabupaten (child).
     * Satu Wilayah Kerja dapat memiliki banyak kabupaten.
     */
    public function kabupatens()
    {
        return $this->hasMany(Kabupaten::class, 'satgas', 'kode_satgas');
    }
}
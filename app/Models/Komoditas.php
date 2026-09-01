<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komoditas extends Model
{
    protected $table = 'komoditas';

    protected $fillable = [
        'kode_komoditas',
        'nama_komoditas',
        'status_komoditas',
    ];

    public $timestamps = false;

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->status_komoditas == '1' ? 'Aktif' : 'Tidak Aktif';
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeAttribute(): string
    {
        return $this->status_komoditas == '1' ? 'badge-success' : 'badge-danger';
    }
}

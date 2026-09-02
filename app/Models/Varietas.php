<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Varietas extends Model
{
    protected $table = 'varietas';

    protected $fillable = [
        'kode_varietas',
        'nama_varietas',
        'jenis_tanaman_id',
        'status_varietas',
    ];

    public $timestamps = true;

    /**
     * Relasi ke Master Jenis Tanaman sebagai parent.
     */
    public function jenisTanaman(): BelongsTo
    {
        return $this->belongsTo(JenisTanaman::class, 'jenis_tanaman_id');
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->status_varietas == 'Aktif' ? 'Aktif' : 'Tidak Aktif';
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeAttribute(): string
    {
        return $this->status_varietas == 'Aktif' ? 'badge-success' : 'badge-danger';
    }

    /**
     * Get nama tanaman from relation
     */
    public function getNamaTanamanAttribute(): string
    {
        return $this->jenisTanaman ? $this->jenisTanaman->nama_tanaman : '-';
    }
}

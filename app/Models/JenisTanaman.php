<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisTanaman extends Model
{
    protected $table = 'jenis_tanaman';

    protected $fillable = [
        'kode_tanaman',
        'nama_tanaman',
        'klasifikasi',
        'nama_perbanyakan',
        'satuan_penangkaran',
        'satuan_produk',
        'nama_satuan',
        'populasi_pemeriksaan',
        'populasi_pemeriksaan_jantan',
        'populasi_pemeriksaan_betina',
        'pendahuluan',
        'vegetatif',
        'vegetatif1',
        'vegetatif2',
        'vegetatif3',
        'vegetatif_ulangan',
        'berbunga1',
        'berbunga2',
        'berbunga3',
        'berbunga_ulangan',
        'masak',
        'masak_ulangan',
        'panen',
        'pengolahan',
        'siap_siar',
        'pengambilan_contoh',
        'pengiriman_contoh',
        'kaji_ulang',
        'uji_kadar_air',
        'uji_kemurnian',
        'uji_cvl',
        'uji_warna_lain',
        'penilaian',
        'seri_label',
        'status',
    ];

    public $timestamps = true;

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->status == 'Aktif' ? 'Aktif' : 'Tidak Aktif';
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeAttribute(): string
    {
        return $this->status == 'Aktif' ? 'badge-success' : 'badge-danger';
    }

    /**
     * Get klasifikasi label
     */
    public function getKlasifikasiLabelAttribute(): string
    {
        return $this->klasifikasi ?? '-';
    }

    /**
     * Get klasifikasi badge class
     */
    public function getKlasifikasiBadgeAttribute(): string
    {
        if ($this->klasifikasi == 'Hibrida') {
            return 'badge-warning';
        } elseif ($this->klasifikasi == 'Non Hibrida') {
            return 'badge-info';
        }
        return 'badge-secondary';
    }
}

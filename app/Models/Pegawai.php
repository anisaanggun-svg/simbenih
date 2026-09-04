<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pegawai extends Model
{
    /**
     * Tabel yang digunakan oleh model ini.
     */
    protected $table = 'pegawai';

    /**
     * Primary key tabel.
     */
    protected $primaryKey = 'id';

    /**
     * Non-auto increment karena sistem sumber menggunakan id manual.
     */
    public $incrementing = false;

    protected $keyType = 'int';

    /**
     * Field yang boleh diisi secara mass-assignment.
     *
     * Susunan field mengikuti struktur form dari sistem sumber
     * atur_pegawai (atur_pegawai/edit_pegawai).
     */
    protected $fillable = [
        'id',
        'nip_pegawai',
        'nama_pegawai',
        'satgas_id',
        'jabatan',
        'no_telp',
        'status_pegawai',
        'is_ka_satgas',
        // field legacy (NOT NULL) yang masih dipakai modul Sertifikasi & Lab
        'nama',
    ];

    /**
     * Sumber sistem asal tidak memakai timestamps Laravel.
     */
    public $timestamps = false;

    /**
     * Relasi ke Wilayah Kerja (Master Wilayah Kerja / satgas).
     * Menggunakan nama 'wilayahKerja' agar lebih deskriptif di Blade.
     */
    public function wilayahKerja(): BelongsTo
    {
        return $this->belongsTo(Satgas::class, 'satgas_id', 'kode_satgas');
    }

    /**
     * Label untuk status aktif/tidak aktif (Master).
     */
    public function getStatusPegawaiLabelAttribute(): string
    {
        return $this->status_pegawai == '1' ? 'Aktif' : 'Tidak Aktif';
    }

    /**
     * Warna badge untuk status master.
     */
    public function getStatusPegawaiBadgeAttribute(): string
    {
        return $this->status_pegawai == '1' ? 'badge-success' : 'badge-danger';
    }

    /**
     * Label untuk Ka Korwil (Apakah Koordinator Wilayah).
     */
    public function getIsKaSatgasLabelAttribute(): string
    {
        return $this->is_ka_satgas == '1' ? 'YA' : 'Tidak';
    }

    /**
     * Warna badge untuk Ka Korwil.
     */
    public function getIsKaSatgasBadgeAttribute(): string
    {
        return $this->is_ka_satgas == '1' ? 'badge-primary' : 'badge-secondary';
    }

    /**
     * Mendapatkan label nama wilayah kerja dengan fallback.
     * Accessor 'label_wilayah_kerja' untuk menghindari konflik dengan kolom
     * yang mungkin sudah ada di tabel.
     */
    public function getLabelWilayahKerjaAttribute(): string
    {
        return $this->wilayahKerja ? $this->wilayahKerja->nama_satgas : '-';
    }
}

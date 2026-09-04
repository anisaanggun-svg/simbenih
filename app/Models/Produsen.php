<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produsen extends Model
{
    /**
     * Tabel yang digunakan oleh model ini.
     */
    protected $table = 'produsen';

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
     * atur_produsen (atur_produsen/edit_produsen).
     */
    protected $fillable = [
        'id',
        'no_induk_produsen_nasional',
        'no_tdpb',
        'badan_usaha',
        'nama_produsen',
        'kabupaten_id',
        'no_telp',
        'status_id',
        'nama_kontak',
        'jabatan_kontak',
        'status_produsen',
        // field existing
        'nama',
        'alamat',
    ];

    /**
     * Sumber sistem asal tidak memakai timestamps Laravel.
     */
    public $timestamps = false;

    /**
     * Relasi ke Kabupaten.
     */
    public function kabupaten(): BelongsTo
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id', 'id');
    }

    /**
     * Relasi ke Status (Master Status) - menggunakan nama 'statusRef' untuk
     * menghindari konflik dengan kolom 'status' yang sudah ada di tabel produsen.
     */
    public function statusRef(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id', 'kode_status');
    }

    /**
     * Label untuk status aktif/tidak aktif.
     */
    public function getStatusProdusenLabelAttribute(): string
    {
        return $this->status_produsen == '1' ? 'Aktif' : 'Tidak Aktif';
    }

    /**
     * Warna badge untuk status master.
     */
    public function getStatusProdusenBadgeAttribute(): string
    {
        return $this->status_produsen == '1' ? 'badge-success' : 'badge-danger';
    }

    /**
     * Mendapatkan label nama kabupaten dengan fallback.
     * Nama accessor 'label_kabupaten' (bukan 'nama_kabupaten') untuk menghindari
     * konflik dengan kolom yang mungkin sudah ada di tabel.
     */
    public function getLabelKabupatenAttribute(): string
    {
        return $this->kabupaten ? $this->kabupaten->nama_kabupaten : '-';
    }

    /**
     * Mendapatkan label nama status (Master Status) dengan fallback.
     * Nama accessor 'label_status_ref' untuk menghindari konflik dengan kolom
     * 'nama_status' yang sudah ada di tabel produsen.
     */
    public function getLabelStatusRefAttribute(): string
    {
        if (!$this->statusRef) {
            return '-';
        }
        $st = $this->statusRef;
        if (isset($st->nama_status)) {
            return $st->nama_status;
        }
        return '-';
    }
}

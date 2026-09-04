<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password',
    'username',
    'role',
    'wewenang_data',
    'id_pegawai',
    'id_satgas',
    'kode_kabupaten',
    'id_komoditas',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function satgas(): BelongsTo
    {
        return $this->belongsTo(Satgas::class, 'id_satgas');
    }

    public function kabupaten(): BelongsTo
    {
        return $this->belongsTo(Kabupaten::class, 'kode_kabupaten');
    }

    public function wewenang(): BelongsTo
    {
        return $this->belongsTo(Komoditas::class, 'id_komoditas');
    }

    /**
     * Daftar role yang dikenal oleh sistem (mengikuti atur_user referensi).
     *
     * @return array<string, string>
     */
    public static function roles(): array
    {
        return [
            'sertifikasi_satgas'     => 'Sertifikasi Satgas',
            'sertifikasi_kabupaten'  => 'Sertifikasi Kabupaten',
            'admin'                  => 'Administrator',
            'produsen'               => 'Produsen',
            'manager'                => 'Manager',
            'kepala_lab'             => 'Kepala Lab',
            'analis_lab'             => 'Analis Lab',
            'pengawas_pengujian'     => 'Pengawas Pengujian',
            'popt'                   => 'POPT',
            'penyuluh'               => 'Penyuluh',
            'kepala_dinas'           => 'Kepala Dinas',
        ];
    }
}

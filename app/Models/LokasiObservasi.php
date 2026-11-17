<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LokasiObservasi extends Model
{
    protected $table = 'lokasi_observasi';

    protected $fillable = [
        'nama_lokasi',
        'alamat',
        'latitude',
        'longitude',
        'tingkat_kegelapan',
        'deskripsi',
        'status',
    ];

    public function kegiatans(): HasMany
    {
        return $this->hasMany(KegiatanObservasi::class, 'lokasi_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Peserta extends Model
{
    protected $table = 'peserta';

    protected $fillable = [
        'nama_peserta',
        'email',
        'no_telepon',
        'instansi',
        'alamat',
    ];

    public function kegiatans(): BelongsToMany
    {
        return $this->belongsToMany(
            KegiatanObservasi::class,
            'kegiatan_peserta',
            'peserta_id',
            'kegiatan_id'
        )->withPivot('status_keikutsertaan')
         ->withTimestamps();
    }
}

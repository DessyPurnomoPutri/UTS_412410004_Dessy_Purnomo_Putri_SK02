<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Perlengkapan extends Model
{
    protected $table = 'perlengkapan';

    protected $fillable = [
        'kode_perlengkapan',
        'nama_perlengkapan',
        'kategori',
        'kondisi',
        'jumlah',
        'satuan',
        'keterangan',
    ];

    public function kegiatans(): BelongsToMany
    {
        return $this->belongsToMany(
            KegiatanObservasi::class,
            'kegiatan_perlengkapan',
            'perlengkapan_id',
            'kegiatan_id'
        )->withPivot('jumlah_digunakan', 'catatan')
         ->withTimestamps();
    }
}

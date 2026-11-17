<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KegiatanObservasi extends Model
{
    protected $table = 'kegiatan_observasi';

    protected $fillable = [
        'lokasi_id',
        'kode_kegiatan',
        'nama_kegiatan',
        'tanggal_observasi',
        'waktu_mulai',
        'waktu_selesai',
        'target_pengamatan',
        'status',
        'deskripsi',
    ];

    public function lokasi(): BelongsTo
    {
        return $this->belongsTo(LokasiObservasi::class, 'lokasi_id');
    }

    public function pesertas(): BelongsToMany
    {
        return $this->belongsToMany(
            Peserta::class,
            'kegiatan_peserta',
            'kegiatan_id',
            'peserta_id'
        )->withPivot('status_keikutsertaan')
         ->withTimestamps();
    }

    public function perlengkapans(): BelongsToMany
    {
        return $this->belongsToMany(
            Perlengkapan::class,
            'kegiatan_perlengkapan',
            'kegiatan_id',
            'perlengkapan_id'
        )->withPivot('jumlah_digunakan', 'catatan')
         ->withTimestamps();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KegiatanObservasi;
use App\Models\LokasiObservasi;
use App\Models\Peserta;
use App\Models\Perlengkapan;
use Illuminate\Support\Facades\DB;

class KegiatanObservasiSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $lokasi = LokasiObservasi::first();

            $kegiatan = KegiatanObservasi::firstOrCreate(
                ['kode_kegiatan' => 'OBS001'],
                [
                    'lokasi_id' => $lokasi->id,
                    'nama_kegiatan' => 'Pengamatan Bulan Purnama',
                    'tanggal_observasi' => '2026-12-05',
                    'waktu_mulai' => '19:00:00',
                    'waktu_selesai' => '22:00:00',
                    'target_pengamatan' => 'Bulan',
                    'status' => 'direncanakan',
                    'deskripsi' => 'Kegiatan pengamatan fase bulan purnama.',
                ]
            );

            $peserta = Peserta::whereIn('email', [
                'andi@gmail.com',
                'siti@gmail.com',
                'budi@gmail.com',
            ])->get();

            foreach ($peserta as $item) {
                $kegiatan->pesertas()->syncWithoutDetaching([
                    $item->id => [
                        'status_keikutsertaan' => 'terdaftar'
                    ]
                ]);
            }

            $perlengkapan = Perlengkapan::whereIn(
                'kode_perlengkapan',
                ['PLK001', 'PLK003', 'PLK005']
            )->get();

            foreach ($perlengkapan as $item) {
                $kegiatan->perlengkapans()->syncWithoutDetaching([
                    $item->id => [
                        'jumlah_digunakan' => 1,
                        'catatan' => 'Digunakan untuk kegiatan pengamatan.',
                    ]
                ]);
            }
        });
    }
}

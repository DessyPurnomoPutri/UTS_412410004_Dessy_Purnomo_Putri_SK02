<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LokasiObservasi;

class LokasiObservasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_lokasi' => 'Observatorium Bosscha',
                'alamat' => 'Lembang, Kabupaten Bandung Barat',
                'latitude' => -6.8242,
                'longitude' => 107.6176,
                'tingkat_kegelapan' => 'Sedang',
                'deskripsi' => 'Lokasi pengamatan astronomi dan penelitian benda langit.',
                'status' => 'aktif',
            ],
            [
                'nama_lokasi' => 'Gunung Bromo',
                'alamat' => 'Taman Nasional Bromo Tengger Semeru, Jawa Timur',
                'latitude' => -7.9425,
                'longitude' => 112.9530,
                'tingkat_kegelapan' => 'Tinggi',
                'deskripsi' => 'Lokasi pengamatan langit malam di kawasan pegunungan.',
                'status' => 'aktif',
            ],
            [
                'nama_lokasi' => 'Pantai Selatan',
                'alamat' => 'Kawasan pesisir selatan Yogyakarta',
                'latitude' => -8.0150,
                'longitude' => 110.3200,
                'tingkat_kegelapan' => 'Tinggi',
                'deskripsi' => 'Lokasi alternatif untuk kegiatan pengamatan bintang.',
                'status' => 'aktif',
            ],
        ];

        foreach ($data as $item) {
            LokasiObservasi::firstOrCreate(
                ['nama_lokasi' => $item['nama_lokasi']],
                $item
            );
        }
    }
}

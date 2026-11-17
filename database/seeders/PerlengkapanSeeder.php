<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perlengkapan;

class PerlengkapanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode_perlengkapan' => 'PLK001',
                'nama_perlengkapan' => 'Teleskop Refraktor',
                'kategori' => 'Teleskop',
                'kondisi' => 'baik',
                'jumlah' => 3,
                'satuan' => 'unit',
                'keterangan' => 'Teleskop untuk pengamatan bulan dan planet.',
            ],
            [
                'kode_perlengkapan' => 'PLK002',
                'nama_perlengkapan' => 'Teleskop Reflektor',
                'kategori' => 'Teleskop',
                'kondisi' => 'baik',
                'jumlah' => 2,
                'satuan' => 'unit',
                'keterangan' => 'Teleskop untuk pengamatan objek langit jauh.',
            ],
            [
                'kode_perlengkapan' => 'PLK003',
                'nama_perlengkapan' => 'Tripod',
                'kategori' => 'Aksesoris',
                'kondisi' => 'baik',
                'jumlah' => 5,
                'satuan' => 'unit',
                'keterangan' => 'Penyangga teleskop.',
            ],
            [
                'kode_perlengkapan' => 'PLK004',
                'nama_perlengkapan' => 'Binokular Astronomi',
                'kategori' => 'Optik',
                'kondisi' => 'baik',
                'jumlah' => 4,
                'satuan' => 'unit',
                'keterangan' => 'Alat bantu pengamatan benda langit.',
            ],
            [
                'kode_perlengkapan' => 'PLK005',
                'nama_perlengkapan' => 'Lampu Senter Merah',
                'kategori' => 'Pendukung',
                'kondisi' => 'baik',
                'jumlah' => 10,
                'satuan' => 'unit',
                'keterangan' => 'Penerangan untuk menjaga adaptasi mata terhadap gelap.',
            ],
        ];

        foreach ($data as $item) {
            Perlengkapan::firstOrCreate(
                ['kode_perlengkapan' => $item['kode_perlengkapan']],
                $item
            );
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peserta;

class PesertaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_peserta' => 'Andi Pratama',
                'email' => 'andi@gmail.com',
                'no_telepon' => '081234567801',
                'instansi' => 'Universitas Indonesia',
                'alamat' => 'Depok, Jawa Barat',
            ],
            [
                'nama_peserta' => 'Siti Rahma',
                'email' => 'siti@gmail.com',
                'no_telepon' => '081234567802',
                'instansi' => 'Universitas Pakuan',
                'alamat' => 'Bogor, Jawa Barat',
            ],
            [
                'nama_peserta' => 'Budi Santoso',
                'email' => 'budi@gmail.com',
                'no_telepon' => '081234567803',
                'instansi' => 'Institut Teknologi Bandung',
                'alamat' => 'Bandung, Jawa Barat',
            ],
            [
                'nama_peserta' => 'Dina Amelia',
                'email' => 'dina@gmail.com',
                'no_telepon' => '081234567804',
                'instansi' => 'Universitas Negeri Jakarta',
                'alamat' => 'Jakarta',
            ],
        ];

        foreach ($data as $item) {
            Peserta::firstOrCreate(
                ['email' => $item['email']],
                $item
            );
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            LokasiObservasiSeeder::class,
            PesertaSeeder::class,
            PerlengkapanSeeder::class,
            KegiatanObservasiSeeder::class,
        ]);
    }
}

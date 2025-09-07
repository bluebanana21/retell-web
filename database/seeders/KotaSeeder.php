<?php

namespace Database\Seeders;

use App\Models\Kota;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kotas = [
            ['nama_kota' => 'Jakarta'],
            ['nama_kota' => 'Bandung'],
            ['nama_kota' => 'Surabaya'],
            ['nama_kota' => 'Yogyakarta'],
            ['nama_kota' => 'Bali'],
            ['nama_kota' => 'Medan'],
            ['nama_kota' => 'Semarang'],
            ['nama_kota' => 'Malang'],
            ['nama_kota' => 'Solo'],
            ['nama_kota' => 'Makassar'],
        ];

        foreach ($kotas as $kota) {
           Kota::firstOrCreate($kota);
        }
    }
}
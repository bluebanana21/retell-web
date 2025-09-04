<?php

namespace Database\Seeders;

use App\Models\DetailKamar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailKamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $detailKamars = [
            [
                'tipe_kamar' => 'reguler',
                'jumlah_kasur' => 1,
                'kapasitas' => 2,
                'fasilitas' => 'AC, TV, WiFi, Kamar Mandi Dalam, Lemari',
                'deskripsi' => 'Kamar reguler dengan fasilitas standar yang nyaman untuk 2 orang'
            ],
            [
                'tipe_kamar' => 'reguler',
                'jumlah_kasur' => 2,
                'kapasitas' => 4,
                'fasilitas' => 'AC, TV, WiFi, Kamar Mandi Dalam, Lemari, Meja Kerja',
                'deskripsi' => 'Kamar reguler dengan 2 kasur untuk keluarga atau grup kecil'
            ],
            [
                'tipe_kamar' => 'deluxe',
                'jumlah_kasur' => 1,
                'kapasitas' => 2,
                'fasilitas' => 'AC, Smart TV, WiFi, Kamar Mandi Dalam, Lemari, Mini Bar, Balkon',
                'deskripsi' => 'Kamar deluxe dengan fasilitas premium dan pemandangan yang indah'
            ],
            [
                'tipe_kamar' => 'deluxe',
                'jumlah_kasur' => 2,
                'kapasitas' => 4,
                'fasilitas' => 'AC, Smart TV, WiFi, Kamar Mandi Dalam, Lemari, Mini Bar, Balkon, Sofa',
                'deskripsi' => 'Kamar deluxe dengan 2 kasur dan ruang yang lebih luas'
            ],
            [
                'tipe_kamar' => 'suite',
                'jumlah_kasur' => 1,
                'kapasitas' => 2,
                'fasilitas' => 'AC, Smart TV, WiFi, Kamar Mandi Dalam, Walk-in Closet, Mini Bar, Balkon, Ruang Tamu, Jacuzzi',
                'deskripsi' => 'Suite mewah dengan ruang terpisah dan fasilitas premium'
            ],
            [
                'tipe_kamar' => 'suite',
                'jumlah_kasur' => 2,
                'kapasitas' => 6,
                'fasilitas' => 'AC, Smart TV, WiFi, Kamar Mandi Dalam, Walk-in Closet, Mini Bar, Balkon, Ruang Tamu, Jacuzzi, Dapur Kecil',
                'deskripsi' => 'Suite keluarga dengan 2 kamar tidur dan fasilitas lengkap'
            ]
        ];

        foreach ($detailKamars as $detail) {
            DetailKamar::firstOrCreate([
                'tipe_kamar' => $detail['tipe_kamar'],
                'jumlah_kasur' => $detail['jumlah_kasur'],
                'kapasitas' => $detail['kapasitas']
            ], $detail);
        }
    }
}
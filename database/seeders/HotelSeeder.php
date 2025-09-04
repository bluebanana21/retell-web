<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\Kota;
use App\Models\Fasilitas;
use App\Models\Kamar;
use App\Models\DetailKamar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotels = [
            [
                'nama_hotel' => 'Grand Hotel Jakarta',
                'deskripsi' => 'Hotel mewah di pusat kota Jakarta dengan fasilitas lengkap dan pelayanan terbaik',
                'rating' => 4.5,
                'kota' => 'Jakarta'
            ],
            [
                'nama_hotel' => 'Bandung Heritage Hotel',
                'deskripsi' => 'Hotel bersejarah dengan arsitektur kolonial yang memukau di Bandung',
                'rating' => 4.2,
                'kota' => 'Bandung'
            ],
            [
                'nama_hotel' => 'Surabaya Business Hotel',
                'deskripsi' => 'Hotel bisnis modern dengan fasilitas meeting dan conference yang lengkap',
                'rating' => 4.3,
                'kota' => 'Surabaya'
            ],
            [
                'nama_hotel' => 'Yogya Palace Hotel',
                'deskripsi' => 'Hotel dengan nuansa budaya Jawa yang kental di jantung kota Yogyakarta',
                'rating' => 4.4,
                'kota' => 'Yogyakarta'
            ],
            [
                'nama_hotel' => 'Bali Beach Resort',
                'deskripsi' => 'Resort tepi pantai dengan pemandangan laut yang menakjubkan',
                'rating' => 4.8,
                'kota' => 'Bali'
            ]
        ];

        foreach ($hotels as $hotelData) {
            $kota = Kota::where('nama_kota', $hotelData['kota'])->first();
            
            if ($kota) {
                $hotel = Hotel::firstOrCreate([
                    'nama_hotel' => $hotelData['nama_hotel']
                ], [
                    'deskripsi' => $hotelData['deskripsi'],
                    'rating' => $hotelData['rating'],
                    'kota_id' => $kota->id
                ]);

                // Attach random fasilitas to hotel
                $fasilitasIds = Fasilitas::inRandomOrder()->limit(rand(5, 8))->pluck('id');
                $hotel->fasilitas()->sync($fasilitasIds);

                // Create rooms for each hotel
                $this->createRoomsForHotel($hotel);
            }
        }
    }

    private function createRoomsForHotel($hotel)
    {
        $detailKamars = DetailKamar::all();
        
        foreach ($detailKamars as $detail) {
            // Create 3-5 rooms for each room type
            $roomCount = rand(3, 5);
            
            for ($i = 1; $i <= $roomCount; $i++) {
                $basePrice = match($detail->tipe_kamar) {
                    'reguler' => rand(300000, 500000),
                    'deluxe' => rand(600000, 900000),
                    'suite' => rand(1000000, 1500000),
                };

                Kamar::firstOrCreate([
                    'id_hotel' => $hotel->id,
                    'detail_id' => $detail->detail_id,
                    'lantai' => rand(1, 5)
                ], [
                    'harga_per_malam' => $basePrice,
                    'status' => 'tersedia'
                ]);
            }
        }
    }
}
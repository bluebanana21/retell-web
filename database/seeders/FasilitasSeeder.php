<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fasilitas = [
            [
                'nama_fasilitas' => 'WiFi Gratis',
                'deskripsi' => 'Akses internet nirkabel gratis di seluruh area hotel',
                'icon' => 'wifi'
            ],
            [
                'nama_fasilitas' => 'Kolam Renang',
                'deskripsi' => 'Kolam renang outdoor dengan pemandangan indah',
                'icon' => 'swimming-pool'
            ],
            [
                'nama_fasilitas' => 'Restoran',
                'deskripsi' => 'Restoran dengan berbagai pilihan menu lokal dan internasional',
                'icon' => 'restaurant'
            ],
            [
                'nama_fasilitas' => 'Spa & Wellness',
                'deskripsi' => 'Layanan spa dan wellness untuk relaksasi',
                'icon' => 'spa'
            ],
            [
                'nama_fasilitas' => 'Fitness Center',
                'deskripsi' => 'Pusat kebugaran dengan peralatan modern',
                'icon' => 'fitness'
            ],
            [
                'nama_fasilitas' => 'Parkir Gratis',
                'deskripsi' => 'Area parkir gratis untuk tamu hotel',
                'icon' => 'parking'
            ],
            [
                'nama_fasilitas' => 'AC',
                'deskripsi' => 'Pendingin ruangan di semua kamar',
                'icon' => 'air-conditioning'
            ],
            [
                'nama_fasilitas' => 'Room Service',
                'deskripsi' => 'Layanan kamar 24 jam',
                'icon' => 'room-service'
            ],
            [
                'nama_fasilitas' => 'Laundry',
                'deskripsi' => 'Layanan laundry dan dry cleaning',
                'icon' => 'laundry'
            ],
            [
                'nama_fasilitas' => 'Business Center',
                'deskripsi' => 'Pusat bisnis dengan fasilitas meeting room',
                'icon' => 'business'
            ]
        ];

        foreach ($fasilitas as $item) {
            Fasilitas::create($item);
        }
    }
}
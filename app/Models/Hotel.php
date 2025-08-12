<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    protected $table = 'hotel';

    protected $fillable = [
        'nama_hotel',
        'deskripsi',
        'fasilitas',
        'rating',
        'kota_id'
    ];

    protected $casts = [
        'rating' => 'float',
    ];

    public function kota(): BelongsTo
    {
        return $this->belongsTo(Kota::class, 'kota_id');
    }

    public function hotelImages(): HasMany
    {
        return $this->hasMany(HotelImages::class, 'hotel_id');
    }

    public function kamars(): HasMany
    {
        return $this->hasMany(Kamar::class, 'id_hotel');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'id_hotel');
    }
}

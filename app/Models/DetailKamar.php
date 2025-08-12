<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetailKamar extends Model
{
    protected $table = 'detail_kamars';
    protected $primaryKey = 'detail_id';

    protected $fillable = [
        'tipe_kamar',
        'jumlah_kasur',
        'kapasitas',
        'fasilitas',
        'deskripsi'
    ];

    protected $casts = [
        'jumlah_kasur' => 'integer',
        'kapasitas' => 'integer',
    ];

    public function kamars(): HasMany
    {
        return $this->hasMany(Kamar::class, 'detail_id', 'detail_id');
    }
}

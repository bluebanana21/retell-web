<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kamar extends Model
{
    protected $table = 'kamars';
    protected $primaryKey = 'id_kamar';

    protected $fillable = [
        'id_hotel',
        'detail_id',
        'harga_per_malam',
        'lantai',
        'status'
    ];

    protected $casts = [
        'harga_per_malam' => 'integer',
        'lantai' => 'integer',
    ];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class, 'id_hotel');
    }

    public function detailKamar(): BelongsTo
    {
        return $this->belongsTo(DetailKamar::class, 'detail_id', 'detail_id');
    }

    public function kamarImages(): HasMany
    {
        return $this->hasMany(KamarImages::class, 'kamar_id', 'id_kamar');
    }

    public function reservasis(): HasMany
    {
        return $this->hasMany(Reservasi::class, 'kamar_id', 'id_kamar');
    }
}

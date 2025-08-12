<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KamarImages extends Model
{
    protected $table = 'kamar_images';
    protected $primaryKey = 'image_id';

    protected $fillable = [
        'image_url',
        'kamar_id'
    ];

    public function kamar(): BelongsTo
    {
        return $this->belongsTo(Kamar::class, 'kamar_id', 'id_kamar');
    }
}

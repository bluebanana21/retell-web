<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kota extends Model
{
    protected $table = 'kotas';

    protected $fillable = [
        'nama_kota'
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    public function hotels(): HasMany
    {
        return $this->hasMany(Hotel::class, 'kota_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HotelImages extends Model
{
    protected $table = 'hotel_images';
    protected $primaryKey = 'image_id';

    protected $fillable = [
        'image_url',
        'hotel_id'
    ];
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($hotelImage) {
            if (request()->hasFile('image')) {
                $hotelImage->image_url = request()->file('image')->store('hotel-images', 'public');
            }
        });
        
        static::updating(function ($hotelImage) {
            if (request()->hasFile('image')) {
                // Delete old image if it's not a URL
                if ($hotelImage->image_url && !filter_var($hotelImage->image_url, FILTER_VALIDATE_URL)) {
                    Storage::disk('public')->delete($hotelImage->image_url);
                }
                $hotelImage->image_url = request()->file('image')->store('hotel-images', 'public');
            }
        });
        
        static::deleting(function ($hotelImage) {
            // Delete image file if it's not a URL
            if ($hotelImage->image_url && !filter_var($hotelImage->image_url, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($hotelImage->image_url);
            }
        });
    }
    
    public function getImageUrlAttribute($value)
    {
        // If it's already a full URL, return it as is
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }
        
        // If it's a local path, prepend the storage URL
        if ($value) {
            return Storage::url($value);
        }
        
        // Return default image if no image is set
        return 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
    }

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}
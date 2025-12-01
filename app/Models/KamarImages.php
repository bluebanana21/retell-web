<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
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
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($kamarImage) {
            if (request()->hasFile('image')) {
                $kamarImage->image_url = request()->file('image')->store('kamar-images', 'public');
            }
        });
        
        static::updating(function ($kamarImage) {
            if (request()->hasFile('image')) {
                // Delete old image if it's not a URL
                if ($kamarImage->image_url && !filter_var($kamarImage->image_url, FILTER_VALIDATE_URL)) {
                    Storage::disk('public')->delete($kamarImage->image_url);
                }
                $kamarImage->image_url = request()->file('image')->store('kamar-images', 'public');
            }
        });
        
        static::deleting(function ($kamarImage) {
            // Delete image file if it's not a URL
            if ($kamarImage->image_url && !filter_var($kamarImage->image_url, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($kamarImage->image_url);
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

    public function kamar(): BelongsTo
    {
        return $this->belongsTo(Kamar::class, 'kamar_id', 'id_kamar');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Verification extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl('verification_images');
    }
}

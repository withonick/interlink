<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = false;

    protected $fillable = [
        'name',
        'description',
        'short_desc',
        'date',
        'time',
        'members',
        'location',
        'price',
        'socials',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function getAvatarAttribute(){
        return $this->getFirstMediaUrl('event_avatars');
    }

    public function getGalleryAttribute(){
        return $this->getMedia('event_gallery');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'event_members', 'event_id', 'user_id')
            ->withTimestamps();
    }

    public function countEventMembers()
    {
        return $this->users()->count();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $guarded = false;

    public function users(){
        return $this->belongsToMany(User::class, 'users_tags', 'tag_id', 'user_id');
    }

    public function events(){
        return $this->belongsToMany(Event::class, 'events_tags', 'tag_id', 'event_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $fillable = [
        'name',
        'description',
        'short_desc',
        'date',
        'time',
        'user_id',
        'capacity',
        'location',
        'image'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}

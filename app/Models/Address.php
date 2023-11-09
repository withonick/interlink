<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $fillable = [
        'street',
        'zip',
        'city',
        'country',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}

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

    public function model(){
        return $this->morphTo('model', 'model_type', 'model_id');
    }

    public function getLocationAttribute(){
        return $this->country . ', ' . $this->city . ', ' . $this->street;
    }

}

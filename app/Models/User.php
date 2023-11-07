<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $guarded = false;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function markOnline()
    {
        $this->last_seen_at = Carbon::now();
        $this->is_online = true;
        $this->save();
    }
    public function markOffline()
    {
        $this->last_seen_at = Carbon::now();
        $this->is_online = false;
        $this->save();
    }

    public function hobbies(){
        return $this->belongsToMany(Hobby::class, 'users_hobbies', 'user_id', 'hobby_id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements hasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, interactsWithMedia;

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

    protected $data = [
        'created_at',
        'updated_at',
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
        return $this->belongsToMany(Hobby::class, 'users_hobbies', 'user_id', 'hobby_id')
            ->withPivot('description');
    }

    public function getRoleNames(){
        return $this->roles()->pluck('name')->join(', ');
    }

    public function getUserFullName(){
        return $this->firstname . ' ' . $this->surname;
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'users_tags', 'user_id', 'tag_id');
    }

    public function address(){
        return $this->morphOne(Address::class, 'model');
    }

    public function getPronounsAttribute($value){
        return json_decode($value);
    }

    public function getUserAge(){
        $birthdate = Carbon::parse($this->birthday);

        $currentDate = Carbon::now();

        $age = $currentDate->diffInYears($birthdate);

        return $age;
    }


    public function getAvatarAttribute(){
        $profilePicture = $this->getMedia('avatars')->first();
        if (!$profilePicture){
            return '/img/avatar.jpg';
        }
        return $profilePicture->getUrl();
    }

    public function messageSender(){
        return $this->belongsToMany(User::class, 'messenger', 'sender_id', 'receiver_id')
            ->withPivot('message', 'read', 'deleted_by_sender', 'deleted_by_receiver', 'read_at', 'deleted_at', 'sent_at', 'received_at', 'deleted_by_sender_at', 'deleted_by_receiver_at')
            ->withTimestamps();
    }

    public function messageReceiver(){
        return $this->belongsToMany(User::class, 'messenger', 'sender_id', 'receiver_id')
            ->withPivot('message', 'read', 'deleted_by_sender', 'deleted_by_receiver', 'read_at', 'deleted_at', 'sent_at', 'received_at', 'deleted_by_sender_at', 'deleted_by_receiver_at')
            ->withTimestamps();
    }

    public function getUnreadMessagesCount(){
        $count = 0;
        foreach ($this->messageReceiver as $message){
            if (!$message->pivot->read){
                $count++;
            }
        }
        return $count;
    }

    public function likedUsers(){
        return $this->belongsToMany(User::class, 'user_liked', 'user_id', 'liked_user_id')
            ->withTimestamps();
    }

    public function likedByUsers(){
        return $this->belongsToMany(User::class, 'user_liked', 'liked_user_id', 'user_id')
            ->withTimestamps();
    }

    public function dislikedUsers(){
        return $this->belongsToMany(User::class, 'user_disliked', 'user_id', 'disliked_user_id')
            ->withTimestamps();
    }

    public function events(){
        return $this->hasMany(Event::class);
    }

    public function matches(){
        return $this->belongsToMany(User::class, 'matches', 'user_id', 'matched_user_id')
            ->withTimestamps();
    }

}

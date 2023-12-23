<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements hasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, interactsWithMedia, SoftDeletes;

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

    public function getFullNameAttribute(){
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

    public function getAgeAttribute(){
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

    public function sentMessages()
    {
        return $this->hasMany(Messenger::class, 'sender_id', 'id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Messenger::class, 'receiver_id', 'id');
    }

    public function latestMessage()
    {
        return $this->sentMessages->merge($this->receivedMessages)->sortByDesc('created_at')->first();
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

    public function story(){
        return $this->hasOne(Story::class);
    }

    public function getMatchedStoriesAttribute(){
        $stories = collect();
        foreach ($this->matches as $match){
            foreach ($match->stories as $story){
                $stories->push($story);
            }
        }
        return $stories;
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function likedPosts(){
        return $this->belongsToMany(Post::class, 'users_post_likes', 'user_id', 'post_id')
            ->withTimestamps();
    }

    public function getTopFullNameAttribute(){
        if($this->is_verified)
            return $this->firstname . ' ' . $this->surname . '<img style="width: 15px; margin-left: 5px; margin-top: 1px" src="' . asset('assets/images/verified.webp') . '" />';
        else
            return $this->firstname . ' ' . $this->surname;
    }

    public function verification(){
        return $this->hasOne(Verification::class);
    }
}

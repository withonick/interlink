<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnValue;

class HomeController extends Controller
{
    public function index(){
        if (Auth::check()){

            $authUserId = Auth::user()->id;

            $users = User::where(function ($query) use ($authUserId) {
                $query->whereNotIn('id', function ($subquery) use ($authUserId) {
                    $subquery->select('disliked_user_id')
                        ->from('user_disliked')
                        ->where('user_id', $authUserId);
                })->whereNotIn('id', function ($subquery) use ($authUserId) {
                    $subquery->select('liked_user_id')
                        ->from('user_liked')
                        ->where('user_id', $authUserId);
                });
            })->where('id', '!=', $authUserId)->inRandomOrder()->limit(1)->get();

            return view('index', compact('users'));
        }
        return view('welcome');
    }

    public function like($username){
        $user = User::where('username', $username)->firstOrFail();
        Auth::user()->likedUsers()->syncWithoutDetaching($user->id);
        Auth::user()->dislikedUsers()->detach($user->id);
        return redirect()->route('index');
    }

    public function dislike($username){
        $user = User::where('username', $username)->firstOrFail();
        Auth::user()->dislikedUsers()->syncWithoutDetaching($user->id);
        Auth::user()->likedUsers()->detach($user->id);
        return redirect()->route('index');
    }

    public function matches(){
        $likes = Auth::user()->likedByUsers()->get();
        return view('matches.index', compact('likes'));
    }

    public function matchDelete($username){
        $user = User::where('username', $username)->firstOrFail();
        Auth::user()->likedUsers()->detach($user->id);
        return redirect()->route('matches.index');
    }

    public function matchAccept($username){
        $user = User::where('username', $username)->firstOrFail();
        Auth::user()->matches()->attach($user->id);
        Auth::user()->likedByUsers()->detach($user->id);
        return redirect()->route('matches.done', $username);
    }

    public function matchDone(){
        $match = Auth::user()->matches()->first();
        return view('matches.accept', compact('match'));
}

}

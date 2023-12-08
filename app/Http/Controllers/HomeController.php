<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\returnValue;
use function PHPUnit\TestFixture\func;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
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
                })->whereNotIn('id', function ($subquery) use ($authUserId) {
                    $subquery->select('matched_user_id')
                        ->from('matches')
                        ->where('user_id', $authUserId)
                        ->orWhere('matched_user_id', $authUserId);
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
        $stories = Story::where('user_id', '!=', Auth::user()->id)->get();
        return view('matches.index', compact('likes', 'stories'));
    }

    public function matchDelete($username){
        $user = User::where('username', $username)->firstOrFail();
        Auth::user()->likedByUsers()->detach($user->id);
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

    public function contacts(){
        return view('contacts');
    }


    public function search(Request $request)
    {
        $users = User::query()->when($request->input('query'), function ($query, $search) {
            return $query->where('firstname', 'like', "%{$search}%")
                ->orWhere('surname', 'like', "%{$search}%")
                ->orWhere('username', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })->when($request->input('gender'), function ($query, $search) {
            return $query->where('gender', '=', $search);
        })->when($request->input('age_min'), function ($query, $search) {
            return $query->where(DB::raw("EXTRACT(YEAR FROM birthday)"), '<=', date('Y') - $search);
        })->when($request->input('age_max'), function ($query, $search) {
            return $query->where(DB::raw("EXTRACT(YEAR FROM birthday)"), '>=', date('Y') - $search);
        })->when($request->input('country'), function ($query, $search) {
            return $query->whereHas('address', function ($query) use ($search) {
                $query->where('country', $search);
            });
        })->when($request->input('city'), function ($query, $search) {
                return $query->whereHas('address', function ($query) use ($search) {
                $query->where('city','like',  "%{$search}%" );
            });
        })->get();

        $users = $users->reject(function ($user) {
            return $user->id == auth()->id();
        });

        $users = $users->shuffle()->take(1);

        return view('search', compact('users'));
    }
}

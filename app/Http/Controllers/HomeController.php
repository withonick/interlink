<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\returnValue;

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
        return view('matches.index', compact('likes'));
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
        $user = User::query();

        if ($request->filled('query')) {
            $user->where(function ($query) use ($request) {
                $query->where('firstname', 'like', "%{$request->input('query')}%")
                    ->orWhere('surname', 'like', "%{$request->input('query')}%")
                    ->orWhere('username', 'like', "%{$request->input('query')}%")
                    ->orWhere('email', 'like', "%{$request->input('query')}%");
            });
        }

        if ($request->filled('gender')) {
            $user->where('gender', '=', $request->input('gender'));
        }

        if ($request->filled('age_min') && is_numeric($request->input('age_min'))) {
            $minBirthYear = date('Y') - (int)$request->input('age_min');
            $user->where(DB::raw("EXTRACT(YEAR FROM birthday)"), '<=', $minBirthYear);
        }

        if ($request->filled('age_max') && is_numeric($request->input('age_max'))) {
            $maxBirthYear = date('Y') - (int)$request->input('age_max');
            $user->where(DB::raw("EXTRACT(YEAR FROM birthday)"), '>=', $maxBirthYear);
        }

        if ($request->filled('country')) {
            $country = $request->input('country');
            $user->whereHas('address', function ($query) use ($country) {
                $query->where('country', $country);
            });
        }

        if ($request->has('city')) {
            $city = urldecode($request->input('city'));
            $users = User::whereHas('address', function ($query) use ($city) {
                $query->where('city', $city);
            })->get();
        } else {
            $users = User::query()->get();
        }

        $users = $users->reject(function ($user) {
            return $user->id == auth()->id();
        });

        $users = $users->shuffle()->take(1);

        return view('search', compact('users'));
    }
}

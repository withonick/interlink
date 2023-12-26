<?php

namespace App\Http\Controllers;

use App\Enums\Country;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show($username){
        $user = User::where('username', $username)->firstOrFail();
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();
        $hobbies = $user->hobbies()->orderBy('name')->get();
        $events = $user->events()->orderBy('date')->get();
        if(Auth::check() and Auth::user()->username === $username) {
            return view('user.profile', compact('user', 'hobbies', 'posts', 'events'));
        }
        return view('user.profile-public', compact('user', 'hobbies', 'posts', 'events'));
    }

    public function edit($username){
        $user = User::where('username', $username)->firstOrFail();
        $countries = Country::cases();
        if(Auth::check() and Auth::user()->username === $username) {
            return view('user.edit', compact('user', 'countries'));
        }
        return redirect()->route('user.show', $user->username);
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'firstname' => 'string|max:255|nullable',
            'surname' => 'string|max:255|nullable',
            'birthday' => 'date|before:today|nullable',
            'status' => 'string|max:255|nullable',
            'bio' => 'string|nullable',
        ]);

        $validatedData['pronouns'] = [
            'pronouns_1' => $request->pronouns_1,
            'pronouns_2' => $request->pronouns_2,
        ];

        $address = $request->validate([
            'street' => 'string|max:255|nullable',
            'city' => 'string|max:255|nullable',
            'zip' => 'string|max:255|nullable',
            'country' => 'string|max:255|nullable',
        ]);

        $user = auth()->user();
        $user->address()->updateOrCreate([], $address);
        $user->save();
        $user->update($validatedData);

        if ($request->image != null){
            $user->clearMediaCollection('avatars');
            $user->addMediaFromRequest('image')
                ->addCustomHeaders([
                    'ACL' => 'public-read'
                ])
                ->toMediaCollection('avatars');
        }

        return redirect()->route('user.show', $user->username);
    }

    public function storeImages(Request $request){
        $user = auth()->user();
        foreach ($request->images as $image){
            $user->addMedia($image)
                ->addCustomHeaders([
                    'ACL' => 'public-read'
                ])
                ->toMediaCollection('gallery');
        }
        return back();
    }

    public function deleteImage($username, $image){
        $user = User::where('username', $username)->firstOrFail();
        $image = $user->getMedia('gallery')->where('id', $image)->first();
        $user->deleteMedia($image);
        return back();
    }

    public function settings($username){
        $user = User::where('username', $username)->firstOrFail();
        if(Auth::check() and Auth::user()->username === $username) {
            return view('user.settings', compact('user'));
        }
        return redirect()->route('user.show', $user->username);
    }

    public function verify_index($username){
        $user = User::where('username', $username)->firstOrFail();
        if(Auth::check() and Auth::user()->username === $username) {
            return view('user.verify', compact('user'));
        }
        return redirect()->route('user.show', $user->username);
    }

    public function verify(Request $request){
        $user = auth()->user();
        $validatedData = $request->validate([
            'verifications' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user->addMediaFromRequest('verifications')
            ->addCustomHeaders([
                'ACL' => 'public-read'
            ])
            ->toMediaCollection('verifications');
        return redirect()->route('user.settings', $user->username);
    }
}

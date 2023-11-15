<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show($username){
        $user = User::where('username', $username)->firstOrFail();
        $hobbies = $user->hobbies()->orderBy('name')->get();
        if(Auth::check() and Auth::user()->username === $username) {
            return view('user.profile', compact('user', 'hobbies'));
        }
        return view('user.profile-public', compact('user', 'hobbies'));
    }

    public function edit($username){
        $user = User::where('username', $username)->firstOrFail();

        if(Auth::check() and Auth::user()->username === $username) {
            return view('user.edit', compact('user'));
        }
        return redirect()->route('user.show', $user->username);
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'birthday' => 'required|date|before:today',
            'status' => 'string|max:255',
            'bio' => 'string',
        ]);
        $validatedData['pronouns'] = [
            'pronouns_1' => $request->pronouns_1,
            'pronouns_2' => $request->pronouns_2,
        ];


        $address = ['city' => $request->city, 'street' => $request->street, 'country' => $request->country, 'zip' => $request->zip];

        $user = auth()->user();
        $user->address()->updateOrCreate([], $address);
        $user->save();
        $user->update($validatedData);
        if ($request->image != null){
            $user->clearMediaCollection('avatars');
            $user->addMediaFromRequest('image')->toMediaCollection('avatars');
        }

        return redirect()->route('user.show', $user->username);
    }

    public function storeImages(Request $request){
        $user = auth()->user();
        foreach ($request->images as $image){
            $user->addMedia($image)->toMediaCollection('gallery');
        }
        return back();
    }

    public function deleteImage($username, $image){
        $user = User::where('username', $username)->firstOrFail();
        $image = $user->getMedia('gallery')->where('id', $image)->first();
        $user->deleteMedia($image);
        return back();
    }
}

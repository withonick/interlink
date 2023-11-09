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
        if(Auth::check() and Auth::user()->username === $username) {
            return view('user.profile', ['user' => $user]);
        }
        return view('user.profile-public', compact('user'));
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
        ]);
        $user = auth()->user();
        $user->update($validatedData);
        if ($request->image != null){
            $user->clearMediaCollection('avatars');
            $user->addMediaFromRequest('image')->toMediaCollection('avatars');
        }

        return back();
    }
}

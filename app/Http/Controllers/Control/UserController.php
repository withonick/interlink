<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user){
        dd($user->id);
        return view('user.profile', ['user' => $user]);
    }

    public function edit(User $user){
        return view('auth.profile-edit', ['user' => $user]);
    }

public function update(Request $request){
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'birthdate' => 'required|date|before:today',
        ]);

        auth()->user()->update($validatedData);

        return redirect()->route('home');
    }
}

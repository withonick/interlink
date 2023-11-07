<?php

namespace App\Http\Services;

use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Enums\Role;

class AuthService
{
    public function register($validated)
    {
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        $user->assignRole(Role::User->value);
        Auth::login($user);
        $user->markOnline();
    }

    public function editProfile($validated)
    {
        $user = Auth::user();
        $user->update($validated);
    }
}

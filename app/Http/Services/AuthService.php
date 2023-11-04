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
        if (isset($validated['day']) && isset($validated['month']) && [isset($validated['year'])]) {
            $day = $validated['day'];
            $month = $validated['month'];
            $year = $validated['year'];
            $birthdate = new DateTime("$year-$month-$day");
            $validated['birthday'] = $birthdate;
            unset($validated['day']);
            unset($validated['month']);
            unset($validated['year']);
        }
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        $user->assignRole(Role::User->value);
        Auth::login($user);
    }
}

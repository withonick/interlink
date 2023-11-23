<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Gender;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Registration\EmailUsernameRequest;
use App\Http\Requests\Auth\Registration\UserGenderRequest;
use App\Http\Services\AuthService;
use App\Models\Hobby;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create(){
        return view('auth.register-email');
    }

    public function register(EmailUsernameRequest $request, AuthService $service){
        $validatedData = $request->validated();
        $service->register($validatedData);

        return redirect()->route('register.gender');
    }

    public function email(){
        return view('auth.login-email');
    }

    public function gender(){
        return view('auth.gender-select', ['genders' => Gender::cases()]);
    }

    public function storeGender(UserGenderRequest $request){
        Auth::user()->update([
            'gender' => $request->gender,
        ]);

        return redirect()->route('register.hobbies');
    }

    public function hobbies(){
        return view('auth.hobby-select', ['hobbies' => Hobby::all(), 'user' => Auth::user()]);
    }

    public function storeHobbies(Request $request){
        $selectedHobbies = $request->input('hobbies');
        Auth::user()->hobbies()->attach($selectedHobbies);

        return redirect()->route('user.edit', ['username' => Auth::user()->username]);
    }
}

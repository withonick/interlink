<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function register(RegisterRequest $request, AuthService $service){
        $validatedData = $request->validated();
        $service->register($validatedData);

        return redirect()->route('profile.edit');
    }

    public function editProfile(){
        return view('auth.profile-edit');
    }

    public function updateProfile(RegisterRequest $request, AuthService $service){
        $validatedData = $request->validated();
        $service->editProfile($validatedData);

        return redirect()->route('index');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return back();
        }
        return view('auth.login');
    }

    public function login(LoginRequest $request){

        if(Auth::check()){
            return redirect()->intended(url('/profile/'.$request->user()->username));
        }

        if (Auth::attempt($request->validated())) {
            Auth::user()->markOnline();
            if (Auth::user()->hasRole(Role::Admin)) {
                return redirect()->intended(url('/control'));
            }
            return redirect()->intended(url('/profile/'.$request->user()->username));
        }
        return back()->withErrors('Incorrect username or password');
    }

    public function logout(){
        Auth::user()->markOffline();
        Auth::logout();
        return redirect()->route('login.form');
    }
}

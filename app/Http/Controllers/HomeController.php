<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        return view('index');
    }

    public function welcome(){
        return view('welcome');
    }

    public function profile(){
        return view('profile');
    }

    public function profileChanges(ProfileRequest $request){
        // Update the user's profile here
        $user = Auth::user();
        $user->firstname = $request->input('firstname');
        $user->surname = $request->input('surname');
        $user->birthday = $request->input('birthday');

//        if ($request->hasFile('image')) {
//            // Handle image upload and update logic here
//        }

        $user->save();

        return redirect()->route('index')->with('success', 'Profile updated successfully');
    }
}

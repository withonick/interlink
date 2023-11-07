<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
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

        return redirect()->route('gender.form')->with('success', 'Profile updated successfully');
    }

    public function gender(){
        $genders = Gender::all();
        return view('gender', compact('genders'));
    }

    public function genderChanges(Request $request)
    {
        if (auth()->check()) {
            $user = auth()->user();

            $selectedGender = $request->input('gender');

            $user->gender_id = $selectedGender;
            $user->save();

            return redirect('/')->with('success', 'Gender updated successfully');
        }

        return redirect()->back()->with('error', 'User not authenticated');
    }
}

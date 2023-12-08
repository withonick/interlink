<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerificationRequest;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function store(VerificationRequest $request){
        $validated = $request->validated();

        $verification = Auth::user()->verification()->create($validated);

        if ($request->has('file')){
            $verification->addMediaFromRequest('file')->toMediaCollection('verification_files');
        }


        return redirect()->route('user.settings', Auth::user()->username);
    }
}

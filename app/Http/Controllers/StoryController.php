<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoryController extends Controller
{
    public function store(Request $request)
    {
        $story = Story::create([
            'user_id' => Auth::user()->id
        ]);

        $story->addMedia($request->file('story'))
            ->addCustomHeaders([
                'ACL' => 'public-read'
            ])
            ->toMediaCollection('stories');

        return redirect()->route('matches.index');
    }

    public function destroy(Story $story)
    {
           $story->delete();
            return back();
    }
}

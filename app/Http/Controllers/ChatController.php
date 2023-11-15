<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index(){
        $users = Auth::user()->messageReceiver()->get();
        return view('chat.index', compact('users'));
    }

    public function show($username){
        $users = Auth::user()->messageReceiver()->get();
        $messages = DB::table('messenger')
            ->where('sender_id', Auth::id())
            ->where('receiver_id', User::where('username', $username)->firstOrFail()->id)
            ->orWhere('sender_id', User::where('username', $username)->firstOrFail()->id)
            ->where('receiver_id', Auth::id())
            ->orderBy('created_at', 'asc')
            ->get();
        $user = User::where('username', $username)->firstOrFail();
        return view('chat.message', compact('user', 'messages', 'users'));
    }

    public function store(Request $request, $username){
        $validated = $request->validate([
            'message' => 'string|max:255',
        ]);

        $user = User::where('username', $username)->firstOrFail();
        Auth::user()->messageSender()->attach($user->id, ['message' => $validated['message']]);
        return redirect()->route('chat.show', $username);
    }
}

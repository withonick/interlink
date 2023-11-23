<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Messenger;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $latestMessages = User::where('id', '!=', Auth::id())
            ->with(['sentMessages', 'receivedMessages'])
            ->get();

        $latestMessages = $latestMessages->filter(function ($user) {
            return $user->sentMessages->isNotEmpty() || $user->receivedMessages->isNotEmpty();
        });

        $latestMessages = $latestMessages->sortByDesc(function ($user) {
            return optional($user->latestMessage())->created_at;
        });


        return view('chat.index', compact('latestMessages'));
    }

    public function show($username){
        $user = User::where('username', $username)->firstOrFail();
        $messages = Messenger::where('sender_id', Auth::id())
            ->where('receiver_id', $user->id)
            ->orWhere('sender_id', $user->id)
            ->where('receiver_id', Auth::id())
            ->get();

        return view('chat.message', compact('user', 'messages'));
    }

    public function store(Request $request, $username){
        $user = User::where('username', $username)->firstOrFail();
        $message = new Messenger();
        $message->sender_id = Auth::id();
        $message->receiver_id = $user->id;
        $message->sent_at = now();
        $message->message = $request->message;
        $message->save();

        return redirect()->back();
    }
}

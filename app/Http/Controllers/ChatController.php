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

        $sentMessages = $user->sentMessages()->with('receiver')->latest()->get();
        $receivedMessages = $user->receivedMessages()->with('sender')->latest()->get();

        $allMessages = $sentMessages->merge($receivedMessages)->sortByDesc('created_at');

        $groupedMessages = $allMessages->groupBy(function ($message) use ($user) {
            return $message->receiver_id === $user->id ? $message->sender_id : $message->receiver_id;
        });

        $chatList = [];
        foreach ($groupedMessages as $userId => $messages) {
            $lastMessage = $messages->first();
            $otherUser = $lastMessage->receiver_id === $user->id ? $lastMessage->sender : $lastMessage->receiver;

            $chatList[] = [
                'user' => $otherUser,
                'last_message' => $lastMessage,
            ];
        }

        return view('chat.index', compact('chatList'));
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

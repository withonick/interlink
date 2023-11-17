<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RestChatController extends Controller
{
    public function index($username)
    {
        $users = Auth::user()->messageReceiver()->get();
        $messages = DB::table('messenger')
            ->where('sender_id', Auth::id())
            ->where('receiver_id', User::where('username', $username)->firstOrFail()->id)
            ->orWhere('sender_id', User::where('username', $username)->firstOrFail()->id)
            ->where('receiver_id', Auth::id())
            ->orderBy('created_at', 'asc')
            ->get();
        $user = User::where('username', $username)->firstOrFail();

        return response()->json([
            'users' => $users,
            'messages' => $messages,
            'user' => $user
        ]);
    }

    public function getUsers()
    {
        $users = User::all();
        return response()->json([
            'users' => $users
        ]);
    }
}

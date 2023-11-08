<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        return view('control.index');
    }

    public function users()
    {
        return view('control.users.index', [
            'users' => User::orderBy('created_at')->paginate(10)
        ]);
    }

    public function roles()
    {
        return view('control.roles.index',
        ['roles' => Role::all()]);
    }

    public function hobbies()
    {
        return view('control.hobbies.index');
    }

    public function tags()
    {
        return view('control.tags.index',
        ['tags' => Tag::orderBy('name')->paginate(10)]);
    }


}

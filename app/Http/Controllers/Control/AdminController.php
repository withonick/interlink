<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('control.index');
    }
}

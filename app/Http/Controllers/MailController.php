<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SignUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send()
    {
        Mail::to('felikethis@gmail.com')->send(new SignUp());

        return view('welcome');
    }

}

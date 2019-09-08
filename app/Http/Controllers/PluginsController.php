<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PluginsController extends Controller
{
    function sendEmail(){
        $user = User::first();
        $email = Mail::to('ali.omar.alakhras@gmail.com')->send(new TestMail($user));
        dd($email);
    }
}

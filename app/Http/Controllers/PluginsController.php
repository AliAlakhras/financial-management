<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PluginsController extends Controller
{
    function sendEmail(){
        $email = Mail::to('ali.omar.alakhras@gmail.com')->send(new TestMail());
        dd($email);
    }
}

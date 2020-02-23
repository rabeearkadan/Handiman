<?php

namespace App\Http\Controllers;

use App\Mail\contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function contact(Request $request){
        $request->validate(["email" => 'email']);
        Mail::to($request->email)->send(new contact());
        return 'OK';
    }
}

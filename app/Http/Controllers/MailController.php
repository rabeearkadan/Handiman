<?php

namespace App\Http\Controllers;

use App\Mail\contact;
use App\Models\ContactedUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function contact(Request $request)
    {
        $msg = new ContactedUs();
        $msg->subject = $request->input('subject');
        $msg->message = $request->input('message');
        $msg->email = $request->input('email');
        $msg->from = $request->input('name');
        $msg->save();
        $request->validate(["email" => 'email']);
        Mail::to($request->email)->send(new contact());
        return 'OK';
    }

}

<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

class ContactedUsController extends Controller
{

    public function index()
    {
        $messages = \App\Models\ContactedUs::all();
        return view('cms.contact.index', compact('messages'));
    }

}

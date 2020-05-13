<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\ContactedUs;

class ContactedUsController extends Controller
{

    public function index()
    {
        $messages = \App\Models\ContactedUs::all();
        return view('cms.contact.index', compact('messages'));
    }

    public function destroy($id)
    {

        try {
            ContactedUs::query()->find($id)->delete();
        } catch (\Exception $e) {
        }

        return redirect()->route('contact.index');
    }
}

<?php

namespace App\Http\Controllers\FRONT\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index( Request $request ){
        return view ('front.client.home');
    }

    public function service( Request $request ){
        return view ('front.client.services');
    }
}

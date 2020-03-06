<?php

namespace App\Http\Controllers\FRONT\Handyman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index( Request $request ){
        return view ('front.handyman.home');
    }
    public function requests(Request $request){
        return view('front.handyman.');
    }


    public function reviews(Request $request){
        return view('front.handyman.');
    }

}

<?php

namespace App\Http\Controllers\FRONT\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index( Request $request ){
        return view ('front.employee.home');
    }
    public function requests(Request $request){
        return view('front.employee.');
    }


    public function reviews(Request $request){
        return view('front.employee.reviews');
    }

}

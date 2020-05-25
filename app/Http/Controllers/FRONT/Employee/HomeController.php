<?php

namespace App\Http\Controllers\FRONT\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /** Functions
     * index()
     * requests()
     * reviews()
     */

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

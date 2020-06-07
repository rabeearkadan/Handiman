<?php

namespace App\Http\Controllers\FRONT\Employee;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /** Functions
     * index()
     * requests()
     * reviews()
     */

    public function index( Request $request ){
            $posts = Post::orderBy('created_at', 'desc')->take(3)->get();
            $services = Service::all();
        return view ('front.employee.home',compact(['posts', 'services']);
    }
    public function requests(Request $request){
        return view('front.employee.');
    }


    public function reviews(Request $request){
        return view('front.employee.reviews');
    }

}

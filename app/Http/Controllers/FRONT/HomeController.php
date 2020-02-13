<?php

namespace App\Http\Controllers\FRONT;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function contact(){
        //whoever wrote this Puck u
        echo "hi";
    }
    public function getHomePage(){
        $ahmad= User::all();
        $role = Auth::user()->role;
        if($role == 'handyman'){
            return view('handyman.home');
        }
        else if ($role == 'client'){ //choose the naming of users !!!!!
            return view('client.home');
        }
        else{
            // to a view where user chooses
        }
    }
}

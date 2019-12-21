<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function users(){
        return response()->json(['status'=>"success",'users'=>User::all()]);
    }
}

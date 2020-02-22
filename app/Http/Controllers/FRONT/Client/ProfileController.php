<?php

namespace App\Http\Controllers\FRONT\Client;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //



    public function myProfile(){

    }

    public function editProfile(){

    }


    public function userProfile($user_id){
        $user = User::find($user_id);
        return view('employee-profile',$user);
    }
}

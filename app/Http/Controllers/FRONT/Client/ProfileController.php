<?php

namespace App\Http\Controllers\FRONT\Client;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //



    public function myProfile(){
        $user = Auth::user();
        return view('front.client.my-profile', compact('user'));
    }

    public function editProfile(){

    }


    public function userProfile($user_id){
        $user = User::find($user_id);
        return view('front.client.employee-profile', compact('user'));
    }
}

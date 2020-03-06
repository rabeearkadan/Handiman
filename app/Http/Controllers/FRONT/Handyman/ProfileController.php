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
        return view('front.employee.profile.my-profile', compact('user'));
    }
    public function editPassword(){

    }
    public function editPayment(){
        $user = Auth::user();
        return view('front.client.profile.payment', compact('user'));
    }

    public function editProfile(){

    }


    public function clientProfile($id){

    }
}

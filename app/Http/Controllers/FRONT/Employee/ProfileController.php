<?php

namespace App\Http\Controllers\FRONT\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function myProfile(){
        $user = Auth::user();
        return view('front.employee.profile.edit-profile', compact('user'));
    }
    public function editPassword(){

    }
    public function editPayment(){
        $user = Auth::user();
        return view('front.employee.profile.payment', compact('user'));
    }

    public function editProfile(){

    }


    public function clientProfile($id){

    }
    public function editSchedule(){

        return view('front.employee.profile.schedule');
    }
    public function updateSchedule(){

    }

}

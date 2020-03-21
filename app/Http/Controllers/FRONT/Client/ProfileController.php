<?php

namespace App\Http\Controllers\FRONT\Client;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function myProfile(){
        $user = Auth::user();
        return view('front.client.profile.edit-profile', compact('user'));
    }
    public function editPassword(){
        $user = Auth::user();
        return view('front.client.profile.password', compact('user'));
    }
    public function editPayment(){
    $user = Auth::user();
    return view('front.client.profile.payment', compact('user'));
    }

    public function editProfile(){

    }


    public function employeeProfile($id, $employee_id){
        $service = Service::find($id);
        $employee = User::find($employee_id);
        return view('front.client.employee-profile', compact(['employee','service']));
    }
}

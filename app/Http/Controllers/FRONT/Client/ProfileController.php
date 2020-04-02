<?php

namespace App\Http\Controllers\FRONT\Client;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
    public function addAddress(Request $request){
        $user = Auth::user();
        $data = [
            "_id" => Str::random(24),
            "type"=> $request->type,
            "location" => [$request->lat,$request->lng] ,
            "street" => $request->street ,
            "house" => $request->house,
            "zip" => $request->zip,
            "property_type" => $request->property,
            "contract_type" => $request->contract,
        ];
        $user->push('client_addresses',$data);
        $user->save();
        return view('front.client.profile.edit-profile', compact('user'));
    }
    public function editAddress(){
        $user = Auth::user();
       // $user->push('locations', '');
        return view('front.client.profile.edit-profile', compact('user'));
    }
    public function editProfile(){

    }


    public function employeeProfile($id, $employee_id){
        $service = Service::find($id);
        $employee = User::find($employee_id);
        return view('front.client.employee-profile', compact(['employee','service']));
    }
    public function allReviews($id, $employee_id){
        $employee = User::find($employee_id);
        return view('front.client.see-all-reviews',compact('employee'));
    }
}

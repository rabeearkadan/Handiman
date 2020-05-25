<?php

namespace App\Http\Controllers\FRONT\Client;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

    // functions for Client Addresses
    public function createAddress(Request $request){
        $user = Auth::user();

        return view('front.client.profile.create-address', compact('user'));
    }

    public function storeAddress(Request $request){
        $user = Auth::user();
        $data = [
            "_id" => Str::random(24),
            "name" => $request->name,
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
        $user = Auth::user();
        return view('front.client.profile.edit-profile', compact('user'));
    }

    public function editAddress($id){
        $user = Auth::user();
        $address = null;
        foreach($user->client_addresses as $client_address) {
            if ($client_address['_id'] == $id) {
                $address = $client_address;
             break;
    }
}
        return view('front.client.profile.edit-address', compact(['user','address']));
    }

    public function updateAddress($id){
        $user = Auth::user();
       // $user->push('locations', '');
        return view('front.client.profile.edit-profile', compact('user'));
    }



    //end of functions for Client addresses
    public function updateImage(Request $request){
        $user = Auth::user();
        // $user->push('locations', '');
        $user->image = $this->uploadAny($request->file('image-input'),'profile');
        $user->save();
        dd($user,$request->file('image-input'));
        return view('front.client.profile.edit-profile', compact('user'));
    }
    public function uploadAny($file, $folder, $ext = 'png')
    {
        $file = base64_decode($file);

        $file_name = Str::random(25) . '.' . $ext; //generating unique file name;
        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }
        $result = false;
        if ($file != "") { // storing image in storage/app/public Folder
            $result = Storage::disk('public')->put($folder . '/' . $file_name, $file);

        }
        if ($result)
            return $folder . '/' . $file_name;
        else
            return null;
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

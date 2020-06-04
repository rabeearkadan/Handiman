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
    /** Functions
     * myProfile()
     * editPassword()
     * editPayment()
     * updateImage()
     * destroyImage()
     * updateContact()
     * createAddress()
     * storeAddress()
     * editAddress()
     * updateAddress()
     * destroyAddress()
     * employeeProfile()
     * allReviews()
     */

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
    //Client Profile Image
    public function updateImage(Request $request){
        $user = Auth::user();
        $file = $request->file('image-input');
        $name = 'image_' . time() . '.' . $file->getClientOriginalExtension();
        if (!Storage::disk('public')->exists('profile')) {
            Storage::disk('public')->makeDirectory('profile');
        }
        if (Storage::disk('public')->putFileAs('profile', $file, $name)) {
            $user->image = 'profile/' . $name;
        } else {
            return view('front.client.profile.edit-profile', compact('user'));
        }
        $user->save();
        return redirect()->route('client.profile');
    }
    public function destroyImage(){
        $user = Auth::user();
        $user->image = "";
        $user->save();
        return redirect()->route('client.profile');
    }

    //Client Contact Information
    public function updateContact(Request $request){
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        return redirect()->route('client.profile');
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
        return redirect()->route('client.profile');
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
    public function destroyAddress($id){
        $user = Auth::user();
        // $user->push('locations', '');
        return view('front.client.profile.edit-profile', compact('user'));
    }
    //end of functions for Client addresses


    //functions for employee Profiles

    public function employeeProfile($id, $employee_id){
        $service = Service::find($id);
        $employee = User::find($employee_id);
        dd($employee,$employee->rating_object,$employee->feedback_object);
        return view('front.client.employee-profile', compact(['employee','service']));
    }
    public function allReviews($id, $employee_id){
        $employee = User::find($employee_id);
        return view('front.client.see-all-reviews',compact('employee'));
    }
}

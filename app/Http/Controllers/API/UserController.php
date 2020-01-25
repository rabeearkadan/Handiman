<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class UserController extends Controller
{
    //

    public function setDeviceToken(Request $request)
    {
        $user = Auth::user();

        //validate request

        $params = $this->validate($request, ['device_token' => 'required', 'device_platform' => 'required']);

        $user->device_token = $params['device_token'];
        $user->device_platform = $params['device_platform'];
        $user->save();

        return response()->json(['status' => 'success']);

    }

    public function getProfile()
    {
        $user = auth::user();
        $user = User::query()->where('id', $user->id)->get();
        return response()->json(['status' => 'success', 'profile' => $user]);

    }

    function updateProfile(Request $request)
    {
        $user = Auth::user();
        if ($user->isClient()) {

            $params = $this->validate($request, ['profile_picture' => 'required', 'phone' => 'required', 'location' => 'required',
                'birth_date' => 'required', 'gender' => 'required', 'time_preferences_start' => 'required', 'time_preferences_end' => 'required', 'payment_method' => 'required',
                'apartment_details' => 'required']);

            $user->profile_picture = base64_encode($params['profile_picture']);

            // index
            $user->location = $params['location'];

            $user->phone = $params['phone'];
            $user->birth_date = $params['birth_date'];
            $user->gender = $params['gender'];
            $user->time_preferences_start = $params['time_preferences_start'];
            $user->time_preferences_end = $params['time_preferences_end'];

            $user->save();

            return response()->json(['status' => 'success', 'user' => $user]);


        } else if ($user->isHandyman()) {

            $params = $this->validate($request, ['profile_picture' => 'required', 'phone' => 'required',
                'location' => 'required',
                'birth_date' => 'required', 'gender' => 'required', 'services' => 'required', 'available_time_begin' => 'required'
                , 'available_time_end' => 'required', 'price' => 'required', 'cv' => 'required', 'criminal_record' => 'required', 'bank_account' => 'required']);


            $file_name = $this->uploadAny($params['profile_picture'], 'uploads');
            $user->profile_picture = $file_name;


            // index
            $user->location = $params['location'];

            $user->phone = $params['phone'];
            // date form
            $user->birth_date = $params['birth_date'];

            $user->gender = $params['gender'];

            //array of services
            $user->services = $params['services'];
            // time format
            $user->available_time_begin = $params['available_time_begin'];

            $user->available_time_end = $params['available_time_end'];
            $user->price = $params['price'];

            //array of certificates
            $user->certificates = $params['certificates'];

            //pdf
            $user->cv = $params['cv'];

            //pdf
            $user->criminal_record = $params['criminal_record'];

            $user->bank_account = $params['bank_account'];

            $user->save();

            return response()->json(['status' => 'success', 'user' => $user]);

        } else if ($user->isAdmin()) {

        }


    }

    public function logout(Request $request)
    {
        auth::logout();

        //Todo
        // auth::logoutOtherDevices(request('password'));
        return response()->json(['status' => 'success', 'message' => 'logged out']);
    }

    public function uploadAny($file, $folder)
    {
        $file = base64_decode($file);
        $file_name = str_random(25) . '.png'; //generating unique file name;
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
    /*
     */
}

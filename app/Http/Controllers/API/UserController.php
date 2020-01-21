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

    function updateProfile(Request $request)
    {

        $user = Auth::user();
        if ($user->isClient()) {

        } else if ($user->isHandyman()) {
            $params = $this->validate($request, ['profile_picture' => 'required', 'phone' => 'required', 'location' => 'required',
                'birth_date' => 'required', 'gender' => 'required', 'time_preferences' => 'required']);


            //  uri
            $user->profile_picture = $params['profile_picture'];
            // index
            $user->location = $params['location'];

            $user->phone = $params['phone'];
            $user->birth_date = $params['birth_date'];
            $user->gender = $params['gender'];
            $user->time_preferences = $params['time_preferences'];

            $user->save();

            return response()->json(['status' => 'success', 'user' => $user]);

        } else if ($user->isAdmin()) {

        }


    }


}

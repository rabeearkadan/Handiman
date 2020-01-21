<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class HandymanController extends Controller
{
    //
    function updateProfile(Request $request)
    {

        $user = Auth::user();

        $params = $this->validate($request, ['profile_picture' => 'required', 'phone' => 'required', 'location' => 'required',
            'birth_date' => 'required', 'gender' => 'required', 'time_preferences' => 'required']);

        $user->profile_picture = $params['profile_picture'];
        $user->phone = $params['phone'];
        $user->location = $params['location'];
        $user->birth_date = $params['birth_date'];
        $user->gender = $params['gender'];
        $user->time_preferences = $params['time_preferences'];
        $user->save();

        return response()->json(['status' => 'success']);
    }
}

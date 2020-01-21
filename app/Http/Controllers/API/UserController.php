<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class UserController extends Controller
{
    //

    public function setDeviceToken(Request $request){
        $user = Auth::user();

        //validate request

        $params = $this->validate( $request, ['device_token'=>'required','device_platform'=> 'required']);

        $user->device_token = $params['device_token'];
        $user->device_platform = $params['device_platform'];
        $user->save();

        return response()->json(['status'=>'success']);

    }




}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use  App\Models\RequestService;

use Illuminate\Http\Request;


class RequestController extends Controller
{
    //
    public function requestAny(Request $request)
    {
//        $params = $this->validate($request, [
//            'description' => 'required'
//        ]);
        //first we need to know if the request is for a specific handyman
        // or if the user want the system suggestion
        $params = $this->validate($request, [
            'date' => 'required']);


        //09:00 Tues (1)
//        $user = User::query()->where('role', 'employee')
//            ->where('location','..')
//            ->where('blabla','111')
//            ->where('translations.'.session()->get('locale','en').'.name','111')
//            ->where('timeline.1.09:00',false)->first();


    }

    public function requestHandyman(){

    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use  App\Models\RequestService;

use Illuminate\Http\Request;


class RequestController extends Controller
{
    //
    public function addRequest()
    {
        $request = new  Request();
//        $params = $this->validate($request, [
//            'description' => 'required'
//        ]);
        //first we need to know if the request is for a specific handyman
        // or if the user want the system suggestion

    }
}

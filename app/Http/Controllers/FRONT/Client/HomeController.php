<?php

namespace App\Http\Controllers\FRONT\Client;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index( Request $request ){
        return view ('front.client.home');
    }

    public function service( Request $request , $id = null){
        if ( $id == null ){
            $services = Service::all();
            return view ('front.client.services', compact('services'));
        }else{
            $service = Service::query()->find($id);
            return view ('front.client.service-users', compact('service'));
        }

    }
}

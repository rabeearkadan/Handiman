<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //


    public function addService($request)
    {

        $service = new service();
        $service->service = $request->input('service');
        $service->save();
        return response()->json(['status' => 'success']);


    }

    public function getServices()
    {
        $services = Service::query()->get();
        return response()->json(['status' => 'success', 'services' => $services]);

    }


}

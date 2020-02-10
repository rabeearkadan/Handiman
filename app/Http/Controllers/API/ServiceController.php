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
    // hayde 3amela la raje3 live data eza bdak


    //sorry again  ik 3ashen json :p // so hyde l function not for cms its for api
    // rabee ana keteba as a json la jareba bas heye fe3leyan lal admin w bda traje view ma3 data

    public function getServices()
    {
        $services = Service::query()->get();
        return response()->json(['status' => 'success', 'services' => $services]);

    }


}

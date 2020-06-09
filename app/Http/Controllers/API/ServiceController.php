<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\User;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    //


    public function addService($id)
    {
        $service = Service::query()->find($id);
        $user = User::query()->find(Auth::id());

        $service->users()->attach(Auth::id());
        $user->services()->attach($id);
        return response()->json(['status' => 'success']);


    }

    public function deleteService($id)
    {

        $user = User::query()->find(Auth::id());
        $service = Service::query()->find($id);
        $service->users()->detach(Auth::id());
        $user->services()->detach($id);
        return response()->json(['status' => 'success']);


    }

    public function getServices()
    {
        $services = Service::query()->get();
        return response()->json(['status' => 'success', 'services' => $services]);

    }


}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    //


    public function addService($id)
    {
        $service = Service::query()->find($id);
        $user = User::query()->find(Auth::id());

        $user_id = $service->user_ids;
        array_push($user_id, $user->id);
        $service->user_ids = $user_id;
        $service->save();

        $service_ids = $user->service_ids;
        array_push($service_ids, $id);
        $user->service_ids = $service_ids;
        $user->save();

        return response()->json(['status' => 'success']);


    }

    public function getServices()
    {
        $services = Service::query()->get();
        return response()->json(['status' => 'success', 'services' => $services]);

    }


}

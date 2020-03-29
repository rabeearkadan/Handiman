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

    public function deleteService($id)
    {

        $user = User::query()->find(Auth::id());

        $service_ids_in_user = $user->service_ids;
        $key = 0;

        for ($i = 0; $i < sizeof($user->service_ids); $i++) {
//          dd($service_ids_in_user[$i]);
            if ($service_ids_in_user[$i] === $id) {
                $key = $i;
                // dd($key);
            }
        }
        unset($service_ids_in_user[$key]);
        $user->service_ids = $service_ids_in_user;
        $user->save();


        $service = Service::query()->findOrFail($id);
        dd($service->user_ids);
        $user_ids_in_service = $service->user_ids;
        $key = 0;
        for ($i = 0; $i < sizeof($user_ids_in_service); $i++) {
            if ($user_ids_in_service[$i] == $user->id) {
                $key = $i;
            }
        }
        unset($user_ids_in_service[$key]);
        $service->user_ids = $service_ids_in_user;
        $service->save();


        return response()->json(['status' => 'success']);


    }

    public function getServices()
    {
        $services = Service::query()->get();
        return response()->json(['status' => 'success', 'services' => $services]);

    }


}

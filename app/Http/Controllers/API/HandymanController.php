<?php

namespace App\Http\Controllers\API;

use App\Events\NotificationSenderEvent;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;

class HandymanController extends Controller
{
    //

    public function test()
    {
        $notification = array();

        $notification['to'] = 'd4PngEqIj-I:APA91bEq7B9CIzTERYwqwPb-Kn0uUNeLbCl17VllZAmomklcbOmd2kX9jv1R9uWJu9jvPrcAhJ-J5uSaGbgemLe651eUQARGYi5gc03KuBlOwg0NXt8vHpYD5_kkCPStIzeEHQuwQA_S';
        $notification['user'] = "admin";
        $notification['message'] = "test";
        $notification['type'] = 'comment';
        $notification['object'] = [];

        event(new NotificationSenderEvent($notification));
    }

    public function getHandyman()
    {

        $handymanList =
            User::query()->
            where('role', 'employee')->
            where('isApproved', true)->get();

        return response()->json(['status' => 'success', 'HandymanList' => $handymanList]);
    }


    public function getHandymanById($id)
    {

        $handyman = User::whereHas('roles', function ($query) {
            $query->where('role', 'employee');
        })->where('_id', 'LIKE', $id)
            ->get();
        return response()->json(['status' => 'success', 'HandymanList' => $handyman]);
    }


}

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

    public function test(){
        $notification = array();

        $notification['to'] = 'all';
        $notification['user']= Auth::user();
        $notification['message'] ="test";
        $notification['type'] = 'comment';
        $notification['object'] = [];

        event( new NotificationSenderEvent($notification));
    }

    public function getHandyman()
    {

        $handymanList = User::query()->where('role', 'employee')->get();

        return response()->json(['status' => 'success', 'HandymanList' => $handymanList]);
    }



    public function getHandymanById($id)
    {

        $handyman = User::whereHas('roles', function ($query) {
            $query->where('role', 'employee');
        })->where('name', 'LIKE', $id)
            ->get();
        return response()->json(['status' => 'success', 'HandymanList' => $handyman]);
    }

    public function addPost(Request $request)
    {

    }

}

<?php

namespace App\Http\Controllers\API;

use App\Events\NotificationSenderEvent;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;

class HandymanController extends Controller
{
    //
    private static function getID($collection)
    {

        $seq = \DB::getCollection('posts')->findOneAndUpdate(
            array('_id' => $collection),
            array('$inc' => array('seq' => 1)),
            array('new' => true, 'upsert' => true, 'returnDocument' => \MongoDB\Operation\FindOneAndUpdate::RETURN_DOCUMENT_AFTER)
        );
        return $seq->seq;
    }



    public function test()
    {
        $notification = array();


        $notification['to'] = 'dT5Brv8QrJo:APA91bHAPBYNHJUSUbY_X9yzVmTIjbazslmJ831oc4mgvlnX5F1tJDzsuJT8ISOE4u6VVz752q1pHxzXvdOq9PbKRTtFaoLN_C6MDGXMyJIpUCE1Ay5tQ3eXsEewzNMIhDzJl0z-Xd5L';

        $notification['user'] = "admin";
        $notification['message'] = "test";
        $notification['type'] = 'comment';// maybe "notification", "comment(message)", "request","message"
        $notification['object'] = [];

        event(new NotificationSenderEvent($notification));

        return response()->json(['status' => 'success', 'notification' => $notification]);
    }

    public function getHandyman()
    {

        $handymanList =
            User::query()->
            where('role', 'employee')
                ->orWhere('role', 'user_employee')
                ->where('isApproved', true)->get();

        return response()->json(['status' => 'success', 'HandymanList' => $handymanList]);
    }

    public function getHandymenByService($id)
    {
        $list = Service::query()->where('isApproved', true)->findOrFail($id);
        $service = $list->users;
        return response()->json(['status' => 'success', 'HandymanList' => $service]);


    }

    public function getHandymanByLocation($longitude, $latitude)
    {
        $handymanList = User::query()
            ->where('role', 'employee')
            ->orWhere('role', 'user_employee')
            ->where('isApproved', true)
            ->where('location', 'near', [
                '$geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        $longitude,
                        $latitude,
                    ],
                    '$maxDistance' => 50,
                ],
            ])->get();
        return response()->json(['status' => 'success', 'HandymanList' => $handymanList]);
    }

    public function getHandymanOrderedByPrice()
    {
        $handymanList = User::query()
            ->where('role', 'handyman')
            ->where('isApproved', true)
            ->orderBy('price', 'desc')
            ->get();
    }


    public function getHandymanById($id)
    {

        $handyman = User::query()->findOrFail($id);
        return response()->json(['status' => 'success', 'HandymanList' => $handyman]);
    }



}

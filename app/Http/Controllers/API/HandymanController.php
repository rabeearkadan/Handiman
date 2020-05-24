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
                ->orderBy('rating')
                ->where('isApproved', true)->get();

        return response()->json(['status' => 'success', 'HandymanList' => $handymanList]);
    }

    public function getHandymenByService($id)
    {
        $list = Service::query()->where('_id', $id)->first();
        if ($list == null)
            return response()->json(['status' => 'error', 'message' => "no service found"]);
        $users = $list->users()->where('isApproved', true)->get();


        $price = array();
        foreach ($users as $key => $row) {
            $price[$key] = $row['price'];
        }
        array_multisort($price, SORT_DESC, $users[]);

        return response()->json(['status' => 'successful', 'handymen' => $users, 'sorted' => $price]);


    }

    public function getHandymanByLocation(Request $request)
    {

//        $handymanList = User::where('location', 'near', [
//            '$geometry' => [
//                'type' => 'Point',
//                'coordinates' => [
//                    35.4836967587471, // longitude
//                    35.49547959999999,
//                ],
//            ],
//            '$maxDistance' => 50,
//        ])->get();

        $handymanList = User::query()
            ->where('role', 'user_employee')
            ->orWhere('role', 'employee')
            ->where('isApproved', true)
            ->where('location', 'near', [
                '$geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        (float)$request->input('longitude'),
                        (float)$request->input('latitude'),
                    ],
                    'distanceField' => "dist.calculated",
                    '$maxDistance' => 50,
                ],
            ])->orderBy('dist.calculated')
            ->get();
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

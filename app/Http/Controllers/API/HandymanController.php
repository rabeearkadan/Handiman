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

    public function addPost(Request $request)
    {
        $post = new Post();
        $post->_id = self::getID(posts);

        $post->post_text = ['post_text'];
        $post->save();

        return response()->json(['status' => 'success', 'post' => $post]);
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
//       $service =Service::query()->find($id);
        $x = Service::findOrFail($id);
        $service = $x->users;
        return response()->json(['status' => 'success', 'HandymanList' => $service]);


    }

    public function getHandymanByLocation($longitude, $latitude)
    {

        // ur thought?
        $handymanList = User::query()->where('location', 'near', [
            '$geometry' => [
                'type' => 'Point',
                'coordinates' => [
                    $longitude, // longitude
                    $latitude, // latitude
                ],
                //max distance 50km
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

        $handyman = User::whereHas('roles', function ($query) {
            $query->where('role', 'employee');
        })->where('_id', 'LIKE', $id)
            ->get();
        return response()->json(['status' => 'success', 'HandymanList' => $handyman]);
    }
public function  getPlumbers(){

}

}

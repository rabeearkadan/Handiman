<?php

namespace App\Http\Controllers\API;

use App\Events\NotificationSenderEvent;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

use App\Models\Notification;

class NotificationController extends Controller
{
    //

    public function test($user_id, $isClient)
    {
        $notification = array();

        $user = User::query()->find($user_id);

        $notification['to'] = $isClient == 1?$user->client_device_token:$user->empolyee_device_token;
        $notification['user'] = "admin";
        $notification['message'] = "test";
        $notification['type'] = 'comment';// maybe "notification", "comment(message)", "request","message"
        $notification['object'] = [];

        event(new NotificationSenderEvent($notification));

        return response()->json(['status' => 'success', 'notification' => $notification]);
    }
}

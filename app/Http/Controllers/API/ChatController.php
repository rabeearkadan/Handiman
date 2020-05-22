<?php


namespace App\Http\Controllers\API;


use App\Events\NotificationSenderEvent;
use App\Http\Controllers\Controller;
use App\Models\RequestService;
use App\Models\Service;
use App\User;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ChatController extends Controller
{

    public function loadMessages($id)
    {

        $requestService = RequestService::query()->find($id);
        $messages = $requestService->messages;
        if ($messages != null)
            return response()->json(['status' => 'success', 'messages' => $messages]);
        return response()->json(['status' => 'success', 'messages' => "no messages yet"]);

    }

    public function notDoneRequests()
    {
        $requests = Auth::user()->employeeRequests()->where('status', 'approved')->where('isdone', false)->get();

        if ($requests == null)
            return response()->json(['status' => 'success', 'message' => 'You have no requests to chat']);
        $_requests = $requests->map(function ($item) {
            $item->client = User::query()->find($item->client_ids[0])->simplifiedArray();
            return $item;
        });

        return response()->json(['status' => 'success', 'requests' => $_requests]);
    }

    public function sendMessage(Request $request, $id)
    {

        $requestService = RequestService::query()->find($id);

        $messages = $requestService->messages;


        $message = [
            'message' => $request->input('message'),
            'date' => Carbon::now()->toDateTimeString(),
            'from' => Auth::user()->simplifiedArray()
        ];
        if ($messages != null) {

            array_push($messages, $message);
        } else {
            $messages = [];
            array_push($messages, $message);
        }
        $requestService->messages = $messages;

        $notification = $message;
        $notification['request_id'] = $id;
        if (auth()->id() == $requestService->client_ids[0]) {
            $notification['to'] = User::query()->find($requestService->employee_ids[0])->employee_device_token;
        } else {
            $notification['to'] = User::query()->find($requestService->client_ids[0])->client_device_token;
        }
        $notification['type'] = 'message';

        event(new NotificationSenderEvent($notification));
        $requestService->save();

        return response()->json(['status' => 'success', 'messages' => $message]);
    }

    public
    function Notification($to, $from, $message, $type)
    {
        $notification = array();


        $notification['to'] = $to;
        $notification['user'] = $from;
        $notification['message'] = $message;
        $notification['type'] = $type;// maybe "notification", "comment(message)", "request","message"
        $notification['object'] = [];

        event(new NotificationSenderEvent($notification));

        return response()->json(['status' => 'success', 'notification' => $notification]);
    }

}

<?php

namespace App\Http\Controllers\FRONT\Client;

use App\Events\NotificationSenderEvent;
use App\Http\Controllers\Controller;
use App\Models\RequestService;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index($id)
    {
        $user = Auth::user();
        $request = RequestService::query()->find($id);
        $messages = $request->messages;
            return view('front.client.request.chat',compact(['messages','request','user']));
    }




    public function send(Request $request, $id)
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
        return response()->json(['status'=>'success','message' => $request->input('message'),'date'=> Carbon::now()->toDateTimeString()]);
    }
    public function new(Request $request, $id)
    {
        $user = Auth::user();
        $requestService = RequestService::query()->find($id);
        $nbOfMessages = $request->numberOfMessages;
        $nbOfMessages--;
        $messages = $requestService->messages;
        for($index=0;$index<sizeof($messages);$index++){
            if($messages[$index]['from']['_id']==$user->id){
                unset($messages[$index]);
                return response()->json(['id'=>'id','status'=>'success','messages' => $messages ]);
            }
        }
        $messages = array_slice($messages,$nbOfMessages);
        return response()->json(['status'=>'success','messages' => $messages ]);
    }

    public function Notification($to, $from, $message, $type)
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

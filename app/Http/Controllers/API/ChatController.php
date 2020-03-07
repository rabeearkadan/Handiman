<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\User;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{


    public function requestToChat(Request $request)
    {

        $params = $this->validate($request, [
            'receiver_id' => 'required',
            'message' => 'required']);

        $message = new Message();
        $user = User::query()->find(Auth::id());
        $user->message_requests->push($params['receiver_id'], true);

        $user->save();
        return response()->json(['status' => 'success', 'user' => $user]);

    }


}

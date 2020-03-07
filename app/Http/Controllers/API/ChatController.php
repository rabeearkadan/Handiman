<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\User;
use App\Models\Message;
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
        
        array_push($user->message_requests, params['receiver_id']);

        $user->save();
        return response()->json(['status' => 'success', 'user' => $user]);

    }


}

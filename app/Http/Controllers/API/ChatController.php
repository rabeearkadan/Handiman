<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\RequestService;
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

        $user = User::query()->find(Auth::id());
        $obj[$params['receiver_id']] = false;
        $array = $user->message_requests;
        array_push($array, $obj);
        $user->message_requests = $array;

        $user->save();
        return response()->json(['status' => 'success', 'user' => $user]);

    }


    public function getMessages($request_id)
    {
        $req = RequestService::query()->find($request_id);
        $user=Auth::user();
    }


}

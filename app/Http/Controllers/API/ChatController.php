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

        $user = User::query()->find(Auth::id());
        $messages=$user->message_requests;
      //  array_push($messages, $params['receiver_id']);
      $obj[]=  $params['receiver_id'];
      $obj[ $params['receiver_id']][0]=false;
       array_push( $messages,$obj);
       $user->message_requests=$messages;

        $user->save();
        return response()->json(['status' => 'success', 'user' => $user]);

    }


}

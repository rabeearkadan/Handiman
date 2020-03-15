<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\User;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public function setCreditCard(Request $request)
    {
        $params = $this->validate($request, [
            'cname' => 'required',
            'cnumber' => 'required',
            'cdate' => 'required',
            'ccv' => 'required'
        ]);

        $user = User::query()->find(Auth::id());
        $card = [];
        $card[0] = $params['cname'];
        $card[1] = $params['cnumber'];
        $card[2] = $params['cdate'];
        $card[3] = $params['ccv'];
        $user->card = $card;
        $user->save();

        return response()->json(['status' => 'success', 'card' => $card]);

    }

    public function getCreditCard(Request $request)
    {

        $user = User::query()->find(Auth::id());
        $card = $user->card;

        return response()->json(['status' => 'success', 'card' => $card]);
    }



}

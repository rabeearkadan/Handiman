<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
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
        $card['cname'] = $params['cname'];
        $card['cnumber'] = $params['cnumber'];
        $card['cdate'] = $params['cdate'];
        $card['ccv'] = $params['ccv'];
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

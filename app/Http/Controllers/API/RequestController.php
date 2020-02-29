<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use  App\Models\RequestService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RequestController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'employee_id' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'string', 'max:255'],
            'time' => ['required', 'string', 'max:255'],

            'description' => ['required', 'string', 'min:15'],
        ]);
    }


    public function requestHandyman(Request $req)
    {
        $params = $req->only(['time']);

        $this->validator($req->all())->validate();
        $request = new RequestService();
        $request->employee_id = $req->input('employee_id');
        $request->client_id = $req->input('client_id');
        $request->day = $params['day'];
        $request->from = $params['from'];
        $request->to = $params['to'];
        $time = [];
        $time[0] = $params[0];
        $time[0]['day'] = $params[0]['day'];
        $time[0]['from'] = $params[0]['from'];
        $time[0]['to'] = $params[0]['to'];

        $request->time = $time;
        $request->save();
        return response()->json(['status' => 'success', 'request' => $request]);

    }

    public function requestAny(Request $req)
    {


//        $params = $this->validate($request, [
//            'description' => 'required'
//        ]);
        //first we need to know if the request is for a specific handyman
        // or if the user want the system suggestion
//        $params = $this->validate($request, [
//            'date' => 'required']);


        //09:00 Tues (1)
//        $user = User::query()->where('role', 'employee')
//            ->where('location','..')
//            ->where('blabla','111')
//            ->where('translations.'.session()->get('locale','en').'.name','111')
//            ->where('timeline.1.09:00',false)->first();


    }


}

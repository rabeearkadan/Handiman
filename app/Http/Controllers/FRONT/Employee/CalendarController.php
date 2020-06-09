<?php

namespace App\Http\Controllers\FRONT\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    /** Functions
     * index()
     * show()
     */

    public function index (Request $request){
        $user = Auth::user();
        $userRequests = $user->employeeRequests();
        foreach ($userRequests as $userRequest) {
            dd($userRequest);
        }
        dd('no res');
        $jobs=array();
        foreach ($userRequests as $userRequest){
            array_push( $jobs[$userRequest['date']->format('YY')][$userRequest['date']->format('mm')][$userRequest['date']->format('dd')],
            array([
                'startTime' => $userRequest->from,
                            'endTime' => $userRequest->to,
                            'text' => $userRequest->subject
            ])
            );
        }
        dd($jobs);

//        $request = $jobs->map(function ($item) {
//            $item->service_name = Service::find($item->service_id)->name;
//            $item->client = User::find($item->client_ids[0]);
//            return $item;
//        });

        return view('front.employee.calendar');
    }
    public function show (Request $request){
        return view('front.employee.');
    }
}

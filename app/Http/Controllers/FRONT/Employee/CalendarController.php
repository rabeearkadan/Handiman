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
        $requests = $user->employeeRequests()->where('isApproved',true);
        $jobs=array();
        foreach ($requests as $request){
            array_push( $jobs[$request['date']->format('YY')][$request['date']->format('mm')][$request['date']->format('dd')],
            array([
                'startTime' => $request->from,
                            'endTime' => $request->to,
                            'text' => $request->subject
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

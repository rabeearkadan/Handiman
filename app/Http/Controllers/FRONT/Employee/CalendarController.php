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
        $userRequests = $user->employeeRequests->where('status','approved');
        $jobs=array();
        $jobsArray = array();
        $counter=0;
        foreach ($userRequests as $userRequest) {
            ${"jobsArray".$counter} = array();
            ${"jobsArray".$counter}[$userRequest->date->format('Y')][$userRequest->date->format('m')][$userRequest->date->format('d')] = array([
                'startTime' => $userRequest->from,
                'endTime' => $userRequest->to,
                'text' => $userRequest->subject,
                'link' => "link"
            ]);
            $jobs[$userRequest->date->format('Y')][$userRequest->date->format('m')][$userRequest->date->format('d')]=null;
            $counter++;
        }
        for($index=0;$index<$counter;$index++){
            $jobs = array_merge_recursive($jobs,${"jobsArray".$index});
        }
        dd($jobs);
        return view('front.employee.calendar');
    }
    public function show (Request $request){
        return view('front.employee.');
    }
}

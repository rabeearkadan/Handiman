<?php

namespace App\Http\Controllers\FRONT\Employee;

use App\Http\Controllers\Controller;
use App\Models\RequestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    /** Functions
     * index()
     * show()
     */

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index (){
        $user = Auth::user();
        $userRequests = $user->employeeRequests->where('status','approved');
        $jobs=array();
        $jobsArray = array();
        $counter=0;
        foreach ($userRequests as $userRequest) {
            ${"jobsArray".$counter} = array();
            ${"jobsArray".$counter}[' '.$userRequest->date->format('Y')][' '.$userRequest->date->format('m')][' '.$userRequest->date->format('d')] = array([
                'startTime' => $userRequest->from,
                'endTime' => $userRequest->to,
                'text' => $userRequest->subject,
                'link' => 'calendar/'.$userRequest->id.'/show'
            ]);
            $jobs = array_merge_recursive($jobs, ${"jobsArray" . $counter});
            $counter++;
        }
        return view('front.employee.jobs.calendar',compact('jobs'));
    }
    public function show ($id,Request $request){
        $job = RequestService::findOrFail($id);
        return view('front.employee.jobs.show',compact('job'));
    }
}

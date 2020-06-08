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
//        $user = Auth::user();
//        $jobs = $user->employeeRequests()->where('isApproved',true);
//        $jobs = $jobs->map(function ($item) {
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

<?php

namespace App\Http\Controllers\FRONT\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    //
    public function index (Request $request){
        return view('front.employee.calendar');
    }
    public function show (Request $request){
        return view('front.employee.');
    }
}

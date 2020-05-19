<?php

namespace App\Http\Controllers\FRONT\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function myProfile(){
        $user = Auth::user();
        return view('front.employee.profile.edit-profile',compact('user'));
    }
    public function editPassword(){

    }
    public function editPayment(){
        $user = Auth::user();
        return view('front.employee.profile.payment',compact('user'));
    }

    public function editProfile(){

    }


    public function clientProfile($id){

    }
    public function editSchedule(){
        $user = Auth::user();
        $periods=array();
        for($day=0;$day<7;$day++) {
            $periods[$day]=array();
            $break=false;
            $index=0;
            $from=0;
            for($hour=0;$hour<24;$hour++){
                if($user->timeline[$day][$hour]==true) {
                    if($break==true && !empty($periods[$day])){
                        $index++;
                    }
                    $break=false;
                    $periods[$day][$index] = array(
                        'from'=>$from,
                        'to'=>$hour+1-$from
                    );
                }
                else{
                    $break=true;
                    $from=$hour+1;
                }
            }
            }
        dd($periods);
        return view('front.employee.profile.schedule',compact('user'));
    }
    
    public function updateSchedule(){

    }

}

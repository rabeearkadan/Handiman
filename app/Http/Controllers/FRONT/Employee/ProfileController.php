<?php

namespace App\Http\Controllers\FRONT\Employee;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /** Functions
     * myProfile()
     * editPassword()
     * editPayment()
     * editSchedule()
     * updateSchedule()
     */

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
        return view('front.employee.profile.schedule',compact(['user','periods']));
    }

    public function updateSchedule(Request $request){
        $auth_user = Auth::user();
        $user = User::find($auth_user->id);
        for ($i = 0; $i <= 23; $i++) {
            for ($j = 0; $j <= 6; $j++) {
                $user->timeline[$j][$i] = false;
            }
        }
        $periods=$request->periods;
        for($day=0;$day<7;$day++){
            if($periods[$day] != null) {
                $period = explode(',', $periods[$day]);
                for ($index=0;$index < sizeof($period);$index++){
                    for($from=$period[$index];$from<$period[$index+1];$from++) {
                        $user->timeline[$day][$from]=true;
                    }
                    $index++;
                }
            }
        }
        $user->save();
        return redirect(route('employee.schedule.edit'));
    }

}

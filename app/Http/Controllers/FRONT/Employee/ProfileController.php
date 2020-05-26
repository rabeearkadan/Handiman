<?php

namespace App\Http\Controllers\FRONT\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /** Functions
     * myProfile()
     * editPassword()
     * editPayment()
     * updateImage()
     * destroyImage()
     * editSchedule()
     * updateSchedule()
     * editDocuments()
     * updateCV()
     * updateCR()
     * uploadAny()
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
//Client Profile Image
    public function updateImage(Request $request){
        $user = Auth::user();
        $file = $request->file('image-input');
        $name = 'image_' . time() . '.' . $file->getClientOriginalExtension();
        if (!Storage::disk('public')->exists('profile')) {
            Storage::disk('public')->makeDirectory('profile');
        }
        if (Storage::disk('public')->putFileAs('profile', $file, $name)) {
            $user->image = 'profile/' . $name;
        } else {
            return view('front.client.profile.edit-profile', compact('user'));
        }
        $user->save();
        return redirect()->route('employee.profile');
    }
    public function destroyImage(){
        $user = Auth::user();
        $user->image = "";
        $user->save();
        return redirect()->route('employee.profile');
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
        $user = Auth::user();
        $timeline = array();
        for ($i = 0; $i <= 23; $i++) {
            for ($j = 0; $j <= 6; $j++) {
               $timeline[$j][$i] = false;
            }
        }
        $periods=$request->periods;
        for($day=0;$day<7;$day++){
            if($periods[$day] != null) {
                $period = explode(',', $periods[$day]);
                for ($index=0;$index < sizeof($period);$index++){
                    for($from=$period[$index];$from<$period[$index+1];$from++) {
                        $timeline[$day][$from]=true;
                    }
                    $index++;
                }
            }
        }
        $user->timeline = $timeline;
        $user->save();
        return redirect(route('employee.schedule.edit'));
    }
    public function editDocuments(){
        $user = Auth::user();
        return view('front.employee.profile.documents',compact('user'));
    }
    public function updateCV(Request $request){
        $user = Auth::user();
        $user->cv = $this->uploadAny($request->cv, 'cv', 'pdf');
        $user->save();
        dd($request->cv);
        return view('front.employee.profile.documents',compact('user'));
    }
    public function updateCR(Request $request){
        $user = Auth::user();
        $user->criminal_record = $this->uploadAny($request->file('criminal_record'), 'criminal_records', 'pdf');
        $user->save();
        return view('front.employee.profile.documents',compact('user'));
    }
    public function uploadAny($file, $folder, $ext = 'png')
    {


        $file_name = Str::random(25) . '.' . $ext; //generating unique file name;
        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }
        $result = false;
        if ($file != "") { // storing image in storage/app/public Folder
            $result = Storage::disk('public')->put($folder . '/' . $file_name, $file);

        }
        if ($result)
            return $folder . '/' . $file_name;
        else
            return null;
    }
}

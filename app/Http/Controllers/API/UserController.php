<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class UserController extends Controller
{
    //

    public function setDeviceToken(Request $request)
    {
        $user = Auth::user();

        //validate request

        $params = $this->validate($request, ['device_token' => 'required', 'device_platform' => 'required']);

        $user->device_token = $params['device_token'];
        $user->device_platform = $params['device_platform'];
        $user->save();

        return response()->json(['status' => 'success']);

    }

    public function getProfile()
    {
        $user = Auth::user();

        return response()->json(['status' => 'success', 'profile' => $user]);

    }

//public function
    function editProfile(Request $request)
    {
        $user = Auth::user();
     $role=   $request->input('post_text');
        if ($role=="client") {

            $params = $this->validate($request, [
                'profile_picture' => 'required',
                'phone' => 'required',
                'location' => 'required',
                'birth_date' => 'required',
                'gender' => 'required',
                'time_preferences_start' => 'required',
                'time_preferences_end' => 'required',
                'payment_method' => 'required',
                'apartment_details' => 'required']);

            $user->profile_picture = upload($params['profile_picture']);

            // 2d index
            $user->location = explode(',', $params['location']);

            $user->phone = $params['phone'];

            $user->birth_date = $params['birth_date'];
            $user->gender = $params['gender'];
            $user->time_preferences_start = $params['time_preferences_start'];
            $user->time_preferences_end = $params['time_preferences_end'];

            $user->save();

            return response()->json(['status' => 'success', 'user' => $user]);


        } else if ($role.equalTo("handyman")) {

            $params = $this->validate(
                $request, [
                'profile_picture' => 'required',
                'phone' => 'required',
                'email' => 'required',
//                'location' => 'required',
//                'birth_date' => 'required',
//                'gender' => 'required',
//                'services' => 'required',
//                'available_time_begin' => 'required'
//                , 'available_time_end' => 'required',
//                'price' => 'required',
//                'cv' => 'required',
//                'criminal_record' => 'required',
//                'bank_account' => 'required'
            ]);


            $file_name = $this->uploadAny($params['profile_picture'], 'uploads');
            $user->profile_picture = $file_name;
            $timeline = [
                //wod7et
              '1'=>[$params['monday_start'],$params['monday_end']]
            ];
            $user->monday[0] = $params['monday_start'];
            $user->monday[1] = $params['monday_end'];
            $user->tuesday[0] = $params['tuesday_start'];
            $user->tuesday[1] = $params['tuesday_end'];
            $user->wednesday[0] = $params['wednesday_start'];
            $user->wednesday[1] = $params['wednesday_end'];
            $user->thursday[0] = $params['thursday_start'];
            $user->thursday[1] = $params['thursday_end'];
            $user->friday[0] = $params['friday_start'];
            $user->friday[1] = $params['friday_end'];
            $user->saturday[0] = $params['saturday_start'];
            $user->saturday[1] = $params['saturday_end'];
            $user->sunday[0] = $params['sunday_start'];
            $user->sunday[1] = $params['sunday_end'];

            // index
            // is this functional?
            //try to simpl okay fe sha8le
        //    $user->location= [$params['lat'],$params['lng']];

            $user->biography = $params['biography'];
            $user->phone = $params['phone'];
//             date form
           // $user->birth_date = $params['birth_date'];

            //$user->gender = $params['gender'];

            //$user->service = $params['service'];

            //$user->available_time_begin = $params['available_time_begin'];
            //$user->available_time_end = $params['available_time_end'];
            //$user->price = $params['price'];

            //$user->certificates = $params['certificates'];


            //$file_name2 = $this->uploadAny($params['criminal_record'], 'uploads');
            //$user->criminal_record = $file_name2;

            //$file_name3 = $this->uploadAny($params['cv'], 'uploads');
            //$user->cv = $file_name3;

            //$user->bank_account = $params['bank_account'];
            $user->email = $params['email'];
            $user->save();

            return response()->json(['status' => 'success', 'user' => $user]);

        } else if ($user->isAdmin()) {

        }


    }

    public function logout(Request $request)
    {
        auth::logout();

        return response()->json(['status' => 'success', 'message' => 'logged out']);
    }

    public function uploadAny($file, $folder)
    {
        $file = base64_decode($file);
        $file_name = str_random(25) . '.png'; //generating unique file name;
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
    /*
     */
}

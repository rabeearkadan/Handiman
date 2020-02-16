<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use phpDocumentor\Reflection\Types\Integer;

class UserController extends Controller
{
    //

    public function setDeviceToken(Request $request)
    {
        $user = Auth::user();

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
        $user = User::query()->find(Auth::id());

        $params = $this->validate($request, [
// common info
            'profile_picture' => 'optional',
            'location' => 'optional',
            'birth_date' => 'optional',
            'gender' => 'optional',
            'bank_account' => 'optional',
// user extra info
            'time_preferences_start' => 'optional',
            'time_preferences_end' => 'optional',
            'payment_method' => 'optional',
            'apartment_details' => 'optional',
// employee extra info
            'cv' => 'optional',
            'certificates' => 'optional',
            'timeline' => 'optional',
            'criminal_record' => 'optional',
            'service' => 'optional',
            'biography' => 'optional'


        ]);

        if (Arr::has($params, 'profile_picture'))
            $user->profile_picture = $this->uploadAny($params['profile_picture'], 'uploads');

        if (Arr::has($params, 'birth_date'))
            $user->birth_date = $params['birth_date'];

        if (Arr::has($params, 'location'))
            $user->location = explode(',', $params['location']);

        if (Arr::has($params, 'gender'))
            $user->gender = $params['gender'];
        if (Arr::has($params, ['time_preferences_start', 'time_preferences_end'])) {
            $user->time_preferences_start = $params['time_preferences_start'];
            $user->time_preferences_end = $params['time_preferences_end'];

        }
        if (Arr::has($params, 'payment_method'))
            $user->payment_method = $params['payment_method'];
        if (Arr::has($params, 'apartment_details'))
            $user->apartment_details = $params['apartment_details'];
        /*
         *
                   'timeline' => 'optional',
                   'criminal_record' => 'optional',
                   'service' => 'optional',
                   'biography' => 'optional'
         */
        if (Arr::has($params, 'cv'))
            $user->cv = $this->uploadAny('cv', $params['cv'], '.pdf');
        if (Arr::has($params, 'certificates')) {
            $certificates= [];
            foreach ($params['certificates'] as $certificate) {
                try {

                    $certificates[]= $this->uploadAny('certificates', $certificate, '.pdf');
                } catch (\Exception $e) {
                    return response()->json(['status' => 'error', 'message' => "error uploading certificate"]);
                }

            }
            $user->certificates = $certificates;
        }
        /*
         * $params['timeline']=[
         * 0=>[0=>['from'=>'09:00','to'=>'13:00'],1=>['from'=>'14:00','to'=>'18:00']],
         * 1=>...
         *
         */
        if (Arr::has($params, 'timeline')) {
            $timeline = [];
            for ($i = 0; $i <= 23; $i++) {
                // 00:00 01:00 .....23:00
                $hour = str_pad($i,
                        2, 0, STR_PAD_LEFT) . ":00";
                foreach ($params['timeline'][0] as $option) {
                    $timeline[0][$hour] =
                        $hour >= $params['timeline'][0][$option]['from']
                        && $hour <= $params['timeline'][0][$option]['to'];

                }

                foreach ($params['timeline'][1] as $option) {
                    $timeline[1][$hour] =
                        $hour >= $params['timeline'][1][$option]['from']
                        && $hour <= $params['timeline'][1][$option]['to'];

                }

                foreach ($params['timeline'][2] as $option) {
                    $timeline[2][$hour] =
                        $hour >= $params['timeline'][2][$option]['from']
                        && $hour <= $params['timeline'][2][$option]['to'];

                }

                foreach ($params['timeline'][3] as $option) {
                    $timeline[3][$hour] =
                        $hour >= $params['timeline'][3][$option]['from']
                        && $hour <= $params['timeline'][3][$option]['to'];

                }

                foreach ($params['timeline'][4] as $option) {
                    $timeline[4][$hour] =
                        $hour >= $params['timeline'][4][$option]['from']
                        && $hour <= $params['timeline'][4][$option]['to'];

                }

                foreach ($params['timeline'][5] as $option) {
                    $timeline[5][$hour] =
                        $hour >= $params['timeline'][5][$option]['from']
                        && $hour <= $params['timeline'][5][$option]['to'];

                }

                foreach ($params['timeline'][6] as $option) {
                    $timeline[6][$hour] =
                        $hour >= $params['timeline'][6][$option]['from']
                        && $hour <= $params['timeline'][6][$option]['to'];

                }


            }
            $user->timeline = $timeline;

            /*
             * 0  0   1         0
             * 1  1   0
             * 2  0   0
             * 3  1   1
             * 4  0   1
             * 5  1   0
             * 6
             *  00:00 01:00 ... 23:00
             */
        }

        $user->save();
        //09:00 Tues (1)
//        $user = User::query()->where('role', 'employee')
//            ->where('location','..')
//            ->where('blabla','111')
//            ->where('translations.'.session()->get('locale','en').'.name','111')
//            ->where('timeline.1.09:00',false)->first();

        //users m-m timeline  m-m timelineDetails
        // leftjoin lefion query

        return response()->json(['status' => 'success', 'user' => $user]);

    }

    public function logout(Request $request)
    {
        auth::logout();

        return response()->json(['status' => 'success', 'message' => 'logged out']);
    }


    public function uploadAny($file, $folder, $ext = 'png')
    {
        /** @var TYPE_NAME $file */
        $file = base64_decode($file);

        /** @var TYPE_NAME $file_name */
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
    /*
     */
}

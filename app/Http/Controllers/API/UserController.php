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
        $user = Auth::user();

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
            $certificates[] = $params['certificates'];
            $index = 0;
            foreach ($certificates as $certificate) {
                $index++;
                try {
                    $user->certificates = [
                        $index => $this->uploadAny('certificates', $certificate, '.pdf')
                    ];
                } catch (\Exception $e) {
                    return response()->json(['status' => 'error', 'message' => "error uploading certificate"]);
                }

            }
        }
        if (Arr::has($params, 'timeline')) {
            $user->timeline = [
// to be continued
                '1' => [$params['monday_start'], $params['monday_end']],
                '2' => [$params['tuesday_start']]


            ];
        }

            $user->save();

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

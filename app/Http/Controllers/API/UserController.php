<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RequestService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use phpDocumentor\Reflection\Types\Integer;

class UserController extends Controller
{
    //
    public function addRating(Request $request)
    {
        $request_id = $request->input('request');
        $rate = (double)$request->input('rating');
        $requestService = RequestService::query()->find($request_id);
        $requestService->rating = $rate;
        $requestService->save();
        return response()->json(['status' => 'success']);
    }

    public function setDeviceToken(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, ['device_platform' => 'required']);
        $params = $request->all();
        foreach ($params as $param => $value) {
            $user->{$param} = $value;
        }
        $user->save();

        return response()->json(['status' => 'success']);

    }

    public function getProfile()
    {
        $user = Auth::user();

        return response()->json(['status' => 'success', 'profile' => $user]);

    }

    public function getTimeline($id)
    {
        $user = User::query()->find($id);
        $timeline = $user->timeline;
        return response()->json(['status' => 'success', 'timeline' => $timeline]);
    }

    public function checkTimeline($user)
    {
        $flag = false;
        for ($i = 0; $i <= 6; $i++) {
            for ($j = 0; $j <= 23; $j++) {
                if ($user->timeline[$i][$j] == true) {
                    $flag = true;
                    break;
                }
            }
        }
        return $flag;
    }

    public function editProfile(Request $request)
    {
        $user = User::query()->find(Auth::id());


        $params = $request->only([
// common info
            'addresses',
            'image',
            'latitude', 'longitude',
            'birth_date',
            'gender',
            'bank_account',
// user extra info
            'address',
            'from',
            'to',
            'payment_method',
            'apartment_details',
// employee extra info
            'cv',
            'price',
            'certificate',
            'timeline',
            'criminal_record',
            'service',
            'biography'


        ]);

        if (Arr::has($params, 'address')) {

            $data = [
                "_id" => Str::random(24),
                "name" => $request->name,
                "floor" => $request->floor,
                "type" => $request->type,
                "building" => $request->building,
                "location" => [(double)$request->lng, (double)$request->lat],
                "street" => $request->street,
                "zip" => $request->zip,

            ];
            $user->push('client_addresses', $data);


        }
        if (Arr::has($params, 'image'))
            $user->image = $this->uploadAny($params['image'], 'profile');

        if (Arr::has($params, 'price'))
            $user->price=(double)$request->input('price');

        if (Arr::has($params, 'biography'))
            $user->biography = $params['biography'];

        if (Arr::has($params, 'birth_date'))
            $user->birth_date = $params['birth_date'];

        if (Arr::has($params, 'latitude') && Arr::has($params, 'longitude')) {
            $latitude = $request->input('latitude');

            $longitude = $request->input('longitude');
            $location = [];
            $location[0] = (double)$longitude;
            $location[1] = (double)$latitude;
            $user->location = $location;


        }

        if (Arr::has($params, 'gender'))
            $user->gender = $params['gender'];

        if (Arr::has($params, ['from', 'to'])) {
            $user->time_preferences_start = $params['from'];
            $user->time_preferences_end = $params['to'];
        }

        if (Arr::has($params, 'payment_method'))
            $user->payment_method = $params['payment_method'];

        if (Arr::has($params, 'apartment_details'))
            $user->apartment_details = $params['apartment_details'];

        if (Arr::has($params, 'cv'))
            $user->cv = $this->uploadAny($params['cv'], 'cv', 'pdf');
        if (Arr::has($params, 'certificate'))
            $user->certificate = $this->uploadAny($params['certificate'], 'certificates', 'pdf');
        if (Arr::has($params, 'criminal_record'))
            $user->criminal_record = $this->uploadAny($params['criminal_record'], 'criminal_records', 'pdf');

        if (Arr::has($params, 'timeline')) {
            $test = [];


            $test[0] = json_decode($params['timeline'][0]);
            $test[1] = json_decode($params['timeline'][1]);
            $test[2] = json_decode($params['timeline'][2]);
            $test[3] = json_decode($params['timeline'][3]);
            $test[4] = json_decode($params['timeline'][4]);
            $test[5] = json_decode($params['timeline'][5]);
            $test[6] = json_decode($params['timeline'][6]);
            $user->test_timeline = $test;
            $user->timeline = $test;

        }

        $user->save();
        if ($user->image != null &&
            $user->biography != null &&
            $user->gender != null &&
            $user->service_ids != null &&
            $user->location != null &&
            $this->checkTimeline($user) &&
            $user->certificate != null &&
            $user->criminal_record != null &&
            $user->cv != null
        ) {
            $user->isApproved = true;
        } else {
            $user->isApproved = false;
        }
        $user->save();
        return response()->json(['status' => 'success', 'user' => $user]);

    }

    public function getHandymanFeedback()
    {
        $requests = Auth::user()->employeeRequests()->where('feedback', '!=', null)->get();
        if ($requests != null)
            return response()->json(['status' => 'success', 'requests' => $requests]);
        else
            return response()->json(['status' => 'success', 'requests' => 'you have no feedbacks yet']);
    }

    public function forgotPassword(Request $request)
    {
        Auth::user()->password = Hash::make($request->input('password'));
        return response()->json(['status' => 'success', 'message' => 'Password Changed']);
    }

    public function logout(Request $request)
    {
        auth::logout();

        return response()->json(['status' => 'success', 'message' => 'logged out']);
    }


    public function uploadAny($file, $folder, $ext = 'png')
    {
        $file = base64_decode($file);

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

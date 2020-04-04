<?php

namespace App\Http\Controllers\API;

use App\Events\NotificationSenderEvent;
use App\Http\Controllers\Controller;
use  App\Models\RequestService;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class RequestController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'description' => ['required', 'string', 'min:15']
        ]);
    }

    public function checkTimeline($from, $to, $day, User $handyman)
    {
        $flag = true;
        for ($i = $from; $i <= $to; $i++) {
            $hour = str_pad($i,
                    2, 0, STR_PAD_LEFT) . "00";
            if ($handyman->timeline[$day][$i] == true) {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    public function checkRequests(User $handyman, $day, $from, $to)
    {
        $requests = RequestService::query()->where('employee_ids.0', $handyman->id);
        $flag = true;
        foreach ($requests as $req) {
            if ($req->day == $day) {
                for ($i = $from; $i <= $to; $i++) {
                    $hour = str_pad($i,
                            2, 0, STR_PAD_LEFT) . "00";
                    if ($hour == $req->from || $hour == $req->to) {
                        $flag = false;
                        break;
                    }
                }
            }
        }
        return $flag;
    }

    public function makeRequest(Request $req)
    {
        $this->validator($req->all())->validate();
        $requestHandyman = new RequestService();
        $requestHandyman->subject = $req->input('subject');
        $requestHandyman->description = $req->input('description');
        $requestHandyman->status = 'pending';
        $requestHandyman->location = explode(',', $req->input('location'));
        $requestHandyman->timezone = $req->timezone;
        $requestHandyman->service_id = $req->service_id;

        if (Carbon::now($requestHandyman->timezone)->minute > 30) {
            $nowHour = str_pad(Carbon::now($requestHandyman->timezone)->hour + 1, 2, '0', STR_PAD_LEFT) . '00';
            $nowNextHour = str_pad(Carbon::now($requestHandyman->timezone)->hour + 2, 2, '0', STR_PAD_LEFT) . '00';
        } else {
            $nowHour = str_pad(Carbon::now($requestHandyman->timezone)->hour, 2, '0', STR_PAD_LEFT) . '00';
            $nowNextHour = str_pad(Carbon::now($requestHandyman->timezone)->hour + 1, 2, '0', STR_PAD_LEFT) . '00';
        }
        if ($req->has('images')) {
            $images = [];
            foreach ($req['images'] as $image) {
                try {
                   $images[] = $this->uploadAny('requests', $image, '.png');
                } catch (\Exception $e) {
                    return response()->json(['status' => 'error', 'message' => "error uploading image"]);
                }
            }
            $requestHandyman->images = $images;
        }

        if ($req->has('is_urgent') && $req->input('is_urgent')) {
            if ($req->has('from') && $req->has('to')) {
                $requestHandyman->from = $req->from;
                $requestHandyman->to = $req->to;
                $handyman = $this->searchForHandyman($requestHandyman, $req->input('from'), $req->input('to'));
                // $this->Notification()
            } else if ($req->has('from') && (!$req->has('to'))) {
                $requestHandyman->from = $req->from;
                $requestHandyman->to = null;
                $requestHandyman->handyman_to = 'pending';
                $handyman = $this->searchForHandyman($requestHandyman, $req->from, $req->from + 2);
                //$this->Notification()
            } else {
                if ($req->has('to')) {
                    $requestHandyman->to = $req->to;
                    $requestHandyman->from = $nowHour;
                    $handyman = $this->searchForHandyman($requestHandyman, $nowHour, $req->to);
                    //notification
                } else {
                    $requestHandyman->from = $nowHour;
                    $requestHandyman->to = $nowNextHour;
                }
            }
            $requestHandyman->save();
            $requestHandyman->clients()->attach(Auth::id());
            if ($handyman == null) {
                return response()->json(['status' => 'success', 'message' => 'No handyman found please search on larger range']);
            } else {
                $requestHandyman->empolyee_id = $handyman->id;
                $requestHandyman->type = 'urgent';
                $requestHandyman->save();
                $requestHandyman->clients()->attach(Auth::id());
                $this->notification($handyman->employee_device_token, Auth::user()->name, 'You received a new request', 'request');
                return response()->json(['status' => 'success', 'message' => 'Your urgent request has reached a handyman']);

            }
        } else {
            if ($req->has('employee_id')) {
                $handyman = User::query()->find($req->input('employee_id'));
                $requestHandyman->type = 'specified';
                $requestHandyman->date = $req->input('date');
                if ($req->has('from'))
                    $requestHandyman->from = $req->input('from');
                if ($req->has('to')) {
                    $requestHandyman->to = $req->input('to');
                } else {
                    $requestHandyman->handyman_to = 'pending';
                    $requestHandyman->to = null;
                }
                $this->notification(($handyman->employee_device_token), (Auth::user()->name), 'You received a new request', 'request');
            }
            $requestHandyman->save();
            $requestHandyman->clients()->attach(Auth::id());
            if ($req->has('employee_id')) {
                $handyman = User::query()->find($req->input('employee_id'));
                $requestHandyman->employees()->attach($handyman->id);
            }
            return response()->json(['status' => 'success', 'message' => 'Your search was done successfully']);
        }


    }

    private function searchForHandyman($requestHandyman, $from, $to)
    {

        $day = Carbon::now()->dayOfWeek;
        $availableUsers = User::query()
            ->where('service_ids', $requestHandyman->service_id)
            ->where('location', 'near', [
                '$geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        $requestHandyman->location[0],
                        $requestHandyman->location[1],
                    ],
                    'distanceField' => "dist.calculated",
                    '$maxDistance' => 50000000,
                ],
            ])->orderBy('dist.calculated')->get();

        $matchingHandyman = null;
        foreach ($availableUsers as $handyman) {
            $flag1 = $this->checkTimeline($from, $to, $day, $handyman);
            $flag2 = $this->checkRequests($handyman, $day, $from, $to);
            if ($flag1 && $flag2) {
                $matchingHandyman = $handyman;
                break;
            }
        }

        return $matchingHandyman;
    }


    public
    function getRequestById($id)
    {
        $request = RequestService::query()->find($id);

        return response()->json(['status' => 'success', 'request' => $request]);
    }

    public
    function setRequestTo(Request $request)
    {
        $req = RequestService::query()->find($request->input('id'));
        $req->to = $request->input('to');
        $req->handyman_to = 'approved';
    }

    public
    function getHandymanRequests()
    {
        $pending = Auth::user()->employeeRequests()->where('status', 'pending')->get();

        if ($pending == null)
            return response()->json(['status' => 'success', 'message' => 'You have no ongoing requests']);
        $prequest = $pending->map(function ($item) {
            $item->client = User::query()->find($item->client_ids[0])->simplifiedArray();
            return $item;
        });
        return response()->json(['status' => 'success', 'requests' => $prequest]);
    }

    public
    function getHandymanJobs()
    {
        $outgoing = RequestService::query()->client()
            ->where('employee_id', Auth::id())
            ->where('status', 'outgoing')->get();

        return response()->json(['status' => 'success', 'requests' => $outgoing]);
    }

    public
    function replyToRequest($id, Request $req)
    {
        $request = RequestService::query()->find($id);
        $request->status = $req->input('status');
        $client = User::query()->find($request->client_ids[0]);
        $request->save();
        $this->notification($client->client_device_token, Auth::user()->name, 'Your request has been' . $request->status, 'request');
        return response()->json(['status' => 'success']);
    }


    public
    function Notification($to, $from, $message, $type)
    {
        $notification = array();


        $notification['to'] = $to;
        $notification['user'] = $from;
        $notification['message'] = $message;
        $notification['type'] = $type;// maybe "notification", "comment(message)", "request","message"
        $notification['object'] = [];

        event(new NotificationSenderEvent($notification));

        return response()->json(['status' => 'success', 'notification' => $notification]);
    }

    public
    function distance($lat1, $lon1, $lat2, $lon2, $unit = 'K')
    {

        $theta = $lon1 - $lon2;

        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));

        $dist = acos($dist);

        $dist = rad2deg($dist);

        $miles = $dist * 60 * 1.1515;

        $unit = strtoupper($unit);

        if ($unit == "K") {

            return round(($miles * 1.609344), 2);

        } else if ($unit == "N") {

            return round(($miles * 0.8684), 2);

        } else {

            return round($miles, 2);

        }


    }

    public
    function uploadAny($file, $folder, $ext = 'png')
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

}

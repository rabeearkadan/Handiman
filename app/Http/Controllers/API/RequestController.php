<?php

namespace App\Http\Controllers\API;

use App\Events\NotificationSenderEvent;
use App\Http\Controllers\Controller;
use  App\Models\RequestService;

use App\Models\Service;
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

        if ($req->has('images')) {
            $imagesParam = $req->input('images');
            $images = [];
            foreach ($imagesParam as $image) {
                try {
                    $images[] = $this->uploadAny($image, 'requests', 'png');
                } catch (\Exception $e) {
                    return response()->json(['status' => 'error', 'message' => "error uploading image"]);
                }
            }
            $requestHandyman->images = $images;
        }

        if ($req->has('is_urgent') && $req->input('is_urgent')) {
            if (Carbon::now($requestHandyman->timezone)->minute > 30) {
                $nowHour = str_pad(Carbon::now($requestHandyman->timezone)->hour + 1, 2, '0', STR_PAD_LEFT) . '00';
                $nowNextHour = str_pad(Carbon::now($requestHandyman->timezone)->hour + 2, 2, '0', STR_PAD_LEFT) . '00';
            } else {
                $nowHour = str_pad(Carbon::now($requestHandyman->timezone)->hour, 2, '0', STR_PAD_LEFT) . '00';
                $nowNextHour = str_pad(Carbon::now($requestHandyman->timezone)->hour + 1, 2, '0', STR_PAD_LEFT) . '00';
            }
            if ($req->has('from')) {
                $requestHandyman->from = $req->from;
            } else {
                $requestHandyman->from = $nowHour;
            }
            if ($req->has('to')) {
                $requestHandyman->to = $req->to;
            } else {
                $requestHandyman->to = $nowNextHour;
            }
            $requestHandyman->save();
            $requestHandyman->clients()->attach(Auth::id());

            return response()->json(['status' => 'success', 'message' => 'Your request has been sent to the scheduler']);

        } else {
            if ($req->has('employee_id')) {
                $handyman = User::query()->find($req->input('employee_id'));
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
            return response()->json(['status' => 'success', 'message' => 'Please stay in touch for confirmation']);
        }


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
        $pending_request = $prequest->map(function ($item) {
            $item->service = Service::query()->find($item->service_id)->ServicesimplifiedArray();
            return $item;
        });
        return response()->json(['status' => 'success', 'requests' => $pending_request]);
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

<?php

namespace App\Http\Controllers\API;

use App\Events\NotificationSenderEvent;
use App\Http\Controllers\Controller;
use  App\Models\RequestService;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


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
        //add attachment if exists

        if ($req->has('is_urgent') && $req->input('is_urgent')) {
            if ($req->has('from') && $req->has('to')) {
                $requestHandyman->from = $req->from;
                $requestHandyman->to = $req->to;
                // search handyman with the availability of 'from' and 'to'
            } else if ($req->has('from') && (!$req->has('to'))) {
                $requestHandyman->from = $req->from;
                $requestHandyman->to = null;
                $requestHandyman->handyman_to = 'pending';
                // search for handyman with  availability of 'from' and for two hours from 'from' but the handyman should estimate the 'to'
            } else {
                if ($req->has('to')) {
                    $requestHandyman->to = $req->to;
                    // from is now
                }
            }
            $requestHandyman->save();
            $requestHandyman->clients()->attach(Auth::id());
            $handyman = $this->searchForHandyman($requestHandyman);
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
                $requestHandyman->date = $req->input('date');//yyyy-mm-dd
                if ($req->has('from')) {
                    $requestHandyman->from = $req->input('from');
                }
                if ($req->has('to')) {
                    $requestHandyman->to = $req->input('to');
                    $requestHandyman->to = null;
                    $requestHandyman->handyman_to = 'pending';
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

    private function searchForHandyman($requestHandyman)
    {
        if (Carbon::now($requestHandyman->timezone)->minute > 30) {
            $nowHour = str_pad(Carbon::now($requestHandyman->timezone)->hour + 1, 2, '0', STR_PAD_LEFT) . '00';
            $nowNextHour = str_pad(Carbon::now($requestHandyman->timezone)->hour + 2, 2, '0', STR_PAD_LEFT) . '00';
        } else {
            $nowHour = str_pad(Carbon::now($requestHandyman->timezone)->hour, 2, '0', STR_PAD_LEFT) . '00';
            $nowNextHour = str_pad(Carbon::now($requestHandyman->timezone)->hour + 1, 2, '0', STR_PAD_LEFT) . '00';
        }
        $nowDay = Carbon::now()->dayOfWeek;
        $availableUsers = User::query()
            ->where('timeline'
                . $nowDay . '.' . $nowHour
                , true)
            ->where('timeline'
                . $nowDay . '.' . $nowNextHour
                , true)
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
            ])->orderBy('dist.calculated')
            ->get()->filter(function ($item) use ($requestHandyman, $nowNextHour, $nowHour, $nowDay) {
                $userRequests = RequestService::query()
                    ->where('date', $nowDay)
                    ->where('from', $nowHour)
                    ->where('from', $nowNextHour)
                    ->where('employee_id', $item->id)
                    ->count();
                return $userRequests == 0;

            });
        return $availableUsers->first();
    }


    public function getRequestById($id)
    {
        $request = RequestService::query()->find($id);

        return response()->json(['status' => 'success', 'request' => $request]);
    }


    public function getHandymanRequests()
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

    public function getHandymanJobs()
    {
        $outgoing = RequestService::query()->client()
            ->where('employee_id', Auth::id())
            ->where('status', 'outgoing')->get();

        return response()->json(['status' => 'success', 'requests' => $outgoing]);
    }

    public function replyToRequest($id, Request $req)
    {
        $request = RequestService::query()->find($id);
        $request->status = $req->input('status');
        $client = User::query()->find($request->client_ids[0]);
        $request->save();
        $this->notification($client->client_device_token, Auth::user()->name, 'Your request has been' . $request->status, 'request');
        return response()->json(['status' => 'success']);
    }

    public function sendRequestMessage(Request $request, $id)
    {

        $requestService = RequestService::query()->find($id);

        $messages = $requestService->messages;
        $message = [
            'message' => $request->input('message'),
            'date' => Carbon::now()->toDateTimeString(),
            'from' => Auth::user()->simplifiedArray()
        ];
        array_push($messages, $message);
        $requestService->messages = $messages;
        // send notification to the other user if the auth is 'from request ' the notification is sent to the to
        // and vice cersa
        $notification = $message;
        $notification['request_id'] = $id;
        if (auth()->id() == $requestService->client_id) {
            $notification['to'] = User::query()->find($requestService->employee_id)->employee_device_token;
        } else {
            $notification['to'] = User::query()->find($requestService->client_id)->client_device_token;
        }
        $notification['type'] = 'message';

        event(new NotificationSenderEvent($notification));
        $requestService->save();
    }

    public function Notification($to, $from, $message, $type)
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

    public function distance($lat1, $lon1, $lat2, $lon2, $unit = 'K')
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

}

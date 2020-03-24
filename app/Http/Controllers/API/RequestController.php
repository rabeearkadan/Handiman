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


    public function makeRequest(Request $req)
    {
        $this->validator($req->all())->validate();
        $requestHandyman = new RequestService();
        $requestHandyman->client_id = Auth::id();
        $requestHandyman->description = $req->input('description');
        $requestHandyman->status = 'ongoing';

        $requestHandyman->location = explode(',', $req->input('location'));
        $requestHandyman->timezone = $req->timezone;
        $requestHandyman->service_id = $req->service_id;
        //add attachment if exists

        if ($req->has('is_urgent') && $req->input('is_urgent')) {
            //search for urgent requests
            //if its urgent let the system search for a handiman and make a suggestion
            $requestHandyman->save();
            $handyman = $this->searchForHandyman($requestHandyman);
            if ($handyman == null) {

                return response()->json(['status' => 'success', 'message' => 'No handyman found please search on larger range']);
            } else {
                $requestHandyman->empolyee_id = $handyman->id;
                $requestHandyman->type = 'urgent';
                $requestHandyman->save();
                $this->notification($handyman->employee_device_token, Auth::user()->name, 'You received a new request', 'request');
                return response()->json(['status' => 'success', 'message' => 'Your urgent request has reached a handyman']);

            }
        } else {
            if ($req->has('employee_id')) {
                $handyman = User::query()->find($req->input('employee_id'))->get();
                $requestHandyman->type = 'specified';
                $requestHandyman->employee_id = $handyman->id;
                $requestHandyman->date = $req->input('date');//yyyy-mm-dd
                $this->notification($handyman->employee_device_token, Auth::user()->name, 'You received a new request', 'request');
            }
            $requestHandyman->save();
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
            ->where('timeline.' . $nowDay . '.' . $nowHour, true)
            ->where('timeline.' . $nowDay . '.' . $nowNextHour, true)
            ->where('service_id', $requestHandyman->service_id)
            ->where('location', 'near', [
                '$geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        $requestHandyman->location[0],
                        $requestHandyman->location[1],
                    ],
                    '$maxDistance' => 50,
                ],
            ])
            // order by location
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

    public function getClientRequests()
    {

        $requests = RequestService::query()
            ->where('client_id', Auth::id())->get();

        return response()->json(['status' => 'success', 'requests' => $requests]);

    }

    public function getHandymanRequests()
    {

        $requests = RequestService::query()
            ->where('employee_id', Auth::id())->get();


        return response()->json(['status' => 'success', 'requests' => $requests]);

    }

    public function getClientByRequest($id)
    {
        $request = RequestService::query()->find($id);
        $client_id = $request->client_id;
        $client = User::query()->find($client_id)->get();

        return response()->json(['status' => 'success', 'client' => $client]);

    }


    public function acceptRequest(Request $req, $id)
    {
        $request = RequestService::query()->find($id);
        $request->handyman_status = 'accept';
        $request->estimate_time = $req->input('time_estimate');


        // notify the client to respond to the estimated # hours
        $request->save();
        return response()->json(['status' => 'success']);
    }

    public function rejectRequest(Request $req, $id)
    {
        $request = RequestService::query()->find($id);
        $request->handyman_status = 'reject';


        // notify the client with the rejection
        $request->save();
        return response()->json(['status' => 'success']);
    }

    public function acceptEstimateHours(Request $req, $id)
    {

        $request = RequestService::query()->find($id);
        $employee_id = $request->employe_id;
        $employee = User::query()->find($employee_id);
        $location[] = $request->location;
        $day = $request->day;
        $from = $request->from;
        $to = $request->to;
        $flag = true;

        for ($i = $from; $i <= $to; $i++) {

            $hour = str_pad($i,
                    2, 0, STR_PAD_LEFT) . "00";
            if ($employee->timeline[$day][$hour] == false) {
                $flag = false;
                break;
            }


        }
        if ($flag) {
            for ($i = $from; $i <= $to; $i++) {
                $hour = str_pad($i,
                        2, 0, STR_PAD_LEFT) . "00";

                // $employee->timeline[$day][$hour]['id']=$request->id;
                // we will save the id of the request at every hour
            }

        }
        // the process is not done yet
        // we need to check the location before and after so that we make sure that no two locations contradict with the time
        // for that we will call a function that returns the time needed to cover the two distances
        // (from{lat,long}) {employee location before the request}
        //(to{from,long}) {the request location}

        // we need then to check the location of the employee he needs to be in after the request so that is does not contradicts
        $hour = str_pad($i,
                2, 0, STR_PAD_LEFT) . "00";
        if ($employee->timeline[$day][$to + $hour] == true) {
            // then the employee has a free hour after the request is done
        } else {
            // the handyman has a request

        }


    }

    public function rejectEstimateHours(Request $req, $id)
    {

        $request = RequestService::query()->find($id)->delete();
        //notify the handyman


    }

    public function getRequestById($id)
    {
        $request = RequestService::query()->find($id);

        return response()->json(['status' => 'success', 'request' => $request]);
    }

    public function geHandymanOngoingRequests()
    {
        $user = Auth::user();
        $ongoing = RequestService::query()->where('employee_id', $user->id)->where('status', 'ongoing')->get();

        return response()->json(['status' => 'success', 'OngoingRequests' => $ongoing]);
    }

    public function geHandymanOutgoingRequests()
    {
        $user = Auth::user();
        $outgoing = RequestService::query()->where('employee_id', $user->id)->where('status', 'outgoing')->get();

        return response()->json(['status' => 'success', 'OngoingRequests' => $outgoing]);
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

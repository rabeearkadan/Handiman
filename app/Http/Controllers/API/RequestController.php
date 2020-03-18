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


    public function requestHandyman($id, Request $req)
    {
        $user = User::query()->find(Auth::id());

        $handyman = User::query()->find($id);

        $this->validator($req->all())->validate();
        $requestHandyman = new RequestService();

        $requestHandyman->employee_id = $id;
        $requestHandyman->client_id = $handyman->id;
        $requestHandyman->description = $req->input('description');
        $requestHandyman->status = 'ongoing';

        $requestHandyman->description = $req->input('description');
        $requestHandyman->location = $user->location;
        $client_preferences = [];
        $client_preferences['from'] = $user->from;
        $client_preferences['to'] = $user->to;
        $requestHandyman->client_preferences = $client_preferences;
        $this->notification($handyman->device_token, $user->name, 'You received a new request', 'message');


        $requestHandyman->save();

        return response()->json(['status' => 'success', 'request' => $requestHandyman, 'handyman' => $handyman, 'client' => $user]);

    }

    public function requestAny(Request $req)
    {
        $user = User::query()->find(Auth::id());


        $params = $this->validate($req, [
            'description' => 'required'
        ]);

        $requestHandyman = new RequestService();
        $requestHandyman->client_id = $user->id;
        $requestHandyman->description = $params['description'];
        $requestHandyman->status = 'ongoing';
        $client_from = $user->from;
        $client_to = $user->to;

        $latitude = $user->location[0];
        $longitude = $user->location[1];

        $handyman = User::query()
            ->where('role', 'employee')
            ->orWhere('role', 'user_employee')
            ->where('isApproved', true)
            ->where('timeline.0.' . $client_from, true)
            ->where('timeline.0.' . $client_to, true)
            ->where('location', 'near', [
                '$geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        $latitude,
                        $longitude,
                    ],
                ],
                '$maxDistance' => 50,
            ])
            ->firstOrFail()->get();

        $requestHandyman->employee_id = $handyman->id;

        $this->notification($handyman->device_token, $user->name, 'You received a new request', 'message');


        return response()->json(['status' => 'success', 'Handyman' => $requestHandyman]);
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
            $notification['to'] = User::query()->find($requestService->employee_id)->device_token;
        } else {
            $notification['to'] = User::query()->find($requestService->client_id)->device_token;
        }
        $notification['type'] = 'message';

        event(new NotificationSenderEvent($notification));
        $requestService->save();
    }

    public function notification($to, $from, $message, $type)
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
}

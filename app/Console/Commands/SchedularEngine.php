<?php

namespace App\Console\Commands;

use App\Events\NotificationSenderEvent;
use App\Models\RequestService;
use App\Models\Service;
use App\User;
use Carbon\Carbon;
use Carbon\Traits\Date;
use DemeterChain\C;
use Illuminate\Console\Command;


class SchedularEngine extends Command
{
    protected $signature = 'app:scheduler';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $request = RequestService::query()->where('status', 'pending')->get();
        foreach ($request as $req) {

            if ($req->employees()->count() == 0) {

                $result = $this->searchForHandyman($req);
                if ($result == null) {
                    $user = User::query()->find($req->client_ids[0]);
                    $var = Carbon::createFromFormat('Y-m-d H:i:s', $req->date, $req->timezone)->dayOfWeek;

                    $this->Notification($user->client_device_token, 'Admin', $var . ' no results found, search on large area', 'notification');
                } else {
                    $req->employees()->attach($result->id);
                    $req->updated_at = Carbon::now();
                    $req->save();
                    $this->Notification($result->employee_device_token, 'Admin', 'You received a new request', 'request');

                }


            }
        }

    }

    private function searchForHandyman($requestHandyman)
    {

        $list = Service::query()->where('_id', $requestHandyman->service_id)->first();
        if ($list == null)
            return response()->json(['status' => 'error', 'message' => "no service found"]);
        $availableUsers = $list->users()->where('isApproved', true)
            ->where('role', 'user_employee')
            ->orWhere('role', 'employee')
//            ->where('location', 'near', [
//                '$geometry' => [
//                    'type' => 'Point',
//                    'coordinates' => [
//                        (float)$requestHandyman->locaation[0],
//                        (float)$requestHandyman->location[1],
//                    ],
//                    'distanceField' => "dist.calculated",
//                    '$maxDistance' => 50000,
//                ],
//            ])->orderBy('dist.calculated')
            ->get();

        $matchingHandyman = null;
        if (Carbon::now($requestHandyman->timezone)->minute > 30) {
            $nowHour = str_pad(Carbon::now($requestHandyman->timezone)->hour + 1, 2, '0', STR_PAD_LEFT) . '00';
            $nowNextHour = str_pad(Carbon::now($requestHandyman->timezone)->hour + 2, 2, '0', STR_PAD_LEFT) . '00';
        } else {
            $nowHour = str_pad(Carbon::now($requestHandyman->timezone)->hour, 2, '0', STR_PAD_LEFT) . '00';
            $nowNextHour = str_pad(Carbon::now($requestHandyman->timezone)->hour + 1, 2, '0', STR_PAD_LEFT) . '00';
        }

        foreach ($availableUsers as $handyman) {
            if ($requestHandyman->from == null) {
                $requestHandyman->from = $nowHour;
            }
            if ($requestHandyman->to == null) {
                $requestHandyman->to = $nowNextHour;
            }
            if ($requestHandyman->date == null) {
                $requestHandyman->date = Carbon::now()->dayOfWeek;
            }
            $user = User::query()->find($requestHandyman->client_ids[0]);
            $var = Carbon::createFromFormat('Y-m-d H:i:s', $requestHandyman->date, $requestHandyman->timezone)->dayOfWeek;

            if ($var == 0) {
                $var = 6;
            } else {
                $var--;
            }
            $this->Notification($user->employee_device_token, 'Admin', $var, 'notification');

            $flag1 = $this->checkTimeline($requestHandyman->from, $requestHandyman->to, $var, $handyman);
//            $flag2 = $this->checkRequests($handyman, $requestHandyman->date, $requestHandyman->from, $requestHandyman->to);
            $flag2 = true;
            if ($flag1 && $flag2) {
                $matchingHandyman = $handyman;
                break;
            }
        }

        return $matchingHandyman;
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

    public function checkTimeline($from, $to, $day, $handyman)
    {


        $flag = true;
        for ($i = (int)$from; $i < (int)$to; $i++) {
            if ($handyman->timeline[$day][$i] == false) {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    public function checkRequests(User $handyman, $day, $from, $to)
    {
        $requestsq = RequestService::query()->whereHas('employees', function ($q) use ($handyman) {
            $q->where('_id', $handyman->_id);
        })->where('day', $day)->where('isdone', false);
        for ($i = (int)$from; $i < (int)$to; $i++) {
            $requestsq->where('from', $i);
        }
        return $requestsq->count() == 0;
    }
}

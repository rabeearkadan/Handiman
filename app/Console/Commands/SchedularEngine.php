<?php

namespace App\Console\Commands;

use App\Events\NotificationSenderEvent;
use App\Models\RequestService;
use App\Models\Service;
use App\User;
use Carbon\Carbon;
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
                    $this->Notification($user->cient_device_token, 'Admin', 'no results found, search on large area', 'notification');
                } else {
                    $req->employees()->attach($result->id);
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
        $availableUsers = $list->users()->where('isApproved', true)->get();

//            ->where('location', 'near', [
//                '$geometry' => [
//                    'type' => 'Point',
//                    'coordinates' => [
//                        $requestHandyman->location[0],
//                        $requestHandyman->location[1],
//                    ],
//                    'distanceField' => "dist.calculated",
//                    '$maxDistance' => 50000000,
//                ],
//            ])->orderBy('dist.calculated')->get();

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
            if ($requestHandyman->day == null) {
                $requestHandyman->day = $day = Carbon::now()->dayOfWeek;
            }
            $flag1 = $this->checkTimeline($requestHandyman->from, $requestHandyman->to, $requestHandyman->day, $handyman);
            $flag2 = $this->checkRequests($handyman, $requestHandyman->day, $requestHandyman->from, $requestHandyman->to);
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
        $day=Carbon::create($day)->dayOfWeek;
        $flag = true;
//        for ($i = (int)$from; $i <= (int)$to; $i++) {
//            if ($handyman->timeline[$day][$i] == false) {
//                $flag = false;
//                break;
//            }
//        }
        return $flag;
    }

    public function checkRequests(User $handyman, $day, $from, $to)
    {
        $requestsq = RequestService::query()->whereHas('employees', function ($q) use ($handyman) {
            $q->where('_id', $handyman->_id);
        })->where('day', $day)->where('status', '!=', 'done');
        for ($i = (int)$from; $i <= (int)$to; $i++) {
            $requestsq->where('from', $i);
        }
        return $requestsq->count() == 0;
    }
}

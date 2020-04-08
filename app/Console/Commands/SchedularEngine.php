<?php

namespace App\Console\Commands;

use App\Events\NotificationSenderEvent;
use App\Models\RequestService;
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
        $this->Notification('d8M25IfgRRiJX8Q_Iu0B-0:APA91bHuD7Wl1hy5pOyaM3LrC053EoEgTOZHCyNcPV3SFmZwJ94Ce3QC7EzXCXHFeF3P4sEKNUt4GKRVybn6mAMw_uJRYItR35sn8xo29YsSaPM5N6Fjv4bq4ASelvCgPZA6_Gd1JlPh',
            'admin', 'testing the scheduler', 'comment');

        $nowTime = Carbon::now()->timestamp;
        $request = RequestService::query()->where('status', 'pending')->where('employee_id', null)->get();
        foreach ($request as $req) {
            $handyman = $this->searchForHandyman($req);
            if ($handyman == null) {
                $user = User::query()->find($req->client_ids[0]);
                $this->Notification($user->cient_device_token, 'Admin', 'You have less than 10 minutes to reply for pending requests', 'notification');

            } else {
                $req->save();
                $req->employees()->attach($handyman->id);
                $this->Notification($handyman->employee_device_token, 'Admin', 'You received a new request', 'request');

            }

        }
        //1- getting all pending requests with status pending with no employee id
        //2- make algo to find optimal employee
    }

    private function searchForHandyman($requestHandyman)
    {


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

    public function checkTimeline($from, $to, $day, User $handyman)
    {
        $flag = true;
        for ($i = (int)$from; $i <= (int)$to; $i = $i + 100) {
            $hour = str_pad($i, 4, "0", STR_PAD_LEFT);
            if ($handyman->timeline[$day][$hour] == false) {
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
        })->where('day', $day)->where('status', '!=', 'done');
        for ($i = (int)$from; $i <= (int)$to; $i = $i + 100) {
            $requestsq->where('from', str_pad($i, 4, "0", STR_PAD_LEFT));
        }
        return $requestsq->count() == 0;
    }
}

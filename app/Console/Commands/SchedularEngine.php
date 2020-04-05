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
        $nowTime = Carbon::now()->timestamp;
        $request = RequestService::query()->where('status', 'pending')->where('employee_id', null)->get();
        foreach ($request as $req) {
            $handyman = $this->searchForHandyman($req);
            if ($handyman == null) {

            } else {
                $req->employee;
                $req->save();
            }

        }
        //1- getting all pending requests with status pending with no employee id
        //2- make algo to find optimal employee
    }

    private function searchForHandyman($requestHandyman)
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
        $requestsq = RequestService::query()->whereHas('employees', function ($q) use ($handyman) {
            $q->where('_id', $handyman->_id);
        })->where('day', $day)->where('status', '!=', 'done');
        //0800 or 08:00
        //0800 -> 1000
        for ($i = (int)$from; $i <= (int)$to; $i = $i + 100) {
            $requestsq->where('from', str_pad($i, 4, "0", STR_PAD_LEFT));
        }
        return $requestsq->count() == 0;
    }
}

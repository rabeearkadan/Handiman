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
use phpDocumentor\Reflection\Types\Integer;


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
        $requests = RequestService::query()->where('status', 'pending')->get();
        foreach ($requests as $req) {
            if ($req->employees()->count() == 0) {
                $this->searchForHandyman($req);
            }
        }
    }

    private function searchForHandyman(RequestService $requestHandyman)
    {
        $list = Service::query()->where('_id', $requestHandyman->service_id)->first();
        if ($list == null)
            return response()->json(['status' => 'error', 'message' => "no service found"]);
        $availableUsers = $list->users()->whereNotIn('_id', $requestHandyman->rejected_employees)
            ->where('_id', '!=', $requestHandyman->client_ids[0])
            ->where('isApproved', true)
            ->where('location', 'near', [
                '$geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        (float)$requestHandyman->client_address['location'][0],
                        (float)$requestHandyman->client_address['location'][1],
                    ],
                    'distanceField' => "dist.calculated",
                    '$maxDistance' => 50000,
                ],
            ])->orderBy('dist.calculated')->get();

        $var = Carbon::createFromFormat('Y-m-d H:i:s', $requestHandyman->date, $requestHandyman->timezone)->dayOfWeek;
        if ($var == 0) {
            $var = 6;
        } else {
            $var--;
        }
        $count = 0;
        foreach ($availableUsers as $handyman) {
            $flag1 = $this->checkTimeline($requestHandyman->from, $requestHandyman->to, $var, $handyman);
            $flag2 = $this->checkRequests($handyman, $requestHandyman->date, $requestHandyman->from, $requestHandyman->to);
            if ($flag1 && $flag2) {
                if ($requestHandyman->isurgent == true) {
                    $employee = User::query()->find($handyman->id);
                    $requestHandyman->employees()->attach($employee);
                    $count++;
                    $this->Notification($employee->employee_device_token, 'Admin', 'You received a new request', 'request');
                } else {
                    $count = -1;
                    $requestHandyman->employees()->attach($handyman);
                    $employee = User::query()->find($handyman->id);
                    $this->Notification($employee->employee_device_token, 'Admin', 'You received an urgent request', 'request');
                    break;
                }

            }
            $client = User::query()->find($requestHandyman->client_ids[0]);
            if ($count == 0) {
                $this->Notification($client->client_device_token, 'Admin', ' no results found, search on large area', 'request');
            } else if ($count == -1) {
                $this->Notification($client->client_device_token, 'Admin', ' Your request has reached employee', 'request');
            } else {
                $this->Notification($client->client_device_token, 'Admin', ' Your request has reached' . $count . ' employees', 'request');
            }
        }
        return true;
    }

    public function Notification($to, $from, $message, $type)
    {
        $notification = array();
        $notification['to'] = $to;
        $notification['user'] = $from;
        $notification['message'] = $message;
        $notification['type'] = $type;
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

    public function checkRequests(User $handyman, $date, $from, $to)
    {
        $flag = true;
        $hours = [];
        for ($i = (Integer)$from; $i < (Integer)$to; $i++) {
            array_push($hours, $i);
        }
        $handyman = User::query()->find($handyman->id);
        $requests = $handyman->employeeRequests()->where('idone', 'false')->get();
        foreach ($requests as $request) {
            if ($request->date->format('Y-m-d') == $date->format('Y-m-d')) {
                $request_from = $request->from;
                $request_to = $request->to;
                for ($i = $request_from; $i < $request_to; $i++) {
                    foreach ($hours as $hour) {
                        if ($hour == $i) {
                            $flag = false;
                            break;
                        }
                    }
                }
            }
        }
        return $flag;
    }
}

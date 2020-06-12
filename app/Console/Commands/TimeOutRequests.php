<?php

namespace App\Console\Commands;

use App\Events\NotificationSenderEvent;
use App\Models\RequestService;
use Carbon\Carbon;
use App\User;
use Illuminate\Console\Command;

class TimeOutRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:timeOutRequest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $requests = RequestService::query()->where('status', 'pending')->get();

        $nowTime = Carbon::now();
        foreach ($requests as $req) {
            $duration = $nowTime->diffInMinutes($req->updated_at);


            if ($req->employees()->count() > 0) {
                $client = User::query()->find($req->client_ids[0]);
                $handyman = User::query()->find($req->employee_ids[0]);
                $client_device = $client->client_device_token;
                $this->Notification($client_device, 'Admin', $duration, 'notification');

                $handyman_device = $handyman->employee_device_token;

                if ($duration > 30) {


                    $req->push('rejected_employees', $req->employee_ids[0]);
                    $this->Notification($handyman_device, 'Admin', $duration, 'notification');
                    $employee = User::find($req->employee_ids[0]);
                    $req->employees()->detach($employee);

                    if ($employee->rejects == null) {
                        $employee->rejects = 1;
                        $employee->save();
                    } else {
                        $rejects = (Integer)$employee->rejects;
                        $rejects++;
                        $employee->rejects = $rejects;
                        $employee->save();
                    }

                    foreach ($handyman->employee_request_ids as $s) {
                        if ($s != $req->id)
                            $employee_request_ids [] = $s;
                    }
                    $handyman->employeeRequests()->sync($employee_request_ids);

                } else if ($duration >= 20 && $duration <= 30) {
                    $this->Notification($handyman_device, 'Admin', 'You have less than 10 minutes to reply for pending requests', 'notification');

                }
            }
        }

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

}

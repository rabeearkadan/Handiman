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

        $this->Notification('d8M25IfgRRiJX8Q_Iu0B-0:APA91bHuD7Wl1hy5pOyaM3LrC053EoEgTOZHCyNcPV3SFmZwJ94Ce3QC7EzXCXHFeF3P4sEKNUt4GKRVybn6mAMw_uJRYItR35sn8xo29YsSaPM5N6Fjv4bq4ASelvCgPZA6_Gd1JlPh',
            'admin', 'testing the scheduler', 'comment');

        $nowTime = Carbon::now();
        $requests = RequestService::query()->where('status', 'pending')->get();
        foreach ($requests as $req) {
            if ($req->empolyees()->count() > 0) {
                $client = User::query()->find($req->client_ids[0]);
                $client_device = $client->client_device_token;
                $handyman = User::query()->find($req->employee_ids[0]);
                $handyman_device = $handyman->employee_device_token;
                $duration = $nowTime->diffInMinutes($req->updated_at);
                if ($duration > 30) {
                    $req->employees()->attach(null);
                    $req->save();
                    $this->Notification($client_device, 'Admin', "Handyman didn't respond, your request will be handled by the system", 'notification');
                } else if ($duration >= 20) {
                    $this->Notification($handyman_device, 'Admin', 'You have less than 10 minutes to reply for pending requests', 'notification');

                }
            }

        }
        //1- get all requests the status are pending, with employee ID and  the time of the request is greater than 30 min
        //2- un assign the request ; to allow the Scheduler Engine find another employee for the request
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

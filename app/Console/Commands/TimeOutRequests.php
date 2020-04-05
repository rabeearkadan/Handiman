<?php

namespace App\Console\Commands;

use App\Models\RequestService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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

        $nowTime = Carbon::now();
        $requests = RequestService::query()->where('status', 'pending')->get();
        foreach ($requests as $req) {
            if ( $req->empolyees()->count() > 0 ){
                $duration = $nowTime->diffInMinutes($req->updated_at);
                if ( $duration > 30 ){
                    // un register request for handyman
                    $req->employees()->attach(null);
                    $req->save();
                }else  if ($duration >= 20) {
                        //send notification reminder for employee

                }
            }

        }
        //1- get all requests the status are pending, with employee ID and  the time of the request is greater than 30 min
        //2- un assign the request ; to allow the Scheduler Engine find another employee for the request
    }

    public function searchForHandyman($request)
    {


    }
}

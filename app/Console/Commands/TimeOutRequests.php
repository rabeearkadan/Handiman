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

        $nowTime = Carbon::now()->timestamp;
        $requests = RequestService::query()->where('status', 'pending')->get();
        foreach ($requests as $req) {
            $duration = $nowTime->diffInMinutes($req->created_at);
            if ($duration >= 20) {
                $req->employee_id;
                $this->searchForHandyman($req);
                $req->save();
            }
        }
        //1- get all requests the status are pending, with employee ID and  the time of the request is greater than 30 min
        //2- un assign the request ; to allow the Scheduler Engine find another employee for the request
    }

    public function searchForHandyman($request)
    {
        

    }
}

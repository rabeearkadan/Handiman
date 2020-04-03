<?php

namespace App\Console\Commands;

use App\Models\RequestService;
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
        $request = RequestService::query()->where('status', 'pending')->where('employee_id', null);
        foreach ($request as $req) {
            if ($nowTime - $req > 10) {

            }
        }
        //1- getting all pending requests with status pending with no employee id
        //2- make algo to find optimal employee
    }
}

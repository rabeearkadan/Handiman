<?php

namespace App\Console\Commands;

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
        //1- getting all pending requests with status pending with no employee id
        //2- make algo to find optimal employee
    }
}

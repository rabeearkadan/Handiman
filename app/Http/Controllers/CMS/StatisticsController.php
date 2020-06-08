<?php


namespace App\Http\Controllers\CMS;


use App\Charts\Stats;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Redirect, Response;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function index()
    {
        $users = User::query()->where('role', 'user_employee' || 'employee');
        $chart = new Stats();
        $chart->labels($users->keys());
        $chart->dataset('My dataset 2', 'line', [$users, $users->created_at]);

        return view('cms.statistics.index', compact('chart'));
    }


}

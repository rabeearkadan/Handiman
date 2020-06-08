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
        $chart->labels(['Jan', 'Feb', 'Mar']);
        $chart->dataset('Users by trimester', 'line', [10, 25, 13]);
        return view('cms.statistics.index', compact('chart'));
    }


}

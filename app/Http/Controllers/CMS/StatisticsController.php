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
        $arr = [];
        foreach ($users as $user) {
            array_push($chart->labels, $user->name);
            array_push($arr, $users->created_at);
        }
        $chart->datasets = $arr;
//        $chart->color("rgb(255, 99, 132)");
//        $chart->backgroundcolor("rgb(255, 99, 132)");

        return view('cms.statistics.index', compact('chart'));
    }


}

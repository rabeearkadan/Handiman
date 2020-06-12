<?php


namespace App\Http\Controllers\CMS;


use App\Charts\Stats;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Redirect, Response;
use Carbon\Carbon;
use function GuzzleHttp\Promise\all;

class StatisticsController extends Controller
{
    public function index()
    {
        $users = User::query()->orderBy('visits', 'desc')->get();
        $chart = new Stats();
        $arr = [];
        $arr2 = [];
        foreach ($users as $user) {
            if ($user->visits != null) {
                array_push($arr2, $user->name);
                array_push($arr, $user->visits);
            }
        }
        $chart->labels($arr2);
        $chart->dataset('Most Visited Handyman', 'line', $arr)->color("rgb(0, 0, 255)")->backgroundcolor("rgb(0, 0, 255)");

        $chart2 = new Stats();
        $arr = [];
        $arr2 = [];
        foreach ($users as $user) {
            if ($user->gender != null) {
                array_push($arr2, $user->name);
                array_push($arr, $user->gender);
            }
        }
        $chart2->labels($arr2);
        $chart2->dataset('Genders', 'pie', $arr)->color("rgb(0, 0, 255)")->backgroundcolor("rgb(0, 0, 255)");


        return view('cms.statistics.index', compact('chart', 'chart2'));
    }

    public function services()
    {
        $users = User::query()->where('role', 'user_employee')->orWhere('role', 'employee');
        $chart = new Stats();
        $arr = [];
        $arr2 = [];
        foreach ($users as $user) {
            if ($user->service_ids != null) {
                array_push($arr2, $user->name);
                array_push($arr, sizeof($user->service_ids));
            }
        }
        $chart->labels($arr2);
        $chart->dataset('Most Visited Handyman', 'bar', $arr)->color("rgb(0, 0, 255)")->backgroundcolor("rgb(0, 0, 255)");

        return view('cms.statistics.services', compact('chart' ));

    }

}

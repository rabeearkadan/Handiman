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
        $users = User::query()->where('role', 'user_employee' || 'employee')
            ->pluck('visits', 'created_at')->where('_id', '5e7d3968e8deab6cd0066972');
        $chart = new Stats();
        $chart->labels($users->keys());
        $chart->dataset('My dataset 2', 'line', $users->values());

        return view('cms.statistics.index', compact('chart'));
    }

    public function pieChart()
    {
        $record = User::select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as day_name"), DB::raw("DAY(created_at) as day"))
            ->where('created_at', '>', Carbon::today()->subDay(6))
            ->groupBy('day_name', 'day')
            ->orderBy('day')
            ->get();

        $data = [];

        foreach ($record as $row) {
            $data['label'][] = $row->day_name;
            $data['data'][] = (int)$row->count;
        }

        $data['chart_data'] = json_encode($data);
        return view('cms.statistics.index', $data);

    }
}

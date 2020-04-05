<?php


namespace App\Http\Controllers\CMS;


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


        $dataPoints = array(
            array("label" => "Chrome", "y" => 64.02),
            array("label" => "Firefox", "y" => 12.55),
            array("label" => "IE", "y" => 8.47),
            array("label" => "Safari", "y" => 6.08),
            array("label" => "Edge", "y" => 4.29),
            array("label" => "Others", "y" => 4.59)
        );
        return view('cms.statistics.index', compact($dataPoints));
    }

    public function pieChart()
    {
        $record = User::select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as day_name"),DB::raw("DAY(created_at) as day"))
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

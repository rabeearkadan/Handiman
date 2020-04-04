<?php


namespace App\Http\Controllers\CMS;


use App\Http\Controllers\Controller;

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
}

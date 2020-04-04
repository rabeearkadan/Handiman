<?php


namespace App\Http\Controllers\CMS;


use App\Http\Controllers\Controller;

class StatisticsController extends Controller
{
    public function index()
    {
        return view('cms.statistics.index');
    }
}

<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\RequestService;

class ReportsController extends Controller
{

    public function index()
    {
        $reports = RequestService::query()->where('report', '!=', null);

        return view('cms.reports.index', compact('reports'));
    }

}

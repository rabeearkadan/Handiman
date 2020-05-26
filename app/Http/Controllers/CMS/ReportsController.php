<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\RequestService;
use App\Models\Service;
use App\User;

class ReportsController extends Controller
{

    public function index()
    {
        $_requests = RequestService::query()->where('isdone', true);


        $requests = $_requests->map(function ($item) {
            $item->client = User::query()->find($item->client_ids[0])->simplifiedArray();
            $item->handyman = User::query()->find($item->employee_ids[0])->simplifiedArray();
            $item->service = Service::query()->find($item->service_id)->ServiceArray();
            return $item;
        });
        return view('cms.reports.index', compact('requests'));
    }

    public function show($id)
    {
        $request = RequestService::query()->find($id);
        return view('cms.reports.show', compact('request'));
    }

}

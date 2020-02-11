<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function showAdminHomePage()
    {
        return view('cms.dashboard.index');
    }

    public function showChartsPage()
    {
        return view('cms.layouts.charts');
    }

    public function showUsers()
    {
        return view('cms.layouts.users', ['users' => User::all()]);

    }
    //try it now

}

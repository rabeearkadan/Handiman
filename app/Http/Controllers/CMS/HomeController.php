<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index()
    {
        Session::put('test', Auth::user()->name);
        return view('cms.dashboard.index', ['admin' => Auth::user()]);
    }

    public function showChartsPage()
    {
        return view('cms.layouts.charts');
    }

    public function showUsers()
    {
        return view('cms.layouts.users', ['users' => User::all()]);

    }

}

<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    //
    public function index()
    {
       $admin= User::query()->find(Auth::id());
        Session::put('name',$admin->name);
        if ($admin->image!=null)
            Session::put('image', Auth::user()->image);
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

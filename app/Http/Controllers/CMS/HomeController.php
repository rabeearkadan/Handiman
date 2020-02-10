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
    //try it now

}

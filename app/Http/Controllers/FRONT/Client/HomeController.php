<?php

namespace App\Http\Controllers\FRONT\Client;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /** Functions
     * index()
     * service()
     */

    public function index( Request $request ){
        $posts = Post::orderBy('created_at','desc')->take(3)->get();
        return view ('front.client.home',compact('posts'));
    }

    public function service( Request $request , $id = null){
        $user = Auth::user();
        if ( $id == null ){
            $services = Service::all();
            return view ('front.client.services', compact('services'));
        }else{
            $service = Service::query()->find($id);
            return view ('front.client.service-users', compact(['service','user']));
        }
    }
    public function filterUsers(Request $request, $id){
        $service = Service::query()->find($id);
//        address
//        keyword
//        date
//        from
//        to
        return view ('front.client.service-users', compact(['service','user']));
    }
}

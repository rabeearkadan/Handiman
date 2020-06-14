<?php

namespace App\Http\Controllers\FRONT\Employee;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /** Functions
     * index()
     * requests()
     * reviews()
     */

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index( Request $request ){
            $posts = Post::orderBy('created_at', 'desc')->take(3)->get();
            $services = Service::all();
        if($request->input('logged') == true) {
            $logged = $request->input('logged');
            return view('front.employee.home', compact(['posts', 'services','logged']));
        }
        else{
            return view('front.employee.home', compact(['posts', 'services']));
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function requests(Request $request){
        return view('front.employee.');
    }


    public function reviews(Request $request){
            $user = Auth::user();
            $feedbacks = array();
            $counter = 0;
            foreach ($user->employeeRequests as $request) {
                if ($request->rating != null && $request->feedback != null && $request->isdone == true) {
                    $client = User::find($request->client_ids[0]);
                    array_push($feedbacks, [
                        'rating' => $request->rating,
                        'title' => $request->feedback[0]['title'],
                        'body' => $request->feedback[0]['body'],
                        'client' => [
                            'name' => $client->name,
                            'image' => $client->image,
                        ]
                    ]);
                    $counter++;
                }
            }



        return view('front.employee.reviews',compact('feedbacks'));
    }

}

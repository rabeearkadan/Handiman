<?php

namespace App\Http\Controllers\FRONT\Client;

use App\Http\Controllers\Controller;
use App\Models\RequestService;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{
    /** Functions
     *
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        $user = Auth::user();
        $requests = $user->clientRequests->where('isdone',true)->where('ispaid',true);
        $requests = $requests->map(function ($item) {
            $item->service_name = Service::find($item->service_id)->name;
            $item->employee = User::find($item->employee_ids[0]);
            return $item;
        });
        $services = Service::all();
        $all=0;
        $serviceCount = array();
        foreach($services as $service){
            $serviceCount[$service->name]=0;
            foreach ($requests as $request){
                if($request->service_id == $service->id){
                    $serviceCount[$service->name]++;
                    $all++;
                }
            }
        }
        return view('front.client.review',compact(['requests','services','serviceCount','all']));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request,$id)
    {
        //
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'rating' => 'required',
        ]);
        $requestService = RequestService::findOrFail($id);
        $requestService->rating = $request->rating;
        $requestService->feedback['title'] = $request->title;
        $requestService->feedback['body'] = $request->body;
        $requestService->save();
        return redirect()->route('client.reviews.index');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request, $id)
    {
        //
        return view('front.client.review');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

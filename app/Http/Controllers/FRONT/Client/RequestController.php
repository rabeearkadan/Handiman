<?php

namespace App\Http\Controllers\FRONT\Client;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        return view('front.client.request.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $service_id
     * @param null $user_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($service_id,$user_id = null)
    {
        //
        $user=Auth::user();
        $employee = User::find($user_id);
        $service = Service::find($service_id);
        return view('front.client.request.create',compact(['user','employee']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$user_id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //
        return view('front.client.request');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        //
        return view('front.client.request');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

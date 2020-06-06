<?php

namespace App\Http\Controllers\FRONT\Employee;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    /** Functions
     * index()
     * accept()
     * reject()
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        //requests
        $requests = Auth::user()->employeeRequests()->where('status', 'pending')->where('isurgent', false)->get();
        $requests = $requests->map(function ($item) {
            $item->service_name = Service::find($item->service_id)->name;
            $item->client = User::find($item->client_ids[0]);
            return $item;
        });
        //urgent requests
        $urgentRequests = Auth::user()->employeeRequests()->where('status', 'pending')->where('isurgent', true)->get();
        $urgentRequests = $urgentRequests->map(function ($item) {
            $item->service_name = Service::find($item->service_id)->name;
            $item->client = User::find($item->client_ids[0]);
            return $item;
        });
        //
        return view('front.employee.requests', compact(['requests', 'urgentRequests']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

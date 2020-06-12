<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\RequestService;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;

class RequestController extends Controller
{


    public function index()
    {
        $_requests = RequestService::all()->where('status', 'pending');

        $request = $_requests->map(function ($item) {
            $item->service = Service::query()->find($item->service_id)->ServiceArray();
            return $item;
        });

        $requests = $request->map(function ($item) {
            $item->client = User::query()->find($item->client_ids[0])->simplifiedArray();
            return $item;
        });

        return view('cms.requests.index', compact('requests'));

    }

    public function rejectedPayments()
    {
        $_requests = RequestService::all()->where('rejected_payment', '!=', null);

        $request = $_requests->map(function ($item) {
            $item->service = Service::query()->find($item->service_id)->ServiceArray();
            return $item;
        });

        $requests = $request->map(function ($item) {
            $item->client = User::query()->find($item->client_ids[0])->simplifiedArray();
            return $item;
        });


        return view('cms.requests.rejectedPayments', compact('requests'));
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


    public function show($id)
    {
        $request = RequestService::query()->find($id);
        if ($request != null)
            if ($request->employees()->count() > 0)
                $request->handyman = User::query()->find($request->employee_ids[0])->simplifiedArray();
            else
                $request->handyman = ['name' => 'still looking for handyman'];
        $request->client = User::query()->find($request->client_ids[0])->simplifiedArray();


        return view('cms.requests.show', compact('request'));

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


    public function destroy($id)
    {
        try {
            RequestService::query()->find($id)->delete();
        } catch (\Exception $e) {
        }

        return redirect()->route('request.index');
    }


}

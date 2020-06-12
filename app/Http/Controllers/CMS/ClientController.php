<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index()
    {
        //
        $clients = User::query()->where('role', 'user')->orWhere('role', 'user_employee')->get();

        //
        return view('cms.clients.index', compact('clients'));

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
    { $client = User::query()->find($id);
        $_requests = $client->clientRequests()->get();
        $requests = $_requests->map(function ($item) {
            if ($item->employee_ids[0]!=null) {
                $item->handyman = User::query()->find($item->employee_ids[0])->simplifiedArray();
            } else {
                $item->handyman = ['name' => 'still looking for handyman'];
            }
            return $item;
        });

        return view('cms.clients.show', compact('client', 'requests'));
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
            User::query()->find($id)->delete();
        } catch (\Exception $e) {
        }

        return redirect()->route('client.index');
    }
}

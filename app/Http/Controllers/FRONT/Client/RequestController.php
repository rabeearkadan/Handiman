<?php

namespace App\Http\Controllers\FRONT\Client;

use App\Http\Controllers\Controller;
use App\Models\RequestService;
use App\Models\Service;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        //
        $user=Auth::user();
        $employee = User::find($request->input('employee_id'));
        $service = Service::find($request->input('service_id'));
        return view('front.client.request.create',compact(['user','employee','service']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $req
     * @param $employee_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $req)
    {
        //
       // $this->validator($req->all())->validate();
        $requestHandyman = new RequestService();



        $requestHandyman->description = $req->input('description');
        $requestHandyman->status = 'ongoing';

//        $requestHandyman->location = explode(',', $req->input('location'));
        $requestHandyman->timezone = $req->timezone;//'Asia\Beirut'
        $requestHandyman->service_id = $req->input('service_id');
        //add attachment if exists

        if ($req->has('is_urgent') && $req->input('is_urgent')) {
            //search for urgent requests
            //if its urgent let the system search for a handiman and make a suggestion
            $requestHandyman->save();
            $handyman = $this->searchForHandyman($requestHandyman);
            if ($handyman == null) {
                // TODO: Implement searchForHandyman() method.
            } else {
                $requestHandyman->empolyee_id = $req->input('employee_id');
                $requestHandyman->type = 'urgent';
                $requestHandyman->save();
                $requestHandyman->clients()->attach(Auth::id());
//                $this->notification($handyman->device_token, Auth::user()->name, 'You received a new request', 'request');
//                return response()->json(['status' => 'success', 'message' => 'Your urgent request has reached a handyman']);

            }
        } else {
            if ($req->has('employee_id')) {
                $handyman = User::query()->find($req->input('employee_id'));
                $requestHandyman->type = 'specified';



                $requestHandyman->date = $req->input('date');//yyyy-mm-dd
                $this->notification($handyman->device_token, Auth::user()->name, 'You received a new request', 'request');
            }
            $requestHandyman->save();
            $requestHandyman->clients()->attach(Auth::id());
            if ($req->has('employee_id')) {
                $handyman = User::query()->find($req->input('employee_id'));
                $requestHandyman->employees()->attach($handyman->id);
            }
        }
        return view('front.client.request.index');
    }

    private function searchForHandyman($requestHandyman)
    {
        if (Carbon::now($requestHandyman->timezone)->minute > 30) {
            $nowHour = str_pad(Carbon::now($requestHandyman->timezone)->hour + 1, 2, '0', STR_PAD_LEFT) . '00';
            $nowNextHour = str_pad(Carbon::now($requestHandyman->timezone)->hour + 2, 2, '0', STR_PAD_LEFT) . '00';
        } else {
            $nowHour = str_pad(Carbon::now($requestHandyman->timezone)->hour, 2, '0', STR_PAD_LEFT) . '00';
            $nowNextHour = str_pad(Carbon::now($requestHandyman->timezone)->hour + 1, 2, '0', STR_PAD_LEFT) . '00';
        }

        $nowDay = Carbon::now()->dayOfWeek;
        $availableUsers = User::query()
            ->where('timeline.' . $nowDay . '.' . $nowHour, true)
            ->where('timeline.' . $nowDay . '.' . $nowNextHour, true)
            ->where('service_id', $requestHandyman->service_id)->where('location', 'near', [
                '$geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        $requestHandyman->location[0],
                        $requestHandyman->location[1],
                    ],
                    'distanceField'=> "dist.calculated",
                    '$maxDistance' => 50000000 ,
                ],
            ])->orderBy('dist.calculated')
            ->get()->filter(function ($item) use ($requestHandyman, $nowNextHour, $nowHour, $nowDay) {
                $userRequests = RequestService::query()
                    ->where('date', $nowDay)
                    ->where('from', $nowHour)
                    ->where('from', $nowNextHour)
                    ->where('employee_id', $item->id)
                    ->count();
                return $userRequests == 0;

            });
        return $availableUsers->first();
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

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'description' => ['required', 'string', 'min:15']
        ]);
    }

}

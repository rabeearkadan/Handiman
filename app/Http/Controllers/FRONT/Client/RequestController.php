<?php

namespace App\Http\Controllers\FRONT\Client;

use App\Events\NotificationSenderEvent;
use App\Http\Controllers\Controller;
use App\Models\RequestService;
use App\Models\Service;
use App\User;
use Carbon\Carbon;
use DateTime;
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
        $pendingRequests = Auth::user()->clientRequests()->where('status','pending')->get();
        $approvedRequests = Auth::user()->clientRequests()->where('status','approved')->get();
        $pendingRequests = $pendingRequests->map(function ($item) {
                $item->service_name = Service::find($item->service_id)->name;
                $item->employee = User::find($item->employee_ids[0]);
                return $item;
            });
        return view('front.client.request.index',compact(['pendingRequests','approvedRequests']));
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
        $startDate = new DateTime('now') ;
       //date("d/m/Y");
        echo $startDate->format('d/m/Y');
        $Days = array();
        $date = $startDate;
        $bool= false;
        for($x=0;$x<24;$x++) {
     //       $Days[$date->format('d/m/Y')] = array_fill(0, 24, true);
            $day = date('w', strtotime($date->format('Y-m-d')));
            echo $day." ";
            for ($hour=0;$hour<24;$hour++) {
                $Days[$date->format('d/m/Y')][$hour] = $employee->timeline[$day][$hour];
               // if()

            }
//            if($bool==false){
//
//            }
            $bool= true;
            $date->modify('+1 day');
        }
        dd($Days);
        return view('front.client.request.create',compact(['user','employee','service']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $req
     * @param $employee_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $req)
    {
        //
       // $this->validator($req->all())->validate();
        $requestHandyman = new RequestService();



        $requestHandyman->description = $req->input('description');
        $requestHandyman->status = 'pending';

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
        return redirect(route('client.request.index'));
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
    public function Notification($to, $from, $message, $type)
    {
        $notification = array();


        $notification['to'] = $to;
        $notification['user'] = $from;
        $notification['message'] = $message;
        $notification['type'] = $type;// maybe "notification", "comment(message)", "request","message"
        $notification['object'] = [];

        event(new NotificationSenderEvent($notification));

        return response()->json(['status' => 'success', 'notification' => $notification]);
    }

}

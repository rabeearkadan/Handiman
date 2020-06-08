<?php

namespace App\Http\Controllers\FRONT\Client;

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
     * service()
     * filterUsers()
     */

    public function index(Request $request)
    {
        $posts = Post::orderBy('created_at', 'desc')->take(3)->get();
        $services = Service::all();
        return view('front.client.home', compact(['posts', 'services']));
    }

    public function service(Request $request, $id = null)
    {
        $user = Auth::user();
        if ($id == null) {
            $services = Service::all();
            return view('front.client.services', compact('services'));
        } else {
            $service = Service::query()->find($id);
            $employees = $service->users;
            $employees = $employees->map(function ($item) use ($service) {
                $item->rating = $this->rating($item,$service->id);
                return $item;
            });
            return view('front.client.service-users', compact(['service', 'user', 'employees']));
        }
    }

    public function filterUsers(Request $request, $id)
    {
        $user = Auth::user();
        $service = Service::query()->find($id);
        $client_address = null;
        foreach ($user->client_addresses as $address) {
            if ($address['_id'] == $request->address) {
                $lng = $address['location']['0'];
                $lat = $address['location']['1'];
                $client_address = $address['_id'];
                break;
            }
        }
        $employees = User::query()
            ->where('role', 'user_employee')
            ->orWhere('role', 'employee')
            ->where('isApproved', true)
            ->where('jobs', 'like', "%\"{$id}\"%")
            ->where('location', 'near', [
                '$geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        (float)$lng,
                        (float)$lat,
                    ],
                    'distanceField' => "dist.calculated",
                    '$maxDistance' => 50,
                ],
            ])->orderBy('dist.calculated')
            ->get();
        $availableTimes = array();
        if ($request->availableTimes != null) {
            foreach ($request->availableTimes as $availableTime) {
                $elements = explode(', ', $availableTime);
                array_push($availableTimes, array(
                        'date' => $elements[0],
                        'from' => $elements[1],
                        'to' => $elements[2]
                    )
                );
            }
        }
        if (isset($request->date) && isset($request->from) && isset($request->to)) {
            array_push($availableTimes, array(
                    'date' => $request->date,
                    'from' => $request->from,
                    'to' => $request->to
                )
            );
        }
        if (!empty($availableTimes)) {
            $index = 0;
            foreach ($employees as $employee) {

                foreach ($availableTimes as $available) {
                    $day = date('w', strtotime($available['date']));
                    $day--;
                    if ($day == -1) {
                        $day = 6;
                    }
                    foreach ($employee->employeeRequests as $employeeRequest) {
                        if ($employeeRequest->isdone == false & $employeeRequest->date->format('m/d/Y') == $available['date']) {
                            for ($from = $employeeRequest->from; $from < $employeeRequest->to; $from++) {
                                $employee->timeline[$day][$from] = false;
                            }
                        }
                    }
                    for ($from = $available['from']; $from < $available['to']; $from++) {
                        if ($employee->timeline[$day][$from] == false) {
                            unset($employees[$index]);
                        }
                    }
                }
                $index++;
            }
        }
        $employees = $employees->map(function ($item) use ($service) {
            $item->rating = $this->rating($item,$service->id);
            return $item;
        });
        $keyword = $request->keyword;
        dd($service,$id,$employees);
        return view('front.client.service-users', compact(['service', 'user', 'keyword', 'client_address', 'availableTimes', 'employees']));
    }

    public function rating($employee, $service_id)
    {
        $rating = 0;
        $nbOfRatings = 0;
        foreach ($employee->employeeRequests as $request) {
            if ($request->service_id == $service_id) {
                if ($request->rating != null) {
                    $rating += $request->rating;
                    $nbOfRatings++;
                }
            }
        }
        if ($nbOfRatings != 0) {
            $rating = $rating / $nbOfRatings;
        }
        return $rating;
    }
}

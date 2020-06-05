<?php

namespace App\Http\Controllers\FRONT\Client;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /** Functions
     * myProfile()
     * editPassword()
     * editPayment()
     * updateImage()
     * destroyImage()
     * updateContact()
     * createAddress()
     * storeAddress()
     * editAddress()
     * updateAddress()
     * destroyAddress()
     * employeeProfile()
     * allReviews()
     */

    public function myProfile()
    {
        $user = Auth::user();
        return view('front.client.profile.edit-profile', compact('user'));
    }

    public function editPassword()
    {
        $user = Auth::user();
        return view('front.client.profile.password', compact('user'));
    }

    public function editPayment()
    {
        $user = Auth::user();
        return view('front.client.profile.payment', compact('user'));
    }

    //Client Profile Image
    public function updateImage(Request $request)
    {
        $user = Auth::user();
        $file = $request->file('image-input');
        $name = 'image_' . time() . '.' . $file->getClientOriginalExtension();
        if (!Storage::disk('public')->exists('profile')) {
            Storage::disk('public')->makeDirectory('profile');
        }
        if (Storage::disk('public')->putFileAs('profile', $file, $name)) {
            $user->image = 'profile/' . $name;
        } else {
            return view('front.client.profile.edit-profile', compact('user'));
        }
        $user->save();
        return redirect()->route('client.profile');
    }

    public function destroyImage()
    {
        $user = Auth::user();
        $user->image = "";
        $user->save();
        return redirect()->route('client.profile');
    }

    //Client Contact Information
    public function updateContact(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        return redirect()->route('client.profile');
    }

    // functions for Client Addresses
    public function createAddress(Request $request)
    {
        $user = Auth::user();
        return view('front.client.profile.create-address', compact('user'));
    }

    public function storeAddress(Request $request)
    {
        $user = Auth::user();
        $data = [
            "_id" => Str::random(24),
            "name" => $request->name,
            "type" => $request->type,
            "location" => [$request->lng, $request->lat],
            "street" => $request->street,
            "house" => $request->house,
            "zip" => $request->zip,
            "property_type" => $request->property,
            "contract_type" => $request->contract,
        ];
        $user->push('client_addresses', $data);
        $user->save();
        $user = Auth::user();
        return redirect()->route('client.profile');
    }

    public function editAddress($id)
    {
        $user = Auth::user();
        $address = null;
        foreach ($user->client_addresses as $client_address) {
            if ($client_address['_id'] == $id) {
                $address = $client_address;
                break;
            }
        }
        return view('front.client.profile.edit-address', compact(['user', 'address']));
    }

    public function updateAddress($id)
    {
        $user = Auth::user();
        // $user->push('locations', '');
        return view('front.client.profile.edit-profile', compact('user'));
    }

    public function destroyAddress($id)
    {
        $user = Auth::user();
        // $user->push('locations', '');
        return view('front.client.profile.edit-profile', compact('user'));
    }
    //end of functions for Client addresses


    //functions for employee Profiles

    public function employeeProfile($id, $employee_id)
    {
        $service = Service::find($id);
        $employee = User::find($employee_id);
        $feedbacks = array();
        $latest_feedbacks = array();
        $counter = 0;
        foreach ($employee->employeeRequests as $request) {
            if ($counter > 2) {
                break;
            }
            if ($request->rating != null && $request->feedback != null && $request->isdone == true) {
                $client = User::find($request->client_ids[0]);
                array_push($latest_feedbacks, [
                    'rating' => $request->rating,
                    'feedback' => $request->feedback,
                    'client' => [
                        'name' => $client->name,
                        'image' => $client->image,
                    ]
                ]);
                $counter++;
            }
        }
        $service_rating = array();
        foreach ($employee->services as $employee_service) {
            for ($index = 0; $index < 7; $index++) {
                $service_rating[$employee_service->id][$index] = 0;
            }
        }
        foreach ($employee->services as $employee_service) {
            $index = 0;
            $total = 0;
            $bool = false;
            foreach ($employee->employeeRequests as $request) {
                if ($request->service_id == $employee_service->id) {
                    if ($request->rating != null) {
                        $bool = true;
                        $client = User::find($request->client_ids[0]);
                        $feedbacks[$employee_service->id][$index] = [
                            'rating' => $request->rating,
                            'feedback' => $request->feedback,
                            'client' => [
                                'name' => $client->name,
                                'image' => $client->image,
                            ]
                        ];
                        $total += $request->rating;
                        $index++;
                        if ($request->rating > 4) {
                            $service_rating[$employee_service->id][5]++;
                        } elseif ($request->rating > 3) {
                            $service_rating[$employee_service->id][4]++;
                        } elseif ($request->rating > 2) {
                            $service_rating[$employee_service->id][3]++;
                        } elseif ($request->rating > 1) {
                            $service_rating[$employee_service->id][2]++;
                        } else {
                            $service_rating[$employee_service->id][1]++;
                        }
                    }
                }
            }
            if ($bool == true) {
                $service_rating[$employee_service->id][0] += $total / $index;
                $service_rating[$employee_service->id][6] += $index;
            }
        }
        $all_rating = array();
        for ($index = 0; $index < 7; $index++) {
            $all_rating[$index] = 0;
        }
        for ($index = 1; $index < 7; $index++) {
            foreach ($employee->services as $employee_service) {
                if ($service_rating[$employee_service->id][0] != 0) {
                    $all_rating[$index] += $service_rating[$employee_service->id][$index];
                }
            }
        }
        foreach ($employee->services as $employee_service) {
            if ($service_rating[$employee_service->id][0] != 0) {
                $all_rating[0] += $service_rating[$employee_service->id][0] * ($service_rating[$employee_service->id][6] / $all_rating[6]);
                for ($index = 1; $index < 6; $index++) {
                    $all_rating[$index] = ($all_rating[$index] / $all_rating[6]) * 100;
                }
            }
        }

        return view('front.client.employee-profile', compact(['employee', 'service', 'feedbacks', 'all_rating', 'service_rating', 'latest_feedbacks']));
    }

    public function allReviews($id, $employee_id)
    {
        try {
            $employee = User::findorFail($employee_id);
        } catch (ModelNotFoundException $e) {
            dd('failed laterszz');
        }
//        $feedbacks = array();
//        $counter=0;
//        foreach ($employee->employeeRequests as $request) {
//            if ($request->rating != null && $request->feedback != null && $request->isdone == true) {
//                $client = User::find($request->client_ids[0]);
//                array_push($feedbacks,[
//                    'rating' => $request->rating,
//                    'feedback' => $request->feedback,
//                    'client' => [
//                        'name' => $client->name,
//                        'image' => $client->image,
//                    ]
//                ]);
//                $counter++;
//            }
//        }
        return view('front.client.see-all-reviews', compact('employee'));
    }
}

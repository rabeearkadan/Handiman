<?php

namespace App\Http\Controllers\FRONT\Employee;

use App\Http\Controllers\Controller;
use App\Models\Service;
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
     * editSchedule()
     * updateSchedule()
     * editDocuments()
     * updateCV()
     * updateCR()
     * updateContact()
     * updateConnections()
     * updateAddress()
     * updateBiography()
     * updateServices()
     */

    public function myProfile(Request $request)
    {
        $user = Auth::user();
        $services = Service::all();
        if($request->input('incomplete')){
            $incomplete = $request->input('incomplete');
            $logged = $request->input('logged');
            return view('front.employee.profile.edit-profile',compact(['user','services','incomplete','logged']));
        }
        return view('front.employee.profile.edit-profile', compact(['user', 'services']));
    }

    public function editPassword()
    {

    }

    public function editPayment()
    {
        $user = Auth::user();
        return view('front.employee.profile.payment', compact('user'));
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
        return redirect()->route('employee.profile');
    }

    public function destroyImage()
    {
        $user = Auth::user();
        $user->image = "";
        $user->save();
        return redirect()->route('employee.profile');
    }


    public function editProfile()
    {

    }


    public function clientProfile($id)
    {

    }

    public function editSchedule()
    {
        $user = Auth::user();
        $periods = array();
        for ($day = 0; $day < 7; $day++) {
            $periods[$day] = array();
            $break = false;
            $index = 0;
            $from = 0;
            for ($hour = 0; $hour < 24; $hour++) {
                if ($user->timeline[$day][$hour] == true) {
                    if ($break == true && !empty($periods[$day])) {
                        $index++;
                    }
                    $break = false;
                    $periods[$day][$index] = array(
                        'from' => $from,
                        'to' => $hour + 1 - $from
                    );
                } else {
                    $break = true;
                    $from = $hour + 1;
                }
            }
        }
        return view('front.employee.profile.schedule', compact(['user', 'periods']));
    }

    public function updateSchedule(Request $request)
    {
        $user = Auth::user();
        $timeline = array();
        for ($i = 0; $i <= 23; $i++) {
            for ($j = 0; $j <= 6; $j++) {
                $timeline[$j][$i] = false;
            }
        }
        $periods = $request->periods;
        for ($day = 0; $day < 7; $day++) {
            if ($periods[$day] != null) {
                $period = explode(',', $periods[$day]);
                for ($index = 0; $index < sizeof($period); $index++) {
                    for ($from = $period[$index]; $from < $period[$index + 1]; $from++) {
                        $timeline[$day][$from] = true;
                    }
                    $index++;
                }
            }
        }
        $user->timeline = $timeline;
        $user->save();
        return redirect()->route('employee.schedule.edit');
    }

    public function editDocuments()
    {
        $user = Auth::user();
        return view('front.employee.profile.documents', compact('user'));
    }

    public function updateCV(Request $request)
    {
        $user = Auth::user();
        $file = $request->file('cv');
        $name = 'cv' . time() . '.' . $file->getClientOriginalExtension();
        if (!Storage::disk('public')->exists('cv')) {
            Storage::disk('public')->makeDirectory('cv');
        }
        if (Storage::disk('public')->putFileAs('cv', $file, $name)) {
            $user->cv = 'cv/' . $name;
        } else {
            return view('front.employee.profile.documents', compact('user'));
        }
        $user->save();
        return redirect()->route('employee.documents.edit');
    }

    public function updateCR(Request $request)
    {
        $user = Auth::user();
        $file = $request->file('criminal_record');
        $name = 'record_' . time() . '.' . $file->getClientOriginalExtension();
        if (!Storage::disk('public')->exists('criminal_records')) {
            Storage::disk('public')->makeDirectory('criminal_records');
        }
        if (Storage::disk('public')->putFileAs('criminal_records', $file, $name)) {
            $user->criminal_record = 'criminal_records/' . $name;
        } else {
            return view('front.employee.profile.documents', compact('user'));
        }
        $user->save();
        return redirect()->route('employee.documents.edit');
    }

    public function updateCertificate(Request $request)
    {
        $user = Auth::user();
        $file = $request->file('certificate');
        $name = 'certificate_' . time() . '.' . $file->getClientOriginalExtension();
        if (!Storage::disk('public')->exists('certificates')) {
            Storage::disk('public')->makeDirectory('certificates');
        }
        if (Storage::disk('public')->putFileAs('certificates', $file, $name)) {
            $user->certificate = 'certificates/' . $name;
        } else {
            return view('front.employee.profile.documents', compact('user'));
        }
        $user->save();
        return redirect()->route('employee.documents.edit');
    }

    public function updateContact(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'gender' => 'required'
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->gender == "male")
            $user->gender = $request->gender;
        if ($request->gender == "female")
            $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->save();
        return redirect()->route('employee.profile');
    }

    public function updateConnections(Request $request)
    {
        $user = Auth::user();
        $user->facebook = $request->facebook;
        $user->twitter = $request->twitter;
        $user->instagram = $request->instagram;
        return redirect(route('employee.profile'));
    }

    public function updateAddress(Request $request)
    {
        $user = Auth::user();
        $data = [
            "_id" => Str::random(24),
            "location" => [$request->lng, $request->lat],
            "street" => $request->street,
            "building" => $request->building,
            "zip" => $request->zip,
        ];
        $user->employee_address = $data;
        $user->save();
        return redirect()->route('employee.profile');
    }

    public function updateBiography(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'biography' => 'required|min:20|max:1500'
        ]);
        $user->biography = $request->biography;
        $user->save();
        return redirect()->route('employee.profile');
    }

    public function updateServices(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'services' => 'required|max:3',
        ]);
        $user->services()->detach();
        foreach ($request->services as $service) {
            $service = Service::find($service);
            $user->services()->attach($service);
        }
        $user->price = $request->price;
        $user->save();
        return redirect()->route('employee.profile');
    }
}

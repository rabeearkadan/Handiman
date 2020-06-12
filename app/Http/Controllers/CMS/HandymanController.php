<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\RequestService;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;

class HandymanController extends Controller
{
    public function index()
    {
        $employees = User::query()->where('role', 'employee')->orWhere('role', 'user_employee')->get();

        //
        return view('cms.employees.index', compact('employees'));
    }

    public function show($id)
    {

        $employee = User::query()->find($id);
        $_requests = $employee->employeeRequests()->get();
        $requests = $_requests->map(function ($item) {
            $item->client = User::query()->find($item->client_ids[0])->simplifiedArray();
            return $item;
        });

        $service_ids = $employee->service_ids;
        $services = [];
        $count = 0;
        if ($service_ids != null) {
            foreach ($service_ids as $_id) {
                $services[$count++] = Service::query()->find($_id);
            }
        }

        return view('cms.employees.show', compact('employee', 'requests', 'services'));

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function removeService($id1, Request $request)
    {
        $handyman = User::query()->find($id1);
        $service = Service::query()->find($request->input('id2'));
        $service->users()->detach($handyman->id);
        $handyman->services()->detach($request->input('id2'));
        return redirect()->route('employee.index');
    }

    public function destroy($id)
    {
        $user = User::query()->find($id);
        $requests = $user->employeeRequests()->get();
        $services = $user->services()->get();
        $posts = $user->posts()->get();
        foreach ($requests as $request) {
            $request->employees()->detach($user);
            $request->status = 'pending';
            $request->isurgent = true;
            $request->save();
        }
        foreach ($services as $service) {
            $service->users()->detach($user);
        }
        foreach ($posts as $post) {
            $post->tags()->detach();
            $post->users()->detach($user);
        }

        try {
            User::query()->find($id)->delete();
        } catch (\Exception $e) {
        }

        return redirect()->route('employee.index');
    }

    public function activate($id)
    {
        $user = User::query()->find($id);
        $user->isApproved = true;
        $user->save();
        return redirect()->route('employee.index');
    }

    public function deactivate($id)
    {
        $user = User::query()->find($id);
        $user->isApproved = false;
        $user->save();
        return redirect()->route('employee.index');
    }
}

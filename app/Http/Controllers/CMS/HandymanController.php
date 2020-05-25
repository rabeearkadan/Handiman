<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\RequestService;
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
        $requests=$employee->employeeRequests()->get();

        return view('cms.employees.show', compact('employee','requests'));

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

    public function destroy($id)
    {

        try {
            User::query()->find($id)->delete();
        } catch (\Exception $e) {
        }

        return redirect()->route('employee.index');
    }
    public function activate($id){
        $user=User::query()->find($id);
        $user->isApproved=true;
        $user->save();
        return redirect()->route('employee.index');
    }
    public function deactivate($id){
        $user=User::query()->find($id);
        $user->isApproved=false;
        $user->save();
        return redirect()->route('employee.index');
    }
}

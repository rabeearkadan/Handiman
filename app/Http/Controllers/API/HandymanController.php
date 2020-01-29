<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class HandymanController extends Controller
{
    //

    public function getHandyman()
    {

        $handymanList = User::query()->where('role', 'employee')->get();

        return response()->json(['status' => 'success', 'HandymanList' => $handymanList]);
    }



    public function getHandymanById($id)
    {

        $handyman = User::whereHas('roles', function ($query) {
            $query->where('role', 'employee');
        })->where('name', 'LIKE', $id)
            ->get();
        return response()->json(['status' => 'success', 'HandymanList' => $handyman]);
    }

    public function addPost(Request $request)
    {

    }

}

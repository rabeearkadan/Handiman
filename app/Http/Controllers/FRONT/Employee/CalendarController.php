<?php

namespace App\Http\Controllers\FRONT\Employee;

use App\Http\Controllers\Controller;
use App\Models\RequestService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Str;

class CalendarController extends Controller
{
    /** Functions
     * index()
     * show()
     */

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $userRequests = $user->employeeRequests->where('status', 'approved');
        $jobs = array();
        $jobsArray = array();
        $counter = 0;
        foreach ($userRequests as $userRequest) {
            ${"jobsArray" . $counter} = array();
            ${"jobsArray" . $counter}[' ' . $userRequest->date->format('Y')][' ' . $userRequest->date->format('m')][' ' . $userRequest->date->format('d')] = array([
                'startTime' => $userRequest->from,
                'endTime' => $userRequest->to,
                'text' => $userRequest->subject,
                'link' => 'calendar/' . $userRequest->id . '/show'
            ]);
            $jobs = array_merge_recursive($jobs, ${"jobsArray" . $counter});
            $counter++;
        }
        return view('front.employee.jobs.calendar', compact('jobs'));
    }

    public function show($id, Request $request)
    {
        $job = RequestService::findOrFail($id);
        $client = $job->clients()->first();
        $service = Service::find($job->service_id);
        return view('front.employee.jobs.show', compact(['job', 'client', 'service']));
    }

    public function addReceipt($id, Request $request)
    {
        $job = RequestService::findOrFail($id);
        $job->isdone = true;
        $receipt = array();
        $index = 0;
        foreach ($request->itemsName as $item) {
            $receipt[$index] = array([
                'name' => $request->itemsName[$index],
                'price' => $request->itemsPrice[$index],
                'qty' => $request->itemsQuantity[$index]
            ]);
            $index++;
        }
        $requestReceiptImages = $request->file('receiptImages');
        $receipt_images = array();
        foreach ($requestReceiptImages as $image) {
            $name = 'post_' . time() . Str::random(16). '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('receipt')) {
                Storage::disk('public')->makeDirectory('receipt');
            }
            if (Storage::disk('public')->putFileAs('receipt', $image, $name)) {
                $element = 'posts/' . $name;
                array_push($receipt_images, $element);
            }
        }
        $job->receipt_images = $receipt_images;

        $requestResultsImages = $request->file('resultsImages');
        $results_images = array();
        foreach ($requestResultsImages as $image) {
            $name = 'post_' . time() . Str::random(16). '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('result')) {
                Storage::disk('public')->makeDirectory('result');
            }
            if (Storage::disk('public')->putFileAs('result', $image, $name)) {
                $element = 'posts/' . $name;
                array_push($results_images, $element);
            }
        }
        $job->result_images = $results_images;
        dd($job);
        $job->save();
        return redirect(route('employee.calendar.show', $job->id));
    }
}

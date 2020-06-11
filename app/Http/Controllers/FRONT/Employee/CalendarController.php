<?php

namespace App\Http\Controllers\FRONT\Employee;

use App\Http\Controllers\Controller;
use App\Models\RequestService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $services = array();
        $counter = 0;
        foreach ($userRequests as $userRequest) {
            ${"jobsArray" . $counter} = array();
            ${"jobsArray" . $counter}[' ' . $userRequest->date->format('Y')][' ' . $userRequest->date->format('m')][' ' . $userRequest->date->format('d')] = array([
                'startTime' => $userRequest->from,
                'endTime' => $userRequest->to,
                'text' => $userRequest->subject,
                'link' => 'calendar/' . $userRequest->id . '/show'
            ]);
            ${"servicessArray" . $counter} = array();
            ${"servicesArray" . $counter}[$userRequest->service_id]= Service::find($userRequest->service_id)->indicator;
            $services = array_merge_recursive($services, ${"servicesArray" . $counter});
            $jobs = array_merge_recursive($jobs, ${"jobsArray" . $counter});
            $counter++;
        }
        $services = $this->array_unique_recursive($services);
        return view('front.employee.jobs.calendar', compact(['jobs','services']));
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
        $total=0;
        foreach ($request->itemsName as $item) {
            array_push($receipt, array([
                'name' => $request->itemsName[$index],
                'price' => $request->itemsPrice[$index],
                'qty' => $request->itemsQuantity[$index]
            ]));
            $total += $request->itemsPrice[$index] * $request->itemsQuantity[$index];
            $index++;
        }
        $job->receipt = $receipt;
        $job->total = $total;
        $requestReceiptImages = $request->file('receiptImages');
        $receipt_images = array();
        foreach ($requestReceiptImages as $image) {
            $name = 'receipt_' . time() . Str::random(16). '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('receipt')) {
                Storage::disk('public')->makeDirectory('receipt');
            }
            if (Storage::disk('public')->putFileAs('receipt', $image, $name)) {
                $element = 'receipts/' . $name;
                array_push($receipt_images, $element);
            }
        }
        $job->receipt_images = $receipt_images;

        $requestResultsImages = $request->file('resultsImages');
        $results_images = array();
        foreach ($requestResultsImages as $image) {
            $name = 'result_' . time() . Str::random(16). '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('result')) {
                Storage::disk('public')->makeDirectory('result');
            }
            if (Storage::disk('public')->putFileAs('result', $image, $name)) {
                $element = 'results/' . $name;
                array_push($results_images, $element);
            }
        }
        $job->result_images = $results_images;
        $job->save();
        return redirect(route('employee.calendar.show', $job->id));
    }
    function array_unique_recursive(array $arr) {
        if (array_keys($arr) === range(0, count($arr) - 1)) {
            $arr = array_unique($arr, SORT_REGULAR);
        }

        foreach ($arr as $key => $item) {
            if (is_array($item)) {
                $arr[$key] = $this->array_unique_recursive($item);
            }
        }

        return $arr;
    }
}

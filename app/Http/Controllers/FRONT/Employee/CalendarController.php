<?php

namespace App\Http\Controllers\FRONT\Employee;

use App\Http\Controllers\Controller;
use App\Models\RequestService;
use App\Models\Service;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CalendarController extends Controller
{
    /** Functions
     * index()
     * show()
     * addReceipt()
     * requestReschedule()
     * reschedule()
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
            array_push($receipt,[
                'name' => $request->itemsName[$index],
                'price' => $request->itemsPrice[$index],
                'qty' => $request->itemsQuantity[$index]
            ]);
            $total += $request->itemsPrice[$index] * $request->itemsQuantity[$index];
            $index++;
        }
        $job->receipt = $receipt;
        $job->total = $total;
        $requestReceiptImages = $request->file('receiptImages');
        $receipt_images = array();
        foreach ($requestReceiptImages as $image) {
            $name = 'receipt_' . time() . Str::random(16). '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('receipts')) {
                Storage::disk('public')->makeDirectory('receipts');
            }
            if (Storage::disk('public')->putFileAs('receipts', $image, $name)) {
                $element = 'receipts/' . $name;
                array_push($receipt_images, $element);
            }
        }
        $job->receipt_images = $receipt_images;

        $requestResultsImages = $request->file('resultsImages');
        $results_images = array();
        foreach ($requestResultsImages as $image) {
            $name = 'result_' . time() . Str::random(16). '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('results')) {
                Storage::disk('public')->makeDirectory('results');
            }
            if (Storage::disk('public')->putFileAs('results', $image, $name)) {
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

    public function requestReschedule($id){
        $employee = Auth::user();
        $job = RequestService::findOrFail($id);
        $duration = $job->to - $job->from;
        $startDate = new DateTime('now');
        $date= $startDate;
        $Days = array();
        $bool = false;
        $timepicker = array();
        $span = array();
        for ($x = 0; $x < 24; $x++) {
            $day = date('w', strtotime($date->format('Y-m-d')));
            $day--;
            if($day==-1){
                $day=6;
            }
            for ($hour = 0; $hour < 24; $hour++) {
                $Days[$date->format('m/d/Y')][$hour] = $employee->timeline[$day][$hour];
                if ($Days[$date->format('m/d/Y')][$hour] == true) {
                    $bool = true;
                }
            }
            $span[$date->format('m/d/Y')]['from']=24;
            $span[$date->format('m/d/Y')]['to']=0;
            foreach ($employee->employeeRequests as $employeeRequest) {
                if ($employeeRequest->isdone == false && $employeeRequest->date->format('m/d/Y') == $date->format('m/d/Y')) {
                    for ($from = $employeeRequest->from; $from < $employeeRequest->to; $from++) {
                        $Days[$date->format('m/d/Y')][$from] = false;
                        if ( $span[$date->format('m/d/Y')]['from']>$from){
                            $span[$date->format('m/d/Y')]['from']=$from;
                        }
                        if ( $span[$date->format('m/d/Y')]['to']<$from){
                            $span[$date->format('m/d/Y')]['to']=$from;
                        }
                    }
                }
            }
            for ($hour = 0; $hour < 24; $hour++) {
                if ($Days[$date->format('m/d/Y')][$hour] == true) {
                    $bool = true;
                }
            }
            if ($bool == false) {
                unset($Days[$date->format('m/d/Y')]);
            } else {
                $timepicker[$date->format('m/d/Y')] = array();
                $break = false;
                $index = 0;
                $from = 0;
                for ($hour = 0; $hour < 24; $hour++) {
                    if ($Days[$date->format('m/d/Y')][$hour] == true) {
                        if ($break == true && !empty($timepicker[$date->format('m/d/Y')])) {
                            $index++;
                        }
                        $break = false;
                        $timepicker[$date->format('m/d/Y')][$index] = array(
                            'from' => $from,
                            'to' => $hour + 1
                        );
                    } else {
                        $break = true;
                        $from = $hour + 1;
                    }
                }
            }
            $bool = false;
            $date->modify('+1 day');
        }

        $rescheduleOptimum =array();

        $date=$startDate;
        $optimum =999999;
        $chosenSlot=null;
        for($searchSpan=0;$searchSpan<10;$searchSpan++){
            foreach($timepicker[$date->format('m/d/Y')] as $timeSlot){
                $travelFrom=0;
                $travelTo=0;
                $travel=0;
                $makeSpan=0;
                $makeGaps =0;
                $localOptimum =999999;
                $timeSlotLength = $timeSlot['to'] - $timeSlot['from'];
                if($timeSlotLength < $duration){
                    continue;
                }
                elseif ($timeSlotLength == $duration){
                    foreach ($employee->employeeRequests as $employeeRequest) {
                        if ($employeeRequest->isdone == false && $employeeRequest->date->format('m/d/Y') == $date->format('m/d/Y')) {
                            if($employeeRequest->from ==  $timeSlot['to']){
                                $travelFrom=$this->distance($employeeRequest->client_address->location[1],$employeeRequest->client_address->location[0], $job->client_address->location[1], $job->client_address->location[0]);
                            }
                            if($employeeRequest->to == $timeSlot['from']){
                                $travelTo=$this->distance($employeeRequest->client_address->location[1],$employeeRequest->client_address->location[0], $job->client_address->location[1], $job->client_address->location[0]);
                            }
                        }
                    }
                    $travel = $travelFrom + $travelTo;
                    if($timeSlot['from']<$span[$date->format('m/d/Y')]['from']){
                        $makeSpan+= $span[$date->format('m/d/Y')]['from'] - $timeSlot['from'];
                    }
                    if($timeSlot['to']>$span[$date->format('m/d/Y')]['to']){
                        $makeSpan+= $timeSlot['to'] - $span[$date->format('m/d/Y')]['to'] ;
                    }
                    //calculate optimum
                    $localOptimum=0.6*$travel+0.2*$makeSpan+0.2*$makeGaps;
                    if($localOptimum<$optimum){
                        $optimum=$localOptimum;
                        $chosenSlot = array([
                            'date'=> $date->format('d/m/Y') ,
                            'from' => $timeSlot['from'],
                            'to' => $timeSlot['to']
                        ]);
                }
                }
                else{
                    for($from=$timeSlot['from'];$from<$timeSlot['to']-$duration;$from++){
                        $travelFrom=0;
                        $travelTo=0;
                        $travel=0;
                        $makeSpan=0;
                        if($from=$timeSlot['from'] || $from == $timeSlot['to']-$duration-1) {
                            $makeGaps = 0;
                        }
                        else{
                            $makeGaps=2;
                        }
                        foreach ($employee->employeeRequests as $employeeRequest) {
                            if ($employeeRequest->isdone == false && $employeeRequest->date->format('m/d/Y') == $date->format('m/d/Y')) {
                                if($employeeRequest->from ==  $timeSlot['to']){
                                  $travelFrom=$this->distance($employeeRequest->client_address->location[1],$employeeRequest->client_address->location[0], $job->client_address->location[1], $job->client_address->location[0]);
                                }
                                if($employeeRequest->to == $timeSlot['from']){
                                    $travelTo=$this->distance($employeeRequest->client_address->location[1],$employeeRequest->client_address->location[0], $job->client_address->location[1], $job->client_address->location[0]);

                                }
                            }
                        }
                        $travel = $travelFrom + $travelTo;
                        if($from<$span[$date->format('m/d/Y')]){
                            $makeSpanFrom = true;
                        }
                        if($from+$duration>$span[$date->format('m/d/Y')]){
                            $makeSpanTo = true;
                        }
                        $localOptimum=0.6*$travel+0.2*$makeSpan+0.2*$makeGaps;
                        if($localOptimum<$optimum){
                            $optimum=$localOptimum;
                            $chosenSlot = array([
                                'date'=> $date->format('d/m/Y') ,
                                'from' => $timeSlot['from'],
                                'to' => $timeSlot['to']
                            ]);
                }
                    }
                }

            }

            $date->modify('+1 day');
        }

dd($chosenSlot);


        return view('front.employee.jobs.show', compact(['job', 'client', 'service','reschedule','rescheduleOptions']));
    }

    public function reschedule($id){
        //change date time
        //notify user
        // change status
//        $job = RequestService::findOrFail($id);
//        $job->status = "rescheduled";
//        $job->date = ;
//        $job->from = ;
//        $job->to = ;
//        $job->save();
        //pending requests
    }
    public function distance($lat1, $lon1, $lat2, $lon2)
    {

        $theta = $lon1 - $lon2;

        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));

        $dist = acos($dist);

        $dist = rad2deg($dist);

        $miles = $dist * 60 * 1.1515;

            return round($miles, 2);

    }
}

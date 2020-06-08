<?php

namespace App\Http\Controllers\API;

use App\Events\NotificationSenderEvent;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use  App\Models\RequestService;

use App\Models\Service;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Stripe\Exception\ApiConnectionException;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\AuthenticationException;
use Stripe\Exception\CardException;
use Stripe\Stripe;


class RequestController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'description' => ['required', 'string', 'min:15']
        ]);
    }


    public function makeRequest(Request $req)
    {
        $client = User::query()->find(Auth::id());
        $this->validator($req->all())->validate();
        $requestHandyman = new RequestService();
        $requestHandyman->subject = $req->input('subject');
        $requestHandyman->description = $req->input('description');
        $requestHandyman->status = 'pending';
        $requestHandyman->isdone = false;
        $requestHandyman->isurgent = false;
        $requestHandyman->rejected_employees = [];
        $requestHandyman->timezone = $req->timezone;
        $requestHandyman->service_id = $req->service_id;
        $address = null;
        foreach ($client->client_addresses as $client_address) {
            if ($client_address['_id'] == $req->address) {
                $address = $client_address;
                break;
            }
        }
        $requestHandyman->client_address = $address;

        if ($req->has('images')) {
            $imagesParam = $req->input('images');
            $images = [];
            foreach ($imagesParam as $image) {
                try {
                    $images[] = $this->uploadAny($image, 'requests', 'png');
                } catch (\Exception $e) {
                    return response()->json(['status' => 'error', 'message' => "error uploading image"]);
                }
            }
            $requestHandyman->images = $images;
        }

        if ($req->has('is_urgent')) {
            if ($req->input('is_urgent') == "true") {
                if (Carbon::now($requestHandyman->timezone)->minute > 30) {
                    $nowHour = (Carbon::now($requestHandyman->timezone)->hour + 1);
                    $nowNextHour = (Carbon::now($requestHandyman->timezone)->hour + 3);
                } else {
                    $nowHour = (Carbon::now($requestHandyman->timezone)->hour);
                    $nowNextHour = (Carbon::now($requestHandyman->timezone)->hour + 2);
                }
                $requestHandyman->from = $nowHour;
                $requestHandyman->to = $nowNextHour;
                $requestHandyman->isurgent = true;
                $requestHandyman->date = Carbon::createFromFormat('Y-m-d', date("Y-m-d"), $requestHandyman->timezone);

            } else {
                if ($req->has('from'))
                    $requestHandyman->from = $req->input('from');
                if ($req->has('to')) {
                    $requestHandyman->to = $req->input('to');
                }
                $requestHandyman->date = Carbon::createFromFormat('Y-m-d', $req->input('date'), $requestHandyman->timezone);
            }
            $requestHandyman->save();
            $requestHandyman->clients()->attach(Auth::id());

            return response()->json(['status' => 'success', 'message' => 'Your request has been sent to the scheduler']);

        } else {
            if ($req->has('employee_id')) {
                $handyman = User::query()->find($req->input('employee_id'));
                $requestHandyman->date = Carbon::createFromFormat('Y-m-d', $req->input('date'), $requestHandyman->timezone);

                if ($req->has('from'))
                    $requestHandyman->from = $req->input('from');
                if ($req->has('to')) {
                    $requestHandyman->to = $req->input('to');
                }
                $this->notification(($handyman->employee_device_token), (Auth::user()->name), 'You received a new request', 'request');
            }
            $requestHandyman->save();
            $requestHandyman->clients()->attach(Auth::id());
            if ($req->has('employee_id')) {
                $handyman = User::query()->find($req->input('employee_id'));
                $requestHandyman->employees()->attach($handyman->id);
            }
            return response()->json(['status' => 'success', 'message' => 'Please stay in touch for confirmation']);
        }


    }

    public function cancelRequest($id)
    {
        $request = RequestService::query()->find($id);
        if ($request->employees()->count > 0) {
            $handyman = User::query()->find($request->employee_ids[0]);
            $employee_request_ids = [];
            foreach ($handyman->employee_request_ids as $s) {
                $employee_request_ids[] = $s;
            }
            $this->notification($handyman->employee_device_token, Auth::user()->name, 'request has been canceled' .
                $request->subject, 'request');

        }
        $user = User::query()->find(Auth::id());

        $client_request_ids = [];
        foreach ($user->client_request_ids as $s) {
            if ($s != $id)
                $client_request_ids [] = $s;
        }

        $user->employeeRequests()->sync($employee_request_ids);
        $user->clientRequests()->sync($client_request_ids);


        $request->delete();

        return response()->json(['status' => 'success', 'message' => 'request is canceled']);


    }

    public function setPayment(Request $req, $id)
    {

        Stripe::setApiKey('sk_test_rPUYuVgziB8APOOSyd9q4zgT00rtI4Hhat');
        $request = RequestService::query()->find($id);
        $handyman = User::query()->find($request->employee_ids[0]);

        $total = $request->total;
        $user = User::query()->find($request->client_ids[0]);
        $token = $req->input('stripe_token');

        try {

            $charge = \Stripe\Charge::create([
                'amount' => (int)($total * 100),
                'currency' => 'USD',
                'description' => $user->name,
                'source' => $token,
                'capture' => true,
                'receipt_email' => $handyman->email,

            ]);

            if ($charge != null) {
                $this->notification($handyman->employee_device_token, 'Genie', 'check receipt', 'request');
                $handyman->balance = $handyman->balance + $total;
                $request->paid = true;
                $file_name = Str::random(25);
                $request->report = 'reports/pdf/' . $file_name . '.pdf';
                $request->save();
                $handyman->save();
                $this->stringToPDF($file_name, $request);
                return response()->json(['status' => 'success']);
            }

            return response()->json(['status' => 'error', 'message' => __('api.something-went-wrong')]);
        } catch (CardException $exception) {
            return response()->json(['status' => 'error', 'message' => __('api.card-decline')]);
        } catch (ApiConnectionException $e) {
            return response()->json(['status' => 'error', 'message' => __('api.something-went-wrong')]);
        } catch (ApiErrorException $e) {
            return response()->json(['status' => 'error', 'message' => __('api.something-went-wrong')]);
        } catch (AuthenticationException $e) {
            return response()->json(['status' => 'error', 'message' => __('api.something-went-wrong')]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => __('api.something-went-wrong')]);
        }


    }

    public
    function getHandymanRequests()
    {

        $pending = Auth::user()->employeeRequests()->where('status', 'pending')->get();

        if ($pending == null)
            return response()->json(['status' => 'success', 'message' => 'You have no ongoing requests']);
        $prequest = $pending->map(function ($item) {
            $item->client = User::query()->find($item->client_ids[0])->simplifiedArray();
            return $item;
        });
        $pending_request = $prequest->map(function ($item) {
            $item->service = Service::query()->find($item->service_id)->ServiceArray();
            return $item;
        });
        return response()->json(['status' => 'success', 'requests' => $pending_request]);
    }


    public
    function getHandymanJobs($id)
    {
        $handyman = User::query()->find($id);
        $outgoing = $handyman->employeeRequests()->where('status', 'approved')->get();

        if ($outgoing == null)
            return response()->json(['status' => 'success', 'message' => 'You have no ongoing requests']);
        $orequest = $outgoing->map(function ($item) {
            $item->client = User::query()->find($item->client_ids[0])->simplifiedArray();
            return $item;
        });
        $outgoing_request = $orequest->map(function ($item) {
            $item->service = Service::query()->find($item->service_id)->ServiceArray();
            return $item;
        });
        return response()->json(['status' => 'success', 'requests' => $outgoing_request]);
    }

    public
    function getHandymanTasks()
    {
        $outgoing = Auth::user()->employeeRequests()->where('status', 'approved')->get();

        if ($outgoing == null)
            return response()->json(['status' => 'success', 'message' => 'You have no ongoing requests']);
        $orequest = $outgoing->map(function ($item) {
            $item->client = User::query()->find($item->client_ids[0])->simplifiedArray();
            return $item;
        });
        $outgoing_request = $orequest->map(function ($item) {
            $item->service = Service::query()->find($item->service_id)->ServiceArray();
            return $item;
        });
        return response()->json(['status' => 'success', 'requests' => $outgoing_request]);
    }

    public
    function replyToRequest($id, Request $req)
    {
        $request = RequestService::query()->find($id);
        $request->status = $req->input('status');
        $request->isdone = false;
        $client = User::query()->find($request->client_ids[0]);
        $request->save();
        $this->notification($client->client_device_token, Auth::user()->name, 'Your request has been' . $request->status, 'request');
        return response()->json(['status' => 'success']);
    }

    public
    function getClientOngoingRequests()
    {
        $pending = Auth::user()->clientRequests()->where('status', 'pending')->get();

        if ($pending == null)
            return response()->json(['status' => 'success', 'message' => 'You have no ongoing requests']);
        else {


            $prequest = $pending->map(function ($item) {
                if ($item->employees()->count() > 0)
                    $item->handyman = User::query()->find($item->employee_ids[0])->simplifiedArray();
                return $item;
            });

            $pending_request = $prequest->map(function ($item) {
                $item->service = Service::query()->find($item->service_id)->ServiceArray();
                return $item;
            });
            return response()->json(['status' => 'success', 'requests' => $pending_request]);
        }
    }

    public function getClientOutgoingRequests()
    {

        $outgoing = Auth::user()->clientRequests()->where('status', 'approved')->get();

        if ($outgoing == null)
            return response()->json(['status' => 'success', 'message' => 'You have no ongoing requests']);
        else {


            $orequest = $outgoing->map(function ($item) {
                $item->handyman = User::query()->find($item->employee_ids[0])->simplifiedArray();
                return $item;
            });

            $outgoig_request = $orequest->map(function ($item) {
                $item->service = Service::query()->find($item->service_id)->ServiceArray();
                return $item;
            });
            return response()->json(['status' => 'success', 'requests' => $outgoig_request]);
        }
    }

    public function addReceiptImages(Request $req, $id)
    {
        $request = RequestService::query()->find($id);
        if ($req->has('images')) {
            $imagesParam = $req->input('images');
            $images = [];
            foreach ($imagesParam as $image) {
                try {
                    $images[] = $this->uploadAny($image, 'receipt', 'png');
                } catch (\Exception $e) {
                    return response()->json(['status' => 'error', 'message' => "error uploading image"]);
                }
            }
            $request->receipt_images = $images;
        }

        if ($req->has('result')){
            $imagesParam = $req->input('result');
            $images = [];
            foreach ($imagesParam as $image) {
                try {
                    $images[] = $this->uploadAny($image, 'receipt', 'png');
                } catch (\Exception $e) {
                    return response()->json(['status' => 'error', 'message' => "error uploading image"]);
                }
            }
            $request->result = $images;
        }

        $request->save();

        return response()->json(['status' => 'success']);

    }

    public
    function addReceipt($id, Request $req)
    {
        $request = RequestService::query()->find($id);
        $client = User::query()->find($request->client_ids[0]);
        $invoice = new Invoice();
        $receipt_items = [];
        foreach ($req->input('receipt') as $item) {
            array_push($receipt_items, json_decode($item));
        }
        $request->receipt = $invoice->receipt = $receipt_items;
        $request->total = (double)$invoice->total = (double)$req->input('total');
        $request->save();
        $invoice->save();
        $this->notification(($client->client_device_token), (Auth::user()->name), 'You received a receipt', 'request');


        return response()->json(['status' => 'success']);
    }


    public
    function reschedule($id, Request $req)
    {
        $request = RequestService::query()->find($id);
        $request->date = Carbon::createFromFormat('Y-m-d', $req->input('date'), $request->timezone);
        $request->from = $req->input('from');
        $request->to = $req->input('to');
        $client = User::query()->find($request->client_ids[0]);
        $this->notification(($client->client_device_token), (Auth::user()->name), 'The Handyman requested a reschedule', 'request');

        $request->save();
    }

    public
    function onRequestDone($id, Request $req)
    {
        $request = RequestService::query()->find($id);
        $request->isdone = true;
        $request->feedback = $req->input('feedback');
        $request->rating = (double)$req->input('rating');
        $request->save();


        return response()->json(['status' => 'success']);
    }

    function stringToPDF($file_name, $request)
    {
        $request->client = User::query()->find($request->client_ids[0])->simplifiedArray();
        $request->handyman = User::query()->find($request->employee_ids[0])->simplifiedArray();
        $request->service = Service::query()->find($request->service_id)->ServiceArray();

        $pdf = Pdf::loadView('cms.requests.report-pdf', compact('request'));


        if (!Storage::disk('public')->exists('reports')) {
            Storage::disk('public')->makeDirectory('reports');
        }


        $pdf->save('storage/reports/pdf/' . $file_name . '.pdf');
        return "true";

    }

    public
    function Notification($to, $from, $message, $type)
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


    public
    function uploadAny($file, $folder, $ext = 'png')
    {
        $file = base64_decode($file);

        $file_name = Str::random(25) . '.' . $ext; //generating unique file name;
        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }
        $result = false;
        if ($file != "") { // storing image in storage/app/public Folder
            $result = Storage::disk('public')->put($folder . '/' . $file_name, $file);

        }
        if ($result)
            return $folder . '/' . $file_name;
        else
            return null;
    }

}

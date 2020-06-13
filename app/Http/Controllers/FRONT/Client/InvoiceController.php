<?php

namespace App\Http\Controllers\FRONT\Client;
use App\Events\NotificationSenderEvent;
use App\Http\Controllers\Controller;
use App\Models\RequestService;
use App\Models\Service;
use App\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Stripe\Exception\ApiConnectionException;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\AuthenticationException;
use Stripe\Exception\CardException;
use Stripe\Stripe;


class InvoiceController extends Controller
{
    /** Functions
     * index()
     * create()
     * store()
     * show()
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        $user = Auth::user();
        $requests = $user->clientRequests->where('isdone',true);
        $requests = $requests->map(function ($item) {
            $item->service_name = Service::find($item->service_id)->name;
            $item->employee = User::find($item->employee_ids[0]);
            return $item;
        });
        $services = Service::all();
        $all = 0;
        $serviceCount = array();
        foreach($services as $service){
            $serviceCount[$service->name]=0;
            foreach ($requests as $request){
                if($request->service_id == $service->id){
                    $all++;
                    $serviceCount[$service->name]++;
                }
            }

        }
        return view ('front.client.invoice.index', compact(['requests','services','serviceCount','all']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request,$id)
    {
        //
        $user = Auth::user();
        Stripe::setApiKey('sk_test_rPUYuVgziB8APOOSyd9q4zgT00rtI4Hhat');
        $job = RequestService::query()->find($id);
        $employee = User::query()->find($job->employee_ids[0]);

        $total = $job->total;
        $token = $request->stripeToken;

        try {
        $charge = \Stripe\Charge::create([
            'amount' => (int)($total * 100),
            'currency' => 'USD',
            'description' => $user->name,
            'source' => $token,
            'capture' => true,
            'receipt_email' => $employee->email,
        ]);
        if ($charge != null) {
            $this->notification($employee->employee_device_token, 'Genie', 'check receipt', 'request');
            $employee->balance = $employee->balance + $total;
            $job->ispaid = true;
            $file_name = Str::random(25);
            $job->report = 'reports/pdf/' . $file_name . '.pdf';
            $job->save();
            $employee->save();
//            $this->stringToPDF($file_name, $job);
            return redirect()->route('client.invoice.index');
        }


        } catch (CardException $exception) {
            return redirect()->back()->withErrors($exception->getMessage());//key errors ['errors'=>'dfsdgsdfgsdfg']
            return redirect()->back()->with(['zabri'=>'l message yali badak heye']);
            return response()->json(['status' => 'error', 'message' => __('api.card-decline')]);
        } catch (ApiConnectionException $e) {
            return response()->json(['status' => 'error', 'message' => __('api.something-went-wrong1')]);
        } catch (ApiErrorException $e) {
            return response()->json(['status' => 'error', 'message' => __('api.something-went-wrong2')]);
        } catch (AuthenticationException $e) {
            return response()->json(['status' => 'error', 'message' => __('api.something-went-wrong3')]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => __('api.something-went-wrong4')]);
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //
        $request = RequestService::findOrFail($id);
          //  $item->service_name = Service::find($item->service_id)->name;
            $employee = User::find($request->employee_ids[0]);
            $service = Service::findOrFail($request->service_id);
        return view ('front.client.invoice.show', compact(['request','employee','service']));
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

    public function notification($to, $from, $message, $type)
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

}

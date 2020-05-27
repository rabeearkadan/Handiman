@extends('layouts.client.app')
@push('css')
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/tabs.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/requests-table.css')}}" rel="stylesheet">
@endpush
@section('content')
    <button class="tablink" onclick="openPage('Pending', this)" id="defaultOpen"> Pending</button>
    <button class="tablink approved" onclick="openPage('Approved', this)"> Approved</button>
    <div id="Pending" class="tabcontent">
        <div class="table-requests">
            <div class="header"> Pending Requests</div>
            <table>
                <tr>
                    <th> Employee</th>
                    <th> Subject</th>
                    <th> Service</th>
                    <th>Date & Time</th>
                    <th width="500"> Description</th>
                    <th width="230"></th>
                </tr>
                @foreach($pendingRequests as $request)
                    <tr>
                        <td>
                            @isset($request->employee_id)
                            <img src="{{config('image.path').$request->employee->image}}" alt=""/>
                            <p> {{$request->employee->name}} </p>
                            @else
                                <img src="/public/images/employee/profile-image.png" alt=""/>
                                <p> Still searching </p>
                                @endisset

                        </td>
                        <td> {{$request->subject}} </td>
                        <td> {{$request->service_name}}</td>
                        <td> Time </td>
                        <td style="text-align:left"> {{$request->description}} </td>
                        <td><a href="#" class="view-button"> View </a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div id="Approved" class="tabcontent">
        <div class="table-requests approved">
            <div class="header approved"> Approved Requests</div>
            <table class="approved">
                <tr class="approved">
                    <th> Employee</th>
                    <th> Subject</th>
                    <th> Service</th>
                    <th>Time</th>
                    <th width="500"> Description</th>
                    <th width="230"></th>
                </tr>
                @foreach($approvedRequests as $request)
                    <tr class="approved">
                        <td>
                            <img src="{{config('image.path')}}" alt=""/>
                            <p> {{$request->employee->name}} </p>
                        </td>
                        <td> {{$request->subject}} </td>
                        <td> {{$request->service_name}} </td>
                        <td> Time</td>
                        <td style="text-align:left;"> {{$request->description}} </td>
                        <td><a href="#" class="view-button approved"> View </a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script src="/public/js/client/tabs.js" type="text/javascript"></script>
@endpush

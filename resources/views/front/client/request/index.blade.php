@extends('layouts.client.app')
@push('css')
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/tabs.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/requests-table.css')}}" rel="stylesheet">
    <style>
        .material-placeholder{
            float: left;
            margin: 7px;
        }
    </style>
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
                            @isset($request->employee)
                            <img src="{{config('image.path').$request->employee->image}}" alt=""/>
                            <p> {{$request->employee->name}} </p>
                            @else
                                <img src="/public/images/employee/profile.png" alt=""/>
                                <p> Still searching </p>
                                @endisset

                        </td>
                        <td> {{$request->subject}} </td>
                        <td> {{$request->service_name}}</td>
                        <td> {{$request->date->format('d/m/Y')}} </td>
                        <td style="text-align:left"> {{$request->description}} </td>
                        <td><a href="#{{$request->id}}" class="waves-effect waves btn modal-trigger"> View </a></td>
                    </tr>
                    <div id="{{$request->id}}" class="modal bottom-sheet modal-fixed-footer" style="overflow:scroll;">
                        <div class="modal-content">
                            <h3 class="header">Request Details</h3>
                            <ul class="collection" >
                                <li class="collection-item avatar">
                                    @isset($request->employee)
                                    <img src="{{config('image.path').$request->employee->image}}" alt="employye image" class="circle">
                                    <span class="title">{{$request->employee->name}}</span>
                                        <a class="btn-floating btn-large red" style="float:right;margin-left: 30px">
                                            <i class="large material-icons">cancel</i>
                                        </a>
                                        <a class="btn-floating btn-large blue" style="float:right">
                                            <i class="large material-icons">chat</i>
                                        </a>
                                    @else
                                        <img src="/public/images/employee/profile.png" alt="" class="circle">
                                        <span class="title">Searching for employee</span>
                                    @endisset
                                </li>
                                <li class="collection-item avatar">
                                    <i class="material-icons circle">work</i>
                                    <span class="title">Service</span>
                                    <p>{{$request->service_name}}
                                    </p>
                                </li>
                                <li class="collection-item avatar">
                                    <i class="material-icons circle green">date_range</i>
                                    <span class="title">Date Time</span>
                                    <p>Date:{{$request->date->format('d/m/Y')}}
                                        <br>Time: {{$request->from}} -> {{$request->to}}
                                    </p>
                                </li>
                                <li class="collection-item avatar">
                                    <i class="material-icons circle green">info</i>
                                    <span class="title">Request</span>
                                    <p>Subject:{{$request->subject}}
                                        <br>Description: {{$request->description}}
                                    </p>
                                </li>
                                <li class="collection-item avatar">
                                    <i class="material-icons circle red">place</i>
                                    <span class="title">Address</span>
                                    <p> {{$request->client_address['name']}}
                                        <br> Street:{{$request->client_address['street']}}
                                        <br> Building: {{$request->client_address['house']}}
                                        <br> zip: {{$request->client_address['zip']}}
                                        <br> property type: {{$request->client_address['property_type']}}
                                        <br> contract type: {{$request->client_address['contract_type']}}
                                    </p>
                                </li>
                                <li class="collection-item avatar">
                                    <i class="material-icons circle red">image</i>
{{--                                    <span class="title">Images</span>--}}
                                    @foreach($request->images as $image)
                                        <img class="materialboxed"  width="250" src="{{config('image.path').$image}}">
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="modal-close waves-effect waves-red btn-flat">close</a>
                        </div>
                    </div>
                @endforeach
            </table>
        </div>
        @if($pendingRequests->count() == 0)
            <div class="container" style="background-size:contain;background-repeat: no-repeat; background-position: center;height: -webkit-fill-available;background-image:url('/public/images/client/pending-empty.png');">
            </div>
        @endif
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
                            <img src="{{config('image.path').$request->employee->image}}" alt=""/>
                            <p> {{$request->employee->name}} </p>
                        </td>
                        <td> {{$request->subject}} </td>
                        <td> {{$request->service_name}} </td>
                        <td> {{$request->date->format('d/m/Y')}}</td>
                        <td style="text-align:left;"> {{$request->description}} </td>
                        <td><a href="#{{$request->id}}" class="waves-effect waves btn modal-trigger" style="background-color: #219230"> View </a></td>
                    </tr>
                    <div id="{{$request->id}}" class="modal bottom-sheet modal-fixed-footer" style="overflow:scroll;">
                        <div class="modal-content">
                            <h3 class="header">Request Details</h3>
                            <ul class="collection" >
                                <li class="collection-item avatar">
                                    @isset($request->employee)
                                        <img src="{{config('image.path').$request->employee->image}}" alt="employee image" class="circle">
                                        <span class="title">{{$request->employee->name}}</span>
                                        <a class="btn-floating btn-large red" style="float:right;margin-left: 30px">
                                            <i class="large material-icons">cacel</i>
                                        </a>
                                        <a class="btn-floating btn-large blue" style="float:right">
                                            <i class="large material-icons">chat</i>
                                        </a>
                                    @else
                                        <img src="/public/images/employee/profile.png" alt="" class="circle">
                                        <span class="title">Searching for employee</span>
                                    @endisset
                                </li>
                                <li class="collection-item avatar">
                                    <i class="material-icons circle">work</i>
                                    <span class="title">Service</span>
                                    <p>{{$request->service_name}}
                                    </p>
                                </li>
                                <li class="collection-item avatar">
                                    <i class="material-icons circle green">date_range</i>
                                    <span class="title">Date and Time</span>
                                    <p>Date:{{$request->date->format('d/m/Y')}}
                                        <br>Time: {{$request->from}} -> {{$request->to}}
                                    </p>
                                </li>
                                <li class="collection-item avatar">
                                    <i class="material-icons circle green">info</i>
                                    <span class="title">Request</span>
                                    <p>Subject:{{$request->subject}}
                                        <br>Description: {{$request->description}}
                                    </p>
                                </li>
                                <li class="collection-item avatar">
                                    <i class="material-icons circle red">place</i>
                                    <span class="title">Address</span>
                                    <p> {{$request->client_address['name']}}
                                        <br> Street:{{$request->client_address['street']}}
                                        <br> Building: {{$request->client_address['house']}}
                                        <br> zip: {{$request->client_address['zip']}}
                                        <br> property type: {{$request->client_address['property_type']}}
                                        <br> contract type: {{$request->client_address['contract_type']}}
                                    </p>
                                </li>
                                <li class="collection-item avatar">
                                    <i class="material-icons circle red">image</i>
{{--                                    <span class="title">Images</span>--}}
                                    @foreach($request->images as $image)
                                    <img class="materialboxed"  width="250" src="{{config('image.path').$image}}">
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="modal-close waves-effect waves-red btn-flat">close</a>
                        </div>
                    </div>
                @endforeach
            </table>
        </div>
        @if($approvedRequests->count() == 0)
            <div class="container" style="background-size:contain;background-repeat: no-repeat;background-position: center;height: -webkit-fill-available;background-image:url('/public/images/client/approved-empty.png');">
            </div>
        @endif
    </div>

@endsection
@push('js')
    <script src="/public/js/client/tabs.js" type="text/javascript"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems);
        });
        $(document).ready(function(){
            $('.materialboxed').materialbox();
        });
        function cancelRequest(id){
            var result = confirm("Want to cancel this request?");
            if (result) {
                document.getElementById(id).submit();
            }
        }
    </script>
@endpush

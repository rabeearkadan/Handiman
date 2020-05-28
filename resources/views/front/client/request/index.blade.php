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
                                <img src="/public/images/employee/profile.png" alt=""/>
                                <p> Still searching </p>
                                @endisset

                        </td>
                        <td> {{$request->subject}} </td>
                        <td> {{$request->service_name}}</td>
                        <td> {{$request->date->format('d/m/Y')}} </td>
                        <td style="text-align:left"> {{$request->description}} </td>
                        <td><a href="#{{$request->id}}" class="waves-effect waves-light btn modal-trigger"> View </a></td>
                    </tr>
                    <div id="{{$request->id}}" class="modal bottom-sheet modal-fixed-footer" style="overflow:scroll;">
                        <div class="modal-content">
                            <h3 class="header">Request Details</h3>
                            <ul class="collection" style="overflow:scroll">
                                <li class="collection-item avatar">
                                    @isset($request->employee_id)
                                    <img src="" alt="" class="circle">
                                    <span class="title">{{$request->employee->name}}</span>
                                    <p>rating
                                        <br> Second Line
                                    </p>
                                    <a href="#!" class="secondary-content">
                                        <i class="material-icons">grade</i>
                                    </a>
                                    @else
                                        <img src="/public/images/employee/profile.png" alt="" class="circle">
                                        <span class="title">Searching for employee</span>
                                    @endisset
                                </li>
                                <li class="collection-item avatar">
                                    <i class="material-icons circle">folder</i>
                                    <span class="title">Service</span>
                                    <p>First Line
                                        <br> Second Line
                                    </p>
                                </li>
                                <li class="collection-item avatar">
                                    <i class="material-icons circle green">assessment</i>
                                    <span class="title">Date Time</span>
                                    <p>Date:
                                        <br>{{$request->date->format('d/m/Y')}}
                                    </p>
                                </li>
                                <li class="collection-item avatar">
                                    <i class="material-icons circle red">play_arrow</i>
                                    <span class="title">Address</span>
                                    <p>First Line
                                        <br> Second Line
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">close</a>
                        </div>
                    </div>
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
                        <td> {{$request->date->format('d/m/Y')}}</td>
                        <td style="text-align:left;"> {{$request->description}} </td>
                        <td><a href="#{{$request->id}}" class="waves-effect waves-light btn modal-trigger"> View </a></td>
                    </tr>
                    <div id="{{$request->id}}" class="modal bottom-sheet modal-fixed-footer" style="overflow:scroll;">
                        <div class="modal-content">
                            <h3 class="header">Request Details</h3>
                            <ul class="collection" style="overflow:scroll">
                                <li class="collection-item avatar">
                                    @isset($request->employee_id)
                                        <img src="" alt="" class="circle">
                                        <span class="title">{{$request->employee->name}}</span>
                                        <p>rating
                                            <br> Second Line
                                        </p>
                                        <a href="#!" class="secondary-content">
                                            <i class="material-icons">grade</i>
                                        </a>
                                    @else
                                        <img src="/public/images/employee/profile.png" alt="" class="circle">
                                        <span class="title">Searching for employee</span>
                                    @endisset
                                </li>
                                <li class="collection-item avatar">
                                    <i class="material-icons circle">folder</i>
                                    <span class="title">Service</span>
                                    <p>First Line
                                        <br> Second Line
                                    </p>
                                </li>
                                <li class="collection-item avatar">
                                    <i class="material-icons circle green">assessment</i>
                                    <span class="title">Date Time</span>
                                    <p>Date:
                                        <br>{{$request->date->format('d/m/Y')}}
                                    </p>
                                </li>
                                <li class="collection-item avatar">
                                    <i class="material-icons circle red">play_arrow</i>
                                    <span class="title">Address</span>
                                    <p>First Line
                                        <br> Second Line
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">close</a>
                        </div>
                    </div>
                @endforeach
            </table>
        </div>
    </div>

@endsection
@push('js')
    <script src="/public/js/client/tabs.js" type="text/javascript"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems);
        });
    </script>
@endpush

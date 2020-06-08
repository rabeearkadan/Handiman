@extends('layouts.employee.app')
@push('css')
{{--    <link href="{{asset('css/employee/collapsible.css')}}" rel="stylesheet" type="text/css">--}}
@endpush
@section('content')
    <div class="row">
        <div class="col l12" >
            <ul class="tabs tabs-fixed-width">
                <li class="tab col s6"><a class="active" href="#urgent">Urgent Requests</a></li>
                <li class="tab col s6"><a  href="#normalrequests">Requests</a></li>
            </ul>
        </div>
    </div>

<div id="urgent">
    <h4 style="color: darkred">Urgent Requests:</h4>
    @foreach($urgentRequests as $urgentRequest)
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-content">
                        <h5>{{$urgentRequest->subject}}</h5>
                        <p> {{$urgentRequest->description}}</p>
                    </div>
                    <div class="card-tabs">
                        <ul class="tabs tabs-fixed-width">
                            <li class="tab" ><a class="active" href="#{{$urgentRequest->id}}client">Client</a></li>
                            <li class="tab"><a  href="#{{$urgentRequest->id}}address">Address</a></li>
                            <li class="tab"><a href="#{{$urgentRequest->id}}images">Images</a></li>
                        </ul>
                    </div>
                    <div class="card-content grey lighten-4">
                        <div id="{{$urgentRequest->id}}client">
                            <ul class="collection" style="overflow:scroll">
                                <li class="collection-item avatar">
                                    <img src="{{config('image.path').$urgentRequest->client->image}}" alt="" class="circle">
                                    <span class="title">{{$urgentRequest->client->name}}</span>
                                    <p> <i class="material-icons">call</i> {{$urgentRequest->client->phone}}
                                        <br> Second Line
                                    </p>
                                    <a class="btn-floating btn-large red" style="float: right">
                                        <i class="large material-icons">chat</i>
                                    </a>
                                </li>
                                <li class="collection-item avatar">
                                    <i class="material-icons circle">work</i>
                                    <span class="title">Service</span>
                                    <p>{{$urgentRequest->service_name}}
                                        <br> Second Line
                                    </p>
                                </li>
                                <li class="collection-item avatar">
                                    <i class="material-icons circle green">date_range</i>
                                    <span class="title">Date and Time</span>
                                    <p>Date:{{$urgentRequest->date->format('d/m/Y')}}
                                        <br>Time: {{$urgentRequest->from}}->{{$urgentRequest->to}}
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <div id="{{$urgentRequest->id}}address">
                            <ul class="collection" style="overflow:scroll">
                                <li class="collection-item avatar">
                                    <i class="material-icons circle red">place</i>
                                    <span class="title">Address</span>
                                    <p>First Line
                                        <br> Second Line
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <div id="{{$urgentRequest->id}}images">
                            <div class="slider">
                                <ul class="slides">
                                    <li>
                                        <img src="/public/images/employee-home.png">
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <a class="waves-effect waves-light btn-small" style="float:right"><i class="material-icons left">reject</i>Accept</a>
                        <a class="waves-effect waves-light btn-small" style="float:right"><i class="material-icons left">accept</i>Reject</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
        @if($urgentRequests->count() == 0)
            <div class="container" style="background-size:contain;background-repeat: no-repeat; background-position: center;height: 300px;background-image:url('/public/images/employee/urgent-empty.png');">
            </div>
        @endif
</div>
    <div id="normalrequests">
<h4>Requests:</h4>
    @foreach($requests as $request)
    <div class="row">
    <div class="col-sm-12">
    <div class="card">
        <div class="card-content">
            <h5>{{$request->subject}}</h5>
            <p> {{$request->description}}</p>
        </div>
        <div class="card-tabs">
            <ul class="tabs tabs-fixed-width">
                <li class="tab"><a class="active" href="#{{$request->id}}client">Client</a></li>
                <li class="tab"><a  href="#{{$request->id}}address">Address</a></li>
                <li class="tab"><a href="#{{$request->id}}images">Images</a></li>
            </ul>
        </div>
        <div class="card-content grey lighten-4">
            <div id="{{$request->id}}client">
                <ul class="collection" style="overflow:scroll">
                    <li class="collection-item avatar">
                            <img src="{{config('image.path').$request->client->image}}" alt="" class="circle">
                            <span class="title">{{$request->client->name}}</span>
                            <p> <i class="material-icons">call</i> {{$request->client->phone}}
                                <br> Second Line
                            </p>
                        <a class="btn-floating btn-large red" style="float: right">
                            <i class="large material-icons">chat</i>
                        </a>
                    </li>
                    <li class="collection-item avatar">
                        <i class="material-icons circle">work</i>
                        <span class="title">Service</span>
                        <p>{{$request->service_name}}
                            <br> Second Line
                        </p>
                    </li>
                    <li class="collection-item avatar">
                        <i class="material-icons circle green">date_range</i>
                        <span class="title">Date Time</span>
                        <p>Date:{{$request->date->format('d/m/Y')}}
                            <br>Time: {{$request->from}}->{{$request->to}}
                        </p>
                    </li>
                </ul>
            </div>
            <div id="{{$request->id}}address">
                <ul class="collection" style="overflow:scroll">
                <li class="collection-item avatar">
                    <i class="material-icons circle red">place</i>
                    <span class="title">Address</span>
                    <p>First Line
                        <br> Second Line
                    </p>
                </li>
                </ul>
            </div>
            <div id="{{$request->id}}images">
                <div class="slider">
                    <ul class="slides">
                        <li>
                            <img src="/public/images/employee-home.png">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    @endforeach
        @if($requests->count() == 0)
            <div class="container" style="background-size:contain;background-repeat: no-repeat; background-position: center;height: 300px;background-image:url('/public/images/employee/request-empty.png');">
            </div>
        @endif
    </div>

@endsection
@push('js')
{{--    <script>--}}
{{--        var coll = document.getElementsByClassName("collapsible");--}}
{{--        var i;--}}

{{--        for (i = 0; i < coll.length; i++) {--}}
{{--            coll[i].addEventListener("click", function() {--}}
{{--                this.classList.toggle("active");--}}
{{--                var content = this.nextElementSibling;--}}
{{--                if (content.style.maxHeight){--}}
{{--                    content.style.maxHeight = null;--}}
{{--                } else {--}}
{{--                    content.style.maxHeight = content.scrollHeight + "px";--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}
{{--    </script>--}}

<script>
    var el = document.querySelectorAll('.tabs');
    var instance = M.Tabs.init(el);

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.slider');
        var instances = M.Slider.init(elems);
    });

</script>
@endpush

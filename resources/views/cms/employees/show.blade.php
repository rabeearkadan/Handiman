@extends('cms.layouts.app')

@section('content')

    <div class="row">

        <div class="col-lg-3 col-6">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <div
                            style="border-radius: 50%; height: 180px; width: 180px; margin-left: auto; margin-right: auto; border: 3px solid #adb5bd">
                            @if($employee->image!=null)
                                <div
                                    style="border-radius: 50%; height: 174px; width: 174px; background-size: cover;
                                        background-position: center center; border: 3px solid #fff;
                                        background-image: url({{config('image.path').$employee->image}})">

                                </div>
                            @else
                                <div
                                    style="border-radius: 50%; height: 174px; width: 174px; background-size: cover;
                                    background-position: center center; border: 3px solid #fff;
                                    background-image: url('https://mis.bau.edu.lb/web/v12/iConnectV12/admin/ProfileImage.aspx?ID=201801949&Code=F0DC386DD0')">

                                </div>

                            @endif
                        </div>

                    </div>
                    <h3 class="profile-username text-center">


                    </h3>

                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-success">
                <div class="inner">
                    {{--                    <h3 style=""> Full Name</h3>--}}
                    <p>Full Name:</p>
                    <p style="font-size: 2.2rem"> {{$employee->name}}</p>
                </div>

                <div class="icon">
                    <i class="ion ion-android-contact"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-5 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <p>Email:</p>

                    <p style="font-size: 2.2rem">  {{$employee->email}}</p>
                </div>

                <div class="icon">
                    <i class="ion ion-email"></i>
                </div>

            </div>
        </div>

    </div>


    {{--    <div class="tab-content">--}}
    {{--        <div class="tab-pane tabs-animation fade show active" id="tab-content-1" role="tabpanel">--}}
    {{--            <div class="row">--}}


    {{--                <div class="mb-3 text-center card card-body"><h5 class="card-title">Special Title Treatment</h5>With--}}
    {{--                    supporting text below as a natural lead-in to additional content.--}}
    {{--                    <button class="btn btn-danger">Go somewhere</button>--}}
    {{--                </div>--}}

    {{--                <div class="mb-3 text-right card card-body"><h5 class="card-title">Special Title Treatment</h5>With--}}
    {{--                    supporting text below as a natural lead-in to additional content.--}}
    {{--                    <button class="btn btn-outline-focus">Go somewhere</button>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}


    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Employee Services
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button class="active btn btn-focus">Last Week</button>
                            <button class="btn btn-focus">All Month</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Service Name</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($services as $service)
                            <tr>
                                <td class="text-center text-muted">{{$loop->index}}</td>

                                <td>
                                    <div class="widget-content-wrapper flex2">
                                        <div class="widget-heading">
                                            <div class="widget-subheading opacity-7"> {{$service['name']}}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <form
                                        action="{{route('employee.removeService',$employee->id)}}"
                                        method="GET"
                                    >
                                        <input value="{{$service->id}}" name="id" hidden>
                                        <button class="mb-2 mr-2 btn btn-danger">

                                            Remove
                                        </button>
                                    </form>


                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-block text-center card-footer">
                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
                            class="pe-7s-trash btn-icon-wrapper"> </i></button>
                    <button class="btn-wide btn btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Employee Requests
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button class="active btn btn-focus">Last Week</button>
                            <button class="btn btn-focus">All Month</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Client Name</th>
                            <th>Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($requests as $request)
                            <tr>
                                <td class="text-center text-muted">{{$loop->index}}</td>
                                <td>
                                    <div class="widget-content-wrapper flex2">
                                        <div class="widget-heading">
                                            <div
                                                class="widget-subheading opacity-7"> {{$request->client['name']}}
                                            </div>
                                        </div>
                                    </div>


                                </td>


                                <td>
                                    <div class="widget-content-left flex2">
                                        <div class="widget-heading">{{$request->date}}
                                        </div>

                                        <div class="widget-subheading opacity-7"> {{$request->from}}:00
                                            -- {{$request->to}}
                                            :00
                                        </div>
                                    </div>
                                </td>

                                @if($request->status=='pending')

                                    <td class="text-center">
                                        <div class="badge badge-warning">Pending</div>
                                    </td>

                                @elseif($request->status=='approved' && $request->isdone==false)
                                    <td class="text-center">
                                        <div class="badge badge-danger">In Progress</div>

                                    </td>
                                @else
                                    <td class="text-center">
                                        <div class="badge badge-success">Completed</div>

                                    </td>
                                @endif


                                <td class="text-center">
                                    <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm">
                                        Details
                                    </button>
                                </td>
                            </tr>


                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="d-block text-center card-footer">
                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
                            class="pe-7s-trash btn-icon-wrapper"> </i></button>
                    <button class="btn-wide btn btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('css')
    <style>
        @media (min-width: 1200px) {
            .col-lg-3 .small-box h3, .col-md-3 .small-box h3, .col-xl-3 .small-box h3 {
                font-size: 2.2rem;
            }
        }

        @media (min-width: 992px) {
            .col-lg-3 .small-box h3, .col-md-3 .small-box h3, .col-xl-3 .small-box h3 {
                font-size: 1.6rem;
            }
        }

        .small-box h3, .small-box p {
            z-index: 5;
        }

        .small-box h3 {
            font-size: 2.2rem;
            font-weight: 700;
            margin: 0 0 10px 0;
            padding: 0;
            white-space: nowrap;
        }

        .h3, h3 {
            font-size: 1.75rem;
        }

        .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
            margin-bottom: .5rem;
            font-family: inherit;
            font-weight: 500;
            line-height: 1.2;
            color: inherit;
        }

        h1, h2, h3, h4, h5, h6 {
            margin-top: 0;
            margin-bottom: .5rem;
        }

        *, ::after, ::before {
            box-sizing: border-box;
        }

        p {
            font-size: 2.2rem;
        }

        h3 {
            display: block;
            font-size: 1.17em;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
        }

        .card-primary.card-outline {
            border-top: 3px solid #007bff;
        }

        .card {
            box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
            margin-bottom: 1rem;
        }

        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }

        *, ::after, ::before {
            box-sizing: border-box;
        }

        h3 {
            display: block;
            font-size: 1.17em;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 10px;
            margin-inline-end: 0px;
            font-weight: bold;
        }

        .small-box h3, .small-box p {
            z-index: 5;
            font-size: 2.2rem;
        }

        .small-box p {
            font-size: 1rem;
            margin-left: 10px;
        }

        .bg-info, .bg-info > a {
            color: #fff !important;
        }

        .bg-info {
            background-color: #17a2b8 !important;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        *, ::after, ::before {
            box-sizing: border-box;
        }

        .profile-username {
            font-size: 21px;
            margin-top: 5px;
        }

        p {
            display: block;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
        }

        .bg-success, .bg-success > a {
            color: #fff !important;
        }

        .bg-success {
            background-color: #28a745 !important;
        }

        .small-box {
            border-radius: .25rem;
            box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
            display: block;
            margin-bottom: 20px;
            position: relative;
        }

        .small-box .icon > i {
            font-size: 90px;
            position: absolute;
            right: 15px;
            top: 15px;
            transition: all .3s linear;
        }

        .small-box .icon > i.fa, .small-box .icon > i.fab, .small-box .icon > i.far, .small-box .icon > i.fas, .small-box .icon > i.glyphicon, .small-box .icon > i.ion {
            font-size: 70px;
            top: 20px;
        }

        .bg-danger, .bg-danger > a {
            color: #fff !important;
        }

        .bg-danger {
            background-color: #dc3545 !important;
        }
    </style>
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
@endpush

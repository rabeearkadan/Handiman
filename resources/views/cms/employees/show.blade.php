@extends('cms.layouts.app')

@section('content')

    <div class="row">


        <div class="col-lg-3 col-6">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3> Full Name</h3>

                    <p> {{$employee->name}}</p>
                </div>

                <div class="icon">
                    <i class="ion ion-android-phone-portrait"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3> Email</h3>

                    <p>  {{$employee->email}}</p>
                </div>

                <div class="icon">
                    <i class="ion ion-email"></i>
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3> Balance</h3>
                    <p></p>
                    <p>33$</p>
                </div>

                <div class="icon">
                    <i class="ion ion-social-usd"></i>
                </div>

            </div>
        </div>


    </div>
    <div class="row">

        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                
            </div>
        </div>
    </div>
@endsection


@push('css')
    <style>


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
        .bg-danger, .bg-danger>a {
            color: #fff!important;
        }

        .bg-danger {
            background-color: #dc3545!important;
        }
    </style>
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
@endpush

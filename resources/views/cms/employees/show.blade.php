@extends('cms.layouts.app')

@section('content')

    <div class="row">


        <div class="col-lg-3 col-6">

            <div class="small-box bg-success">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3> test</h3>
                        <p>name</p>
                        <p> This profile belongs to {{$employee->name}}</p>
                    </div>

                    <div class="icon">
                        <i class="ion ion-bookmark"></i>
                    </div>
                </div>
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
        .bg-success, .bg-success>a {
            color: #fff!important;
        }

        .bg-success {
            background-color: #28a745!important;
        }
        .small-box {
            border-radius: .25rem;
            box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
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
    </style>
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
@endpush

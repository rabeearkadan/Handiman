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

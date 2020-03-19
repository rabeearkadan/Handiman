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

    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    @endpush

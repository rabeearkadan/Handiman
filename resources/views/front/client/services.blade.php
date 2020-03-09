@extends('layouts.client.app')
@push('css')
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/cards.css')}}" rel="stylesheet">
    <style>
        img:before {
            content: ' ';
            background-image: url();
        }
    </style>
@endpush
@section('content')
    <div class="container mt-2" id="services">
        <div class="row">
            @foreach($services as $service)
                @if ( $loop->index % 4 == 0 )
                  </div>
                  <div class="row">
                @endif
                <div class="col-md-3 col-sm-6">
                    <div class="card card-block">
                        <a href="{{route('client.service', $service->id)}}">
                            <img src="{{config('image.path').$service->image}}" alt="later">
                        </a>
                        <h5 class="card-title  mt-3 mb-3"> {{ $service->name }} </h5>
                        <p class="card-text">Somethinggggggg</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection







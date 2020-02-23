@extends('layouts.client.app')
@push('css')
    <link href="{{asset('css/client/cards.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div class="container" id="services">
        <div class="row">
            @foreach($services as $service)
                @if ( $loop->index % 4 == 0 )
                    </div>
                    <div class = "row">
                @endif
                <div class="column">
                    <a href="{{route('client.service', $service->id)}}"> <div class="card"> <img src="{{config('image.path').$service->image}}" > <label> {{ $service->name }} </label> </div> </a>
                </div>

            @endforeach
        </div>

    </div>
@endsection

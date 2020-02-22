@extends('layouts.client.app')

@section('content')
    <div class="container" id="services">
        <div class="row">
            @foreach($services as $service)
                @if ( $loop->index % 4 == 0 )
                    </div>
                    <div class = "row">
                @endif
                <div class="column">
                    <a href="{{route('client.service', $service->id)}}"> <div class="card"> <img src="{{$service->service_picture}}" > <label> {{ $service->name }} </label> </div> </a>
                </div>

            @endforeach
        </div>

    </div>
@endsection

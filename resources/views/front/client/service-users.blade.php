@extends('layouts.client.app')
@push('css')
    <link href="{{asset('css/client/cards.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div class="container" id="services">
        <div class="row">
            @foreach($service->users as $user)
                @if ( $loop->index  % 4 == 0 )
        </div>
        <div class = "row">
            @endif
            <div class="column">
                <a href="{{route('client.user-profile',[$service->id,$user->id])}}"> <div class="card"> <img src="{{'/storage/app/public/'.$user->profile_picture}}" > <label> {{$user->name}} </label> </div> </a>
            </div>

            @endforeach
        </div>

    </div>
@endsection

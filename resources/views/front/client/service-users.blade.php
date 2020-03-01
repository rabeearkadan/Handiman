@extends('layouts.client.app')
@push('css')
    <link href="{{asset('css/client/cards.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div class="container mt-2" id="services">
        <div class="row">
            @foreach($service->users as $user)
                @if ( $loop->index % 4 == 0 )
        </div>
        <div class="row">
            @endif
            <div class="col-md-3 col-sm-6">
                <div class="card card-block">
                    <a href="{{route('client.user-profile',[$service->id,$user->id])}}">
                        <img src="{{config('image.path').$user->image}}" alt="later">
                    </a>
                    <h5 class="card-title  mt-3 mb-3"> {{ $user->name }} </h5>
                    <p class="card-text">Somethinggggggg</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection







@extends('layouts.client.app')

@section('content')
    <div class="container" id="services">
        <div class="row">
            @foreach($service->users as $user)
                @if ( $loop->index  % 4 == 0 )
        </div>
        <div class = "row">
            @endif
            <div class="column">
                <a href="{{route('client.user-profile',$service->id,$user->id)}}"> <div class="card"> <img src="" > <label> {{$user->name}} </label> </div> </a>
            </div>

            @endforeach
        </div>

    </div>
@endsection

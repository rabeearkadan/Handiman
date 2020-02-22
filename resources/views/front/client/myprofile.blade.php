@extends('layouts.client.app')

@section('content')
    <div class="container" id="">
        <form method="post" action="{{route('client.edit-profile')}}">
            @method('put')
            @csrf
        </form>
    </div>>
@endsection

@extends('layouts.client.app')
@push('css')
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/tabs.css')}}" rel="stylesheet">
@endpush
@section('content')
<button class="tablink" onclick="openPage('Pending', this)" id="defaultOpen"> Pending</button>
<button class="tablink" onclick="openPage('Approved', this)"> Approved </button>
<div id="Pending" class="tabcontent">
    <h3>Pending</h3>
    <p>pending</p>
</div>

<div id="Approved" class="tabcontent">
    <h3>Approved</h3>
    <p> approved</p>
</div>
@endsection
@push('js')
    <script src="/public/js/client/tabs.js" type="text/javascript"></script>
@endpush

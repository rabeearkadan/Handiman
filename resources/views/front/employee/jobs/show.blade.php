@extends('layouts.employee.app')
@push('css')
    <link href="{{asset('css/employee/buttons.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/common-classes.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/forms.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/color-box.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/file-input.min.css')}}" rel="stylesheet">
@endpush
@section('content')
    <ul class="collapsible popout">
        <li>
            <div class="collapsible-header">
                <i class="material-icons">details</i>
                Request Details
            </div>
            <div class="collapsible-body">
                <span>Request client.</span>
                <span>Request.subject</span>
                <span>Request.desc</span>
            </div>
        </li>
        <li>
            <div class="collapsible-header">
                <i class="material-icons">home_repair_service</i>
                Service
            </div>
            <div class="collapsible-body">
                <span>Service type</span>

            </div>
        </li>
        <li>
            <div class="collapsible-header">
                <i class="material-icons">event</i>
                Date & Time
            </div>
            <div class="collapsible-body">
                <span>Date</span>
                <span>Time</span>
            </div>
        </li>
        <li>
            <div class="collapsible-header">
                <i class="material-icons">place</i>
                Second
            </div>
            <div class="collapsible-body">
                <span>Lorem ipsum dolor sit amet.</span>
            </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">images</i>
                Images</div>
            <div class="collapsible-body">
{{--                <img class="materialboxed"  width="250" src="{{config('image.path').$image}}">--}}
                </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">payment</i>
                bill</div>
            <div class="collapsible-body">
                <span>images.</span>
                <input type="file" name="images[]" id="input-file" accept="image/jpeg, image/png" multiple="multiple">
            </div>
        </li>
    </ul>
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large blue">
            <i class="large material-icons">chat</i>
        </a>

    </div>
    </body>
@endsection
@push('js')
    <script src="/public/js/employee/fileinput.min.js" type="text/javascript"></script>
    <script src="/public/js/employee/superlist.js" type="text/javascript"></script>
    <script src="/public/js/materialize.js" type="text/javascript"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.collapsible');
            var instances = M.Collapsible.init(elems);
        });

        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.fixed-action-btn');
            var instances = M.FloatingActionButton.init(elems);
        });
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.materialboxed');
            var instances = M.Materialbox.init(elems, options);
        });

    </script>
@endpush

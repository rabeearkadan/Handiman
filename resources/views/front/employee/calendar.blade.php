@extends('layouts.employee.app')
@push('css')
    <link href="{{asset('css/app.css')}}" rel="stylesheet" />
    <link href="{{asset('css/employee/calendar.css')}}" rel="stylesheet" />
@endpush
@section('content')
    <div id="calendarContainer"></div>
    <div id="organizerContainer"></div>
@endsection
@push('js')
    <script src="/public/js/employee/calendar.min.js"></script>
    <script>
        var calendar = new Calendar("calendarContainer", "large",
            [ "Monday", 3 ],
            [ "#ffc107", "#ffa000", "#ffffff", "#ffecb3" ],
            {
                days: [ "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday",  "Saturday" ],
                months: [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ],
                indicator: true,
                placeholder: "<span> No Jobs </span>"
            });
        var data = {

        };
        var organizer = new Organizer("organizerContainer", calendar, data);
    </script>
@endpush

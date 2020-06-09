@extends('layouts.employee.app')
@push('css')
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
            [ "#469CDB", "#4179cf", "#ffffff", "#97bffe" ],

            {
                days: [ "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday",  "Saturday" ],
                months: [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ],
                indicator: true,
                placeholder: "<span> No Jobs </span>"
            });
        var data = {
        @foreach($jobs as $year => $jobYear)
        {{ $year }}:
        {
            @foreach($jobYear as $month => $jobMonth)
            {{ $month }}:
            {
                @foreach($jobMonth as $day => $jobDay)
                {{ $day }}:
                [@foreach($jobDay as  $job)
                    {
                        startTime: "{{$job['startTime']}}",
                        endTime: "{{$job['endTime']}}",
                        text: "{{$job['text']}}",
                        link: "{{$job['link']}}"
                    }
                    @endforeach
                ]
                @endforeach
            }
            @endforeach
        }
        @endforeach
        };

        var organizer = new Organizer("organizerContainer", calendar, data);
    </script>
@endpush

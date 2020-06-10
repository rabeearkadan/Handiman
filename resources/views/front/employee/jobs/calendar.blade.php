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
                placeholder: '<div class="container" style="background-size:contain;background-repeat: no-repeat; background-position: center;height: 300px;background-image:url(\'/public/images/employee/jobs-empty.jpg\');">',
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
                [
                        @foreach($jobDay as  $job)
                    {
                        startTime: "{{$job['startTime']}}",
                        endTime: "{{$job['endTime']}}",
                        text: "{{$job['text']}}",
                        link: "{{$job['link']}}"
                    },
                    @endforeach
                ],
                @endforeach
            },
            @endforeach
        },
        @endforeach
        }
        var organizer = new Organizer("organizerContainer", calendar, data);
        var links = document.getElementsByTagName("a");
        @foreach($services as $id => $service)
        for(var i=0;i<links.length;i++)
        {
            alert('links['+i+'].href');
            alert('{{$id}}');
            alert(links[i].href.includes('{{$id}}'));
            if(links[i].href.includes('{{$id}}'))
            {
                alert('in');
                links[i].className = "calsc";
                    {{--style.color = "{{$service[0]}}";--}}
            }
        }
        @endforeach
    </script>
@endpush

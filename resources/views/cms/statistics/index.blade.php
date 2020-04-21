@extends('cms.layouts.app')

@section('content')

    <div class="row">

        <div id="chartContainer" style="height: 370px; width: 100%;"></div>

    </div>
@endsection
@push('js')

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
{{--    <script>--}}
{{--        window.onload = function () {--}}


{{--            var chart = new CanvasJS.Chart("chartContainer", {--}}
{{--                animationEnabled: true,--}}
{{--                title: {--}}
{{--                    text: "Usage Share of Desktop Browsers"--}}
{{--                },--}}
{{--                subtitles: [{--}}
{{--                    text: "November 2017"--}}
{{--                }],--}}
{{--                data: [{--}}
{{--                    type: "pie",--}}
{{--                    yValueFormatString: "#,##0.00\"%\"",--}}
{{--                    indexLabel: "{label} ({y})",--}}
{{--                    dataPoints: "@json($dataPoints)"--}}
{{--                }]--}}
{{--            });--}}
{{--            chart.render();--}}

{{--        }--}}
{{--    </script>--}}
@endpush

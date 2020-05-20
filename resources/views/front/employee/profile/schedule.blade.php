@extends('front.employee.profile.my-profile')
@push('css')
    <link href="{{asset('css/employee/jquery-ui.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/slider.css')}}" rel="stylesheet">
    <style>
        .p15 {
            padding: 0px;
        }
    </style>
@endpush
@section('profile-content')
    <div class="page-title">
        <h1>Schedule</h1>
    </div><!-- /.page-title -->
    <div id="pointer" class="range-value"></div>
    <form method="post" action="{{route('employee.schedule.update')}}">
        @csrf
        @method('put')
        <div class="background-white p15 mb30">
            <h3 class="page-title">
                Week-Days
                <input type="submit" value="Save" class="btn btn-primary btn-xs pull-right"/>
            </h3>
            @for($day=0;$day<7;$day++)
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="slider{{$day}}" class="col-sm-1 control-label"> {{date('D', strtotime("Sunday +{$day} days"))}}</label>
                    <div class="col-sm-11" style="margin-top: 12px;">
                        <div id="slider{{$day}}"></div>
                        <input type="hidden" id="periods{{$day}}" name="periods{{$day}}" value="">
                    </div><!-- /.col-* -->
                </div><!-- /.form-group -->
            </div><!-- /.form-inline -->
            @endfor
        </div><!-- /.background-white -->
    </form>
@endsection
@push('js')
    <script type="text/javascript" src="/public/js/employee/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="/public/js/employee/jquery-ui.js"></script>
    <script type="text/javascript" src="/public/js/employee/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="/public/js/employee/slider.js"></script>
    <script>
        @for($day=0;$day<7;$day++)
        $(function () {

            var intervals = new Intervals("#slider{{$day}}");
            intervals.addPeriod(1, 1);
            intervals.addPeriod(12, 6);
            // $("#form").submit(function(){
            //     //...
            //     // And somewhere later in the code
            //     var values = intervals.getPeriods().map(function (period) {
            //         return period.getAbscissas();
            //     });
            //
            //     $('#periods').val(values);
            //     alert($('#periods').val());
            // });
            intervals.setAddPeriodConfirmCallback(function (period, callback) {
                callback(function () {
                    return confirm('Add period between ' + period.getAbscissas()[0] + ' and ' + period.getAbscissas()[1]);
                }());
            });
            intervals.setDeletePeriodConfirmCallback(function (period, callback) {
                callback(function () {
                    return confirm('Delete period between ' + period.getAbscissas()[0] + ' and ' + period.getAbscissas()[1]);
                }());
            });
            intervals.setOnHandleSlideCallback(function (context, period, edgeIndex) {
                var handlePosition = context.offset().left;
                var yhandlePosition = context.offset().top;
                var periodId = period.getId();
                var handleAbscissa = period.getAbscissas()[edgeIndex];
                // $("#onhandleslide_infoo").html("Last OnHandleSlide data:" + "<br>" + " --- x-position: " + handlePosition + " px<br>" + " --- slider value (abscissa): " + handleAbscissa + "<br>" + " --- orientation: " + (edgeIndex === 1 ? "right" : "left") + " handle<br>" + "Period id: " + periodId + "<br>");
                $('#pointer').html("<span>"+handleAbscissa+"</span>");
                $('#pointer').show();
               // $('#pointer').css('top', yhandlePosition- $(window).scrollTop()-20);
                $('#pointer').css('left',handlePosition- $(window).scrollLeft() );
                var newValue = Number( (intervals.value - intervals.min) * 100 / (intervals.max - intervals.min) )
                var newPosition = 10 - (newValue * 0.2);
                $('#pointer').style.left = `calc(${newValue}% + (${newPosition}px))`;
            };
                return false;
            });
            intervals.setOnHandleMouseenterCallback(function (context, period, edgeIndex) {
                var handlePosition = context.offset().left;
                var yhandlePosition = context.offset().top;
                var periodId = period.getId();
                var handleAbscissa = period.getAbscissas()[edgeIndex];
                // $("#onhandlemouseenter_infoo").html("Last OnHandleMouseenter data:" + "<br>" + " --- x-position: " + handlePosition + " px<br>" + " --- slider value (abscissa): " + handleAbscissa + "<br>" + " --- orientation: " + (edgeIndex === 1 ? "right" : "left") + " handle<br>" + "Period id: " + periodId + "<br>");
                // $('#pointer').html(handleAbscissa);
                // $('#pointer').show();
                // $('#pointer').css('top', yhandlePosition- $(window).scrollTop()-20);
                // $('#pointer').css('left',handlePosition- $(window).scrollLeft() );
                // setTimeout(function () {
                //     $("#pointer").hide()
                // }, 5000);
            });
            intervals.setOnBeforeHandleSlideCallback(function (context, period, edgeIndex) {
                //return false;
            });
        });
        @endfor
    </script>
@endpush

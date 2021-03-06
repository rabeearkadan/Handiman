@extends('front.employee.profile.my-profile')
@push('css')
    <link href="{{asset('css/employee/jquery-ui.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/slider.css')}}" rel="stylesheet">
@endpush
@push('priority-css')
    <style>
        .p15 {
            padding: 2px;
        }
        @media screen and (max-width: 460px) {
            .col-sm-12 {
                padding-right: 5px;
                padding-left: 5px;
            }
        }
    </style>
@endpush
@section('outer-elements')
    <div id="pointer" class="range-value"></div>
@endsection
@section('profile-content')
    <div class="page-title">
        <h1>Schedule</h1>
    </div><!-- /.page-title -->
    <form method="post" id="scheduleForm" action="{{route('employee.schedule.update')}}">
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
                    <label for="slider{{$day}}" class="col-sm-1 control-label"> {{date('D', strtotime("Monday +{$day} days"))}}</label>
                    <div class="col-sm-11" style="margin-top: 12px;margin-bottom: 20px;">
                        <div class="col-sm-12">
                        <div id="slider{{$day}}"></div>
                        <input type="hidden" id="periods{{$day}}" name="periods[]">
                        </div><!-- /.col-* -->
                        <div class="col-sm-12">
                            <div class="ticks">
                            @for($hour=0;$hour<=24;$hour++)
                                    <span class="slider-tick-mark-main" style="left:{{$hour*3.987+2}}%;"></span>
                                    <span class="slider-tick-mark-main-text" style="left:{{$hour*3.987+2}}%;">{{$hour}}</span>
                                @endfor
                            </div><!-- /.ticks-* -->
                        </div><!-- /.col-* -->
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
            @foreach($periods[$day] as $period)
            intervals.addPeriod({{$period['from']}},{{$period['to']}});
            @endforeach
            $("#scheduleForm").submit(function(){
                //...
                // And somewhere later in the code
                var values = intervals.getPeriods().map(function (period) {
                    return period.getAbscissas();
                });

                $('#periods{{$day}}').val(values);
              //  alert($('#periods').val());
            });
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
            var timeout=null;
            intervals.setOnHandleSlideCallback(function (context, period, edgeIndex) {
                var handlePosition = context.offset().left;
                var yhandlePosition = context.offset().top;
                var periodId = period.getId();
                var handleAbscissa = period.getAbscissas()[edgeIndex];
                // $("#onhandleslide_infoo").html("Last OnHandleSlide data:" + "<br>" + " --- x-position: " + handlePosition + " px<br>" + " --- slider value (abscissa): " + handleAbscissa + "<br>" + " --- orientation: " + (edgeIndex === 1 ? "right" : "left") + " handle<br>" + "Period id: " + periodId + "<br>");
               if(timeout){
                    clearTimeout(timeout);
               }
                $("#pointer").stop(true);
                $('#pointer').html("<span>"+handleAbscissa+"</span>");
                $('#pointer').show();
                $('#pointer').css('top', yhandlePosition-35);
                $('#pointer').css('left',handlePosition+6);
                timeout = setTimeout(function () {
                    $("#pointer").hide()
                }, 5000);
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

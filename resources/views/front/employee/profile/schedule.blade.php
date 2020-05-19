@extends('front.employee.profile.my-profile')
@push('css')
    <link href="{{asset('css/employee/jquery-ui.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/slider.css')}}" rel="stylesheet">
@endpush
@section('profile-content')
    <div class="page-title">
        <h1>Schedule</h1>
    </div><!-- /.page-title -->

    <div class="background-white p20 mb30">
        <h3 class="page-title">
            Week-Days
            <input type="submit" value="Save" class="btn btn-primary btn-xs pull-right"/>
        </h3>
        <div class="form-horizontal">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">0</label>
                <div class="col-sm-9">
                    <div id="slider"></div>
                    <input type="hidden" id="periods" name="periods" value="">
                </div><!-- /.col-* -->
            </div><!-- /.form-group -->
        </div><!-- /.form-inline -->
    </div><!-- /.background-white -->
@endsection
@push('js')
    <script type="text/javascript" src="/public/js/employee/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="/public/js/employee/jquery-ui.js"></script>
    <script type="text/javascript" src="/public/js/employee/slider.js"></script>
    <script>
        $(function () {
            var intervals = new Intervals("#slider");
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
                // var handlePosition = context.offset().left;
                // var periodId = period.getId();
                // var handleAbscissa = period.getAbscissas()[edgeIndex];
                // $("#onhandleslide_infoo").html("Last OnHandleSlide data:" + "<br>" + " --- x-position: " + handlePosition + " px<br>" + " --- slider value (abscissa): " + handleAbscissa + "<br>" + " --- orientation: " + (edgeIndex === 1 ? "right" : "left") + " handle<br>" + "Period id: " + periodId + "<br>");
                return false;
            });
            intervals.setOnHandleMouseenterCallback(function (context, period, edgeIndex) {
                // var handlePosition = context.offset().left;
                // var periodId = period.getId();
                var handleAbscissa = period.getAbscissas()[edgeIndex];
                // $("#onhandlemouseenter_infoo").html("Last OnHandleMouseenter data:" + "<br>" + " --- x-position: " + handlePosition + " px<br>" + " --- slider value (abscissa): " + handleAbscissa + "<br>" + " --- orientation: " + (edgeIndex === 1 ? "right" : "left") + " handle<br>" + "Period id: " + periodId + "<br>");
                $('#pointer').html(handleAbscissa);
                $('#pointer').show();
                $('#pointer').css('top', event.pageY + 20);
                $('#pointer').css('left', event.pageX);
                setTimeout(function () {
                    $("#pointer").hide('blind', {}, 100)
                }, 5000);
            });
            intervals.setOnBeforeHandleSlideCallback(function (context, period, edgeIndex) {
                //return false;
            });
        });
    </script>
@endpush

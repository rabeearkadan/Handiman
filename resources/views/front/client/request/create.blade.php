@extends('layouts.client.app')
@push('css')
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/buttons.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/common-classes.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/requests/materialize.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/requests/file-uploader.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/color-box.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/requests/icons.css')}}" rel="stylesheet" media="screen">
@endpush
@section('content')
    <body>
    <div class="page-wrapper">
        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <div class="content">
                        @if($employee)
                            <div class="contact-form-wrapper clearfix background-white p30">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <img src="{{config('image.path').$employee->image}}" class="img-thumbnail"
                                             alt="employee">
                                        <h2>
                                            {{$employee->name}}
                                        </h2>
                                    </div>
                                    <div class="col-sm-10">
                                        <h3>will put employee info later here</h3>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <h3> The more you elaborate, the more we can help!</h3>
                        <div class="contact-form-wrapper clearfix background-white p30">
                            <form class="contact-form" method="post" action="{{route('client.request.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="contact-form-subject">Subject</label>
                                            <input type="text" name="subject" id="contact-form-subject"
                                                   class="form-control">
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->
                                </div><!-- /.row -->
                                <div class="form-group">
                                    <label for="contact-form-message"> Problem Description</label>
                                    <textarea class="form-control" id="contact-form-message" rows="6"></textarea>
                                </div><!-- /.form-group -->
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="date-input"> Pick a day </label>
                                            <input id="date-input" name="date" type="text" data-dd-theme="leaf">
                                        </div><!--/.form-group-->
                                    </div><!--/.col-*-->
                                </div><!--/.row-->
                                <button class="btn btn-primary pull-right"> Request</button>
                            </form><!-- /.contact-form -->
                        </div><!-- /.contact-form-wrapper -->
                    </div><!-- /.content -->
                </div><!-- /.container -->
            </div><!-- /.main-inner -->
        </div><!-- /.main -->
    </div><!-- /.page-wrapper -->
@endsection
@push('js')
        <script src="/public/js/client/requests/materialize.js"></script>
        <script src="/public/js/client/requests/drop-zone.js"></script>
        <script src="/public/js/client/requests/file-uploader.js"></script>
        <script src="/public/js/client/requests/date-dropper.pro.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#date-input').dateDropper({
                    enabledDays: '03/31/2020,04/10/2020',
                    maxYear: 2021,
                    minYear: 2020
                });
            });
        </script>
@endpush

@extends('layouts.client.app')
@push('css')
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/buttons.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/common-classes.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/requests/materialize.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/requests/file-uploader.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/color-box.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/requests/icons.css')}}" rel="stylesheet" media="screen">
    <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/select.css')}}" rel="stylesheet" type="text/css">
    <style>
        .pull-right {
            float: right;
        }

        .select-box {
            position: relative;
            display: block;
            width: 100%;
            margin: 0 auto;
            font-family: 'Open Sans', 'Helvetica Neue', 'Segoe UI', 'Calibri', 'Arial', sans-serif;
            font-size: 18px;
            color: #60666d;
        }

        .select-box__current {
            position: relative;
            box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            outline: rgb(132, 144, 111);
            outline-style: inset;
            outline-width: medium;
        }

        .select-box__current:focus + .select-box__list {
            opacity: 1;
            -webkit-animation-name: none;
            animation-name: none;
        }

        .select-box__current:focus + .select-box__list .select-box__option {
            cursor: pointer;
        }

        .select-box__current:focus .select-box__icon {
            -webkit-transform: translateY(-50%) rotate(180deg);
            transform: translateY(-50%) rotate(180deg);
        }

        .select-box__icon {
            position: absolute;
            top: 50%;
            right: 15px;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            width: 20px;
            opacity: 0.3;
            -webkit-transition: 0.2s ease;
            transition: 0.2s ease;
        }

        .select-box__value {
            display: -webkit-box;
            display: flex;
        }

        .select-box__input {
            display: none;
        }

        .select-box__input:checked + .select-box__input-text {
            display: block;
        }

        .select-box__input-text {
            display: none;
            width: 100%;
            margin: 0;
            padding: 15px;
            background-color: #fff;
        }

        .select-box__list {
            position: absolute;
            width: 100%;
            padding: 0;
            list-style: none;
            opacity: 0;
            -webkit-animation-name: HideList;
            animation-name: HideList;
            -webkit-animation-duration: 0.5s;
            animation-duration: 0.5s;
            -webkit-animation-delay: 0.5s;
            animation-delay: 0.5s;
            -webkit-animation-fill-mode: forwards;
            animation-fill-mode: forwards;
            -webkit-animation-timing-function: step-start;
            animation-timing-function: step-start;
            box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.1);
        }

        .select-box__option {
            display: block;
            padding: 15px;
            background-color: #fff;
        }

        .select-box__option:hover, .select-box__option:focus {
            color: #546c84;
            background-color: #fbfbfb;
        }

        @-webkit-keyframes HideList {
            from {
                -webkit-transform: scaleY(1);
                transform: scaleY(1);
            }
            to {
                -webkit-transform: scaleY(0);
                transform: scaleY(0);
            }
        }

        @keyframes HideList {
            from {
                -webkit-transform: scaleY(1);
                transform: scaleY(1);
            }
            to {
                -webkit-transform: scaleY(0);
                transform: scaleY(0);
            }
        }
    </style>
@endpush
@section('content')
    <body>
    <div class="page-wrapper">
        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <div class="content">
                        <form class="contact-form" method="post" action="{{route('client.request.store')}}">
                            @csrf
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
                                            <input type="hidden" name="employee_id" value="{{$employee->id}}">
                                            <input type="hidden" name="service_id" value="{{$service->id}}">
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <h3> The more you elaborate, the more we can help!</h3>
                            <div class="contact-form-wrapper clearfix background-white p30">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="subject">Subject</label>
                                            <input type="text" name="subject" id="subject" class="form-control">
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="subject"> <i class="fa fa-home" aria-hidden="true"></i> Address</label>
                                            <div class="select-box">
                                                <div class="select-box__current" tabindex="1">

                                                    <div class="select-box__value">
                                                        @foreach($user->client_addresses as $address)
                                                        <input class="select-box__input" type="radio" id="{{$address['_id']}}" value="{{$address['_id']}}"
                                                               name="address" checked="checked"/>
                                                        <p class="select-box__input-text">{{$address['name']}}</p>
                                                            @endforeach
                                                    </div>

                                                    <img class="select-box__icon"
                                                         src="/public/images/client/drop-down-arrow.svg"
                                                         alt="Arrow Icon" aria-hidden="true"/>
                                                </div>
                                                <ul class="select-box__list">
                                                    @foreach($user->client_addresses as $address)
                                                    <li>
                                                        <label class="select-box__option" for="{{$address['_id']}}" aria-hidden="true">
                                                        {{$address['name']}}
                                                        </label>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->
                                </div><!-- /.row -->
                                <div class="form-group">
                                    <label for="description"> Problem Description</label>
                                    <textarea class="form-control" id="description" name="description"
                                              rows="6"></textarea>
                                </div><!-- /.form-group -->
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="date-input"> Pick a day </label>
                                            <input id="date-input" name="date" type="text" data-dd-theme="leaf"
                                                   data-dd-format="Y-m-d">
                                        </div><!--/.form-group-->
                                    </div><!--/.col-*-->
                                </div><!--/.row-->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="from"> Choose starting time </label>
                                            <select name="from" id="from">

                                            </select>
                                        </div><!-- /.form-group -->
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="to"> Choose ending time </label>
                                            <select name="to" id="to">

                                            </select>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->
                                </div><!-- /.row -->


                                <button type="submit" class="btn btn-primary pull-right"> Request</button>
                            </div><!-- /.wrapper -->
                        </form><!-- /.form -->
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
            var timepicker = @json($timepicker);
            $(document).ready(function () {
                $('#date-input').dateDropper({
                    format: 'd-m-Y',
                    enabledDays: '{{$availableDaysString}}',
                    maxYear: 2020,
                    minYear: 2020
                });

            });
            $("#date-input").change(function(){
                alert($("#date-input").val());

                // $.each( timepicker, function( key, value ) {
                //     alert( key + ": " + value );
                // });
            });
        </script>
@endpush

@extends('layouts.client.app')
@push('css')
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/buttons.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/common-classes.css')}}" rel="stylesheet">
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
            z-index: 10;
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
            margin: 0;
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
    <div class="page-wrapper">
        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <div class="content">
                        <form class="contact-form" method="post" action="{{route('client.request.store')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="timezone" id="timezone">
                            @isset($employee)
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
                                            <h3>price: ${{$employee->price}}/hr</h3>
                                            <h3>gender: {{$employee->gender}}</h3>
                                            <input type="hidden" name="employee_id" value="{{$employee->id}}">
                                            {{--                                            <input type="hidden" name="service_id" value="{{$service->id}}">--}}
                                        </div>
                                    </div>
                                </div>
                            @endisset
                            <h3> The more you elaborate, the more we can help!</h3>
                            <div class="contact-form-wrapper clearfix background-white p30">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="subject">Subject</label>
                                            <input type="text" name="subject" id="subject"
                                                   class="form-control @error('subject') is-danger @enderror"
                                                   value="{{old('subject')}}">
                                            @error('subject')
                                            <p class="help is-danger">{{ $errors->first('subject') }}</p>
                                            @enderror
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="subject"> <i class="fa fa-home" aria-hidden="true"></i> Address</label>
                                            <div class="select-box">
                                                <div class="select-box__current" tabindex="1">

                                                    <div class="select-box__value">
                                                        @foreach($user->client_addresses as $address)
                                                            <input class="select-box__input" type="radio"
                                                                   id="{{$address['_id']}}" value="{{$address['_id']}}"
                                                                   name="address" @if($loop->index==0)checked @endif/>
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
                                                            <label class="select-box__option" for="{{$address['_id']}}"
                                                                   aria-hidden="true">
                                                                {{$address['name']}}
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->
                                </div><!-- /.row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="file-field input-field">
                                            <div class="btn" style="position:static;">
                                                <span>Browse</span>
                                                <input type="file" name="images[]" accept="image/jpeg, image/png"
                                                       multiple/>
                                            </div><!-- /.btn -->
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text"
                                                       placeholder="Upload multiple images"/>
                                            </div><!-- /.file-path* -->
                                        </div><!-- /.file-field* -->
                                    </div><!-- /.col* -->
                                    <div class="input-field col s6 ">
                                        <select class="icons" id="service" name="service">
                                            <option value="" disabled>Choose your service type</option>
                                            @isset($employee)
                                                @foreach($employee->services as $s)
                                                    <option value="{{$s->id}}"
                                                            data-icon="{{config('image.path').$s->image}}"
                                                            @isset($service)
                                                            @if($s->id == $service->id)
                                                            selected
                                                        @endif
                                                    @endisset>
                                                        {{$s->name}}
                                                    </option>
                                                @endforeach
                                            @else
                                                @foreach($services as $service)
                                                    <option value="{{$service->id}}"
                                                            data-icon="{{config('image.path').$service->image}}">
                                                        {{$service->name}}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        <label for="service">Services</label>
                                    </div>
                                </div><!-- /.row -->

                                <div class="form-group">
                                    <label for="description"> Problem Description</label>
                                    <textarea class="form-control @error('description') is-danger @enderror"
                                              id="description" name="description"
                                              rows="6">{{old('description')}}</textarea>
                                    @error('description')
                                    <p class="help is-danger">{{ $errors->first('description') }}</p>
                                    @enderror
                                </div><!-- /.form-group -->
                                @isset($employee)
                                @else
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <p> is the request Urgent ? (the request time will be the next couple of
                                                    hours)</p>
                                                <p>
                                                    <label for="is_urgent">
                                                        <input name="is_urgent" id="is_urgent" type="checkbox"/>
                                                        <span>Urgent</span>
                                                    </label>
                                                </p>
                                            </div><!--/.form-group-->
                                        </div><!--/.col-*-->
                                    </div>
                                @endisset
                                <div id="date-time">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="date-input"> Pick a day </label>
                                                <input id="date-input" name="date" type="text" data-dd-theme="leaf"
                                                       data-dd-format="m/d/Y">
                                            </div><!--/.form-group-->
                                        </div><!--/.col-*-->
                                    </div><!--/.row-->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="from"> Choose starting time </label>
                                                <select name="from" id="from">
                                                    @isset($employee)
                                                    @else
                                                @for($index=0;$index<24;$index++)
                                                    <option>{{$index}}</option>
                                                 @endfor
                                                        @endisset
                                                </select>
                                                @error('from')
                                                <p class="help is-danger">{{ $errors->first('from') }}</p>
                                                @enderror
                                            </div><!-- /.form-group -->
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="to"> Choose ending time </label>
                                                <select name="to" id="to">
                                                    @isset($employee)
                                                    @else
                                                        @for($index=1;$index<=24;$index++)
                                                            <option>{{$index}}</option>
                                                        @endfor
                                                    @endisset
                                                </select>
                                                @error('to')
                                                <p class="help is-danger">{{ $errors->first('to') }}</p>
                                                @enderror
                                            </div><!-- /.form-group -->
                                        </div><!-- /.col-* -->
                                    </div><!-- /.row -->
                                </div>

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
        {{--        <script src="/public/js/client/requests/materialize.js"></script>--}}
        {{--        <script src="/public/js/client/requests/drop-zone.js"></script>--}}
        {{--        <script src="/public/js/client/requests/file-uploader.js"></script>--}}
        <script src="/public/js/moment.min.js"></script>
        <script src="/public/js/moment-timezone-with-data-2012-2022.min.js"></script>
        <script src="/public/js/client/requests/date-dropper.pro.min.js"></script>
        <script>
                @isset($employee)
            var timepicker = @json($timepicker);
            $(document).ready(function () {
                $('#date-input').dateDropper({
                    format: 'd-m-Y',
                    enabledDays: '{{$availableDaysString}}',
                    maxYear: 2020,
                    minYear: 2020
                });
            });
            var fromSelect = $('#from');
            var toSelect = $('#to');
            $("#date-input").change(function () {
                fromSelect.find('option').remove().end();
                toSelect.find('option').remove().end();
                $.each(timepicker[$("#date-input").val()], function (key, value) {
                    // alert( key + ": " + value["from"] );
                    for (var from = value["from"]; from < value["to"]; from++) {
                        fromSelect.append(
                            $('<option></option>').val(from).html(from)
                        );
                    }
                });
                fromSelect.trigger('change')
            });
            fromSelect.change(function () {
                toSelect.find('option').remove().end();
                var from = fromSelect.val();
                $.each(timepicker[$("#date-input").val()], function (key, value) {
                    // alert( key + ": " + value["from"] );
                    if (from >= value["from"] && from <= value["to"]) {
                        from++;
                        for (var to = from; to <= value["to"]; to++) {
                            toSelect.append(
                                $('<option></option>').val(to).html(to)
                            );
                        }
                    }
                });
            });
            @else
            $(document).ready(function () {
                $('#date-input').dateDropper({
                    format: 'd-m-Y',
                    {{--enabledDays: '{{$availableDaysString}}',--}}
                    maxYear: 2020,
                    minYear: 2020
                });

            });
                var fromSelect = $('#from');
                var toSelect = $('#to');
                fromSelect.change(function () {
                    toSelect.find('option').remove().end();
                    var from = fromSelect.val();
                    from++;
                            for (var to = from; to <= 24; to++) {
                                toSelect.append(
                                    $('<option></option>').val(to).html(to)
                                );
                            }

                });

            @endisset
        </script>
        <script>
            $(document).ready(function () {
                $('#service').formSelect();
                $('#timezone').val(moment.tz.guess())
            });
            const checkbox = document.getElementById('is_urgent')

            checkbox.addEventListener('change', (event) => {
                if (event.target.checked) {
                    $('#date-time').hide()
                    $('#is_urgent').val(true)
                } else {
                    $('#date-time').show()
                    $('#is_urgent').val(false)
                }
            })
        </script>
    @endpush

@extends('layouts.client.app')
@push('css')
    <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/buttons.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/forms.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/fullscreen-classes.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/listing-cards.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/filter.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/color-box.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/sorting.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div class="page-wrapper">
        <div class="main" id="employees-list">
            <div class="fullscreen-wrapper" style="padding:12px">
                <form class="filter" method="post" action="{{route('client.service.filter',$service->id)}}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="Keyword">Keyword</label>
                                <input type="text" name="keyword" id="Keyword" class="form-control search">
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <select class="materialSelect" id="address" name="address">
                                    @foreach($user->client_addresses as $address)
                                        <option value="{{$address['_id']}}">{{$address['name']}}</option>
                                    @endforeach
                                </select>
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->

                        <div class="col-sm-6 col-md-4">
                            <label for="date">Choose a Day</label>
                            <input type="text" id="date" name="date" class="datepicker">
                        </div><!-- /.col-* -->

                    </div><!-- /.row -->
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <select name="from" id="from" class="materialSelect">
                                @for($from=0;$from<24;$from++)
                                    <option value="{{$from}}">{{$from}}</option>
                                @endfor
                            </select>
                            <label for="from">Choose Starting time</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <select name="to" id="to">
                            </select>
                            <label for="to">Choose Ending time</label>
                        </div>
                    </div>
                    @isset($availableTimes)
                        <div class="row">
                            @foreach($availableTimes as $available)
                                <div class="chip">
                                    <img src="/public/images/client/clock-icon.png" alt="date">
                                    {{$available['date']}} : {{$available['from']}} -> {{$available['to']}}
                                    <i class="fa fa-times"></i>
                                    <input type="hidden" value="{{$available}}" name="availability[]">
                                </div><!-- /.chip -->
                            @endforeach
                        </div><!-- /.row -->
                    @endisset

                    <hr>

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="filter-actions">
                                <a href="{{route('client.service', $service->id)}}"><i class="fa fa-close"></i> Reset
                                    Filter</a>
                            </div><!-- /.filter-actions -->
                        </div><!-- /.col-* -->
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary">Redefine Search Result</button>
                        </div><!-- /.col-* -->
                    </div><!-- /.row -->
                </form>

                {{--                <h2 class="page-title">--}}
                {{--                    N results matching your query--}}
                {{--                </h2><!-- /.page-title -->--}}

                <div class="filter-sort">
                    <div class="form-group">
                        <div class="annotated-list">
                            <button class="sort" data-sort="price" name="price">Price</button>
                            <button class="sort" data-sort="rating" name="rating"> Rating</button>
                        </div>
                    </div><!-- /.form-group -->

                </div>

                <div class="cards-row" style="margin-top:80px">

                    <div class="list">
                        @foreach($employees as $employee)
                            @if($employee->id != $user->id)
                                <div class="card-row">
                                    <div class="card-row-inner">
                                        <div class="card-row-image"
                                             style="background-image: url({{config('image.path').$employee->image}})">
                                            <a href="{{route('client.user-profile',[$service->id,$employee->id])}}">
                                                <div class="card-row-label">{{$service->name}} </div>
                                                <!-- /.card-row-label -->
                                                <div class="card-row-price"> ${{$employee->price}} / hr</div><!-- -->
                                            </a>
                                        </div><!-- /.card-row-image -->
                                        <div class="card-row-body">
                                            <h2 class="card-row-title">
                                                <a href="{{route('client.user-profile',[$service->id,$employee->id])}}"
                                                   class="name">{{$employee->name}} </a>
                                            </h2>
                                            <div class="card-row-content">
                                                <p class="biography"> {{$employee->biography}} </p>
                                            </div><!-- /.card-row-content -->
                                        </div><!-- /.card-row-body -->
                                        <div class="card-row-properties">
                                            <dl>
                                                <dd>Price</dd>
                                                <dt class="price"> ${{$employee->price}} / hr</dt>
                                                <dd>Category</dd>
                                                <dt> Category</dt>
                                                <dd>Location</dd>
                                                <dt>Location</dt>
                                                <dd> Rating</dd>
                                                <dd class="rating" style="display:none">{{$employee->rating}}</dd>
                                                <dt>
                                                    <div class="card-row-rating">
                                                        @for($x=$employee->rating;$x>0;$x--)
                                                            @if($x<1)
                                                                <i class="fa fa-star-half-o"></i>
                                                            @else
                                                                <i class="fa fa-star"></i>
                                                            @endif
                                                        @endfor
                                                        @for($x=5-ceil($employee->rating);$x>0;$x--)
                                                            <i class="fa fa-star-o"></i>
                                                        @endfor
                                                    </div><!-- /.card-row-rating -->
                                                </dt>
                                            </dl>
                                        </div><!-- /.card-row-properties -->
                                    </div><!-- /.card-row-inner -->
                                </div><!-- /.card-row -->
                            @endif
                        @endforeach
                    </div><!-- /.list -->
                        <ul class="pagination"></ul>
                </div><!-- /.cards-row -->
            </div><!-- /.fullscreen-wrapper -->
        </div><!-- /.main -->
    </div><!-- /.page-wrapper -->
@endsection
@push('js')
    <script src="/public/js/client/jquery.colorbox-min.js" type="text/javascript"></script>
    <script src="/public/js/client/superlist.js" type="text/javascript"></script>
    <script src="/public/js/list.js" type="text/javascript"></script>
    <script>
        var options = {
            valueNames: ['name', 'price','rating'],
            fuzzySearch: {
                searchClass: "fuzzy-search"
            },
            page:10,
            pagination:true
        };
        var employeesList = new List('employees-list', options);


    </script>
    <script>
        $('.chips').chips();
        $(document).ready(function () {
            $('.datepicker').datepicker();
            $('.datepicker').datepicker({
                onOpen: function () {
                    var instance = M.Datepicker.getInstance($('.datepicker'));
                    instance.options.minDate = new Date('2020-03-12');

                    instance.options.format = 'mm/dd/yyyy'
                }
            });
            $('select').formSelect();
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
            $('#to').formSelect();
        });
    </script>
@endpush





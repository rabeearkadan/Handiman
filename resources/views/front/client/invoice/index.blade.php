@extends('layouts.client.app')
@push('css')
    <link href="{{asset('css/client/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/buttons.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/common-classes.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/forms.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/widgets.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/pagination.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/posts.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/post-detail.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/color-box.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/bootstrap-select.min.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div class="page-wrapper">
        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-lg-3">
                            <div class="sidebar">
                                <div class="widget">
                                    <h2 class="widgettitle">Categories</h2>
                                    <ul class="menu">
                                        <li><a href="#" onclick="removeFilters()"> All categories </a></li>
                                        @foreach($services as $service)
                                            <li>
                                                <a href="#!" onclick="filter('{{$service->name}}')">
                                                    {{$service->name}}
                                                    <strong class="pull-right">{{$serviceCount[$service->name]}}</strong>
                                                </a></li>
                                        @endforeach
                                    </ul><!-- /.menu -->
                                </div><!-- /.wifget -->
                            </div><!-- /.sidebar -->
                        </div><!-- /.col-* -->
                        <div class="col-sm-8 col-lg-9">
                            <div class="content">
                                <div class="page-title">
                                    <h1> Invoices List </h1>
                                </div><!-- /.page-title -->
                                <div class="posts posts-condensed">
                                    <div id="bills-list">
                                        <div class="list">
                                            @foreach($requests as $request)
                                                <div class="post">
                                                    <div class="post-date">{{$request->date->format('d/m/Y')}}</div>
                                                    <!-- /.post-date -->
                                                    <div class="post-image">
                                                        <a href="{{route('client.invoice.show',$request->id)}}">
                                                            <img src="{{config('image.path').$request->result_images[0]}}" alt="result">
                                                        </a>
                                                    </div><!-- /.post-image -->
                                                    <div class="post-content">
                                                        <h2>
                                                            <a href="{{route('client.invoice.show',$request->id)}}">{{$request->subject}}</a>
                                                        </h2>
                                                        <p>{{$request->description}}...</p>
                                                    </div><!-- /.post-content -->
                                                    <div style="display: none" class="services"> {{$request->service_name}} </div>
                                                    <div class="post-more">
                                                        <a href="{{route('client.invoice.show',$request->id)}}">Show More</a>
                                                    </div><!-- /.post-date -->
                                                </div><!-- /.post -->
                                            @endforeach
                                        </div>
                                    </div>
                                    @if($requests->count() == 0)
                                        <div class="container" style="background-size:contain;background-repeat: no-repeat;background-position: center;height:150px;background-image:url('/public/images/client/invoice-empty.png');">
                                        </div>
                                    @endif
                                </div><!-- /.posts -->
                            </div><!-- /.content -->
                        </div><!-- /.col-* -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.main-inner -->
        </div><!-- /.main -->
    </div><!-- /.page-wrapper -->
@endsection
@push('js')
    <script src="/public/js/list.js" type="text/javascript"></script>
    <script>
        var options = {
            valueNames: ['services'],
        };
        var billsList = new List('bills-list', options);

        function filter(category) {
            billsList.filter(function (item) {
                return !!item.values().services.includes(category);
            });
        }
        function removeFilters() {
            billsList.filter();
        }
    </script>
@endpush

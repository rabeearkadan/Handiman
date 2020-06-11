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
                                        @foreach($services as $service)
                                        <li>
                                            <a href="#">
                                                {{$service->name}}
{{--                                                <strong class="pull-right">{{$service-_ount}}</strong>--}}
                                            </a></li>
                                        @endforeach
                                    </ul><!-- /.menu -->
                                </div><!-- /.wifget -->
                            </div><!-- /.sidebar -->
                        </div><!-- /.col-* -->
                        <div class="col-sm-8 col-lg-9">
                            <div class="content">
                                <div class="page-title">
                                    <h1> Invoice list </h1>
                                </div><!-- /.page-title -->
                                <div class="posts posts-condensed">
                                    @foreach($jobs as $job)
                                    <div class="post">
                                        <div class="post-date">{{$job->date->format('d/m/Y')}}</div><!-- /.post-date -->
                                        <div class="post-image">
                                            <a href="">
                                                <img src="" alt="service image">
                                            </a>
                                        </div><!-- /.post-image -->
                                        <div class="post-content">
                                            <h2><a href=""></a></h2>
                                            <p>{{$job->description}}...</p>
                                        </div><!-- /.post-content -->

                                        <div class="post-more">
                                            <a href="{{route('employee.calendar.show',$job->id)}}">Show More</a>
                                        </div><!-- /.post-date -->
                                    </div><!-- /.post -->
                                    @endforeach
                                        @if($$invoices->count() == 0)
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
    <script src="/public/js/client/dropdown.js" type="text/javascript"></script>
    <script src="/public/js/client/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="/public/js/client/superlist.js" type="text/javascript"></script>
    <script src="/public/js/list.js" type="text/javascript"></script>
    <script>
        var options = {
            valueNames: ['categories'],
            page: 20,
            pagination: true
        };
        var billsList = new List('bills-list', options);

        function filter(category) {
            billsList.filter(function (item) {
                return !!item.values().categories.includes(category);
            });
        }

        function removeFilters() {
            billsList.filter();
        }
    </script>

@endpush

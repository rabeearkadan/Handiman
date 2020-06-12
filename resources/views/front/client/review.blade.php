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
    <style>
        body{
            background-color: #f7f8f9;
        }
    </style>
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
                                        <li><a href="#" onclick="removeFilters()"> All categories
                                                <strong class="pull-right">{{$all}}</strong>
                                            </a></li>
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
                                    <h1> Review Services Provided by each Employee</h1>
                                </div><!-- /.page-title -->
                                <div class="posts posts-condensed">
                                    <div id="review-list">
                                        <div class="list">
                                            @foreach($requests as $request)
                                                <div class="post">
                                                   @isset($request->rating)

                                                    @else
                                                    <form method="post" action="">
                                                        @csrf
                                                        <button class="btn waves-effect waves-light right" type="submit" name="action"
                                                                style="line-height: 3.5px;font-size: small;height: 27px;margin-right: 85px;">Submit
                                                            <i class="material-icons right">send</i>
                                                        </button>
                                                    </form>
                                                    @endisset
                                                </div><!-- /.post -->
                                            @endforeach
                                        </div>
                                    </div>
                                    @if($requests->count() == 0)
{{--                                        <div class="container"--}}
{{--                                             style="background-size:contain;background-repeat: no-repeat;background-position: center;height:150px;background-image:url('/public/images/client/invoice-empty.png');">--}}
{{--                                        </div>--}}
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
{{--    <script src="/public/js/client/dropdown.js" type="text/javascript"></script>--}}
{{--    <script src="/public/js/client/bootstrap-select.min.js" type="text/javascript"></script>--}}
{{--    <script src="/public/js/client/superlist.js" type="text/javascript"></script>--}}
    <script src="/public/js/list.js" type="text/javascript"></script>
    <script>
        var options = {
            valueNames: ['services'],
            page: 20,
            pagination: true
        };
        var reviewsList = new List('review-list', options);

        function filter(category) {
            reviewsList.filter(function (item) {
                return !!item.values().services.includes(category);
            });
        }

        function removeFilters() {
            reviewsList.filter();
        }
    </script>

@endpush

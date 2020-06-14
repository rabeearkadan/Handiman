@extends('layouts.client.app')
@push('css')
    <link href="{{asset('css/client/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/buttons.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/common-classes.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/widgets.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/pagination.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/posts.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/post-detail.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/color-box.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/rating.css')}}" rel="stylesheet">
    <style>
        body {
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
                                                    <strong
                                                        class="pull-right">{{$serviceCount[$service->name]}}</strong>
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
                                    <div id="reviews-list">
                                        <div class="list">
                                            @foreach($requests as $request)
                                                <div class="post">
                                                    @isset($request->rating)
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <a href="{{route('client.user-profile',['employee_id' => $request->employee->id])}}">
                                                                    <img style="width:35px; height:35px"
                                                                         class="circle responsive-img"
                                                                         src="{{config('image.path').$request->employee->image}}"
                                                                         alt="post images">
                                                                </a>
                                                                <a href="{{route('client.user-profile',['employee_id' => $request->employee->id])}}"> {{$request->employee->name}} </a>
                                                                <p>  {{$request->subject}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                @for($index=0;$index<$request->rating;$index++)
                                                                    <i class="large material-icons">stars</i>
                                                                    @endfor
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col s12">
                                                                <input disabled value="{{$request->feedback[0]['title']}}" id="disabledTitle{{$request->id}}" type="text" class="validate">
                                                                <label for="disabled{{$request->id}}">Title</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col s12">
                                                                <textarea  class="materialize-textarea" id="disabledBody{{$request->id}}" disabled>{{$request->feedback[0]['body']}}</textarea>
                                                                <label for="disabledBody">Body</label>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <form method="post" action="{{route('client.reviews.store',$request->id)}}">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                            <a href="{{route('client.user-profile',['employee_id' => $request->employee->id])}}">
                                                                <img style="width:35px; height:35px"
                                                                     class="circle responsive-img"
                                                                     src="{{config('image.path').$request->employee->image}}"
                                                                     alt="post images">
                                                            </a>
                                                                    <a href="{{route('client.user-profile',['employee_id' => $request->employee->id])}}"> {{$request->employee->name}} </a>
                                                                <p>   {{$request->subject}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="rating">
                                                                    <input type="radio" id="star5" name="rating"
                                                                           value="5"/><label for="star5"
                                                                                             title="Excellent!">5
                                                                        stars</label>
                                                                    <input type="radio" id="star4" name="rating"
                                                                           value="4"/><label for="star4" title="good">4
                                                                        stars</label>
                                                                    <input type="radio" id="star3" name="rating"
                                                                           value="3"/><label for="star3" title=" okay">3
                                                                        stars</label>
                                                                    <input type="radio" id="star2" name="rating"
                                                                           value="2"/><label for="star2" title="Bad">2
                                                                        stars</label>
                                                                    <input type="radio" id="star1" name="rating"
                                                                           value="1"/><label for="star1" title="Sucks">1
                                                                        star</label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="input-field col s12">
                                                                    <input type="text" class="form-control" name="title"
                                                                           id="name" placeholder="title">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="input-field col s12">
                                                                    <textarea id="body" name="body" class="materialize-textarea" placeholder="feedback"></textarea>
                                                                    <label for="body"></label>
                                                                </div>
                                                            </div>
                                                            <button class="btn waves-effect waves-light right"
                                                                    type="submit" name="action"
                                                                    style="line-height: 3.5px;font-size: small;height: 27px;margin-right: 85px;">
                                                                Submit
                                                                <i class="material-icons right">send</i>
                                                            </button>
                                                        </form>
                                                    @endisset
                                                        <div style="display: none" class="services"> {{$request->service_name}} </div>
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
        };
        var reviewsList = new List('reviews-list', options);

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

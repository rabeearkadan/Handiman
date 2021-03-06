@extends('layouts.client.app')
@push('css')
    <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/posts.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/post-detail.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/common-classes.css')}}" rel="stylesheet">
    <style>
        @media only screen and (min-width: 600px) {
            .carousel {
                float: left;
            }
        }
    </style>
@endpush
@section('content')
    <div class="page-wrapper">
        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <div class="row">
                        <a href="{{route('client.request.create')}}" class=" btn-large waves-effect waves-light red"
                           style="margin-left: 53%;position: absolute;">
                            Smart Request
                        </a>
                        <div class="col-sm-12 col-lg-10">
                            <div class="content">
                                <div class="page-title">
                                    <h1> Posts </h1>
                                </div><!-- /.page-title -->
                                <div class="chips chips-autocomplete"></div>

                                @if(!$posts->isEmpty())
                                    <div class="posts">
                                        <div id="posts-list">
                                            <div class="list">
                                        @foreach($posts as $post)
                                            <div class="post">
                                                <div class="carousel carousel-slider" id="{{$post->id}}">
                                                    @foreach($post->images as $image)
                                                        <img class="carousel-item" src="{{config('image.path').$image}}"
                                                             alt="Post Images">
                                                    @endforeach
                                                </div>
                                                <div class="post-content">
                                                    <h2> {{$post->title}} </h2>
                                                    <p> {{$post->body}} </p>
                                                </div><!-- /.post-content -->
                                                <div class="post-meta clearfix">
                                                    <div class="post-meta-author">
                                                        @foreach($post->users as $user)
                                                            <a href="{{route('client.user-profile',['employee_id' => $user->id])}}">
                                                                @isset($user->image)
                                                                <img style="width:35px; height:35px"
                                                                     class="circle responsive-img"
                                                                     src="{{config('image.path').$user->image}}" alt="post images">
                                                                @else
                                                                    <img style="width:35px; height:35px"
                                                                         class="circle responsive-img"
                                                                         src="/public/images/employee/profile-image.png" alt="post images">
                                                                @endisset
                                                            </a>
                                                            <a href="{{route('client.user-profile',['employee_id' => $user->id])}}"> {{$user->name}} </a>
                                                        @endforeach
                                                    </div><!-- /.post-meta-author -->
                                                    <div class="post-meta-date"> {{$post->created_at->format('d/m/Y')}} </div>
                                                    <!-- /.post-meta-date -->
                                                    <div class="post-meta-categories">
                                                        <i class="fa fa-tags"></i>

                                                        @foreach($post->tags as $tag)
                                                            @if($loop->index !=0)
                                                                ,
                                                            @endif
                                                            <a href="{{route('client.service', $tag->id)}}"> {{$tag->name}} </a>
                                                        @endforeach
                                                        <div class="categories" style="display: none">
                                                            @foreach($post->tags as $tag)
                                                                {{$tag->name }}
                                                            @endforeach
                                                        </div>
                                                    </div><!-- /.post-meta-categories -->
                                                    {{--                                            <div class="post-meta-comments">--}}
                                                    {{--                                                <i class="fa fa-comments"></i>--}}
                                                    {{--                                                <a href="">3 comments</a>--}}
                                                    {{--                                            </div><!-- /.post-meta-comments -->--}}
{{--                                                    <div class="post-meta-more">--}}
{{--                                                        <a href="">View <i class="fa fa-chevron-right"></i></a>--}}
{{--                                                    </div><!-- /.post-meta-more -->--}}
                                                </div><!-- /.post-meta -->
                                            </div><!-- /.post -->
                                        @endforeach
                                            </div>
                                        </div>
                                    </div> <!-- /.posts -->
                                @else
                                    <h3> No posts yet</h3>
                                    <img class="img-fluid" src="/public/images/client/no-posts.png" alt="no posts">
                                @endif
                            </div><!-- /.content -->
                        </div><!-- /.col-* -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.main-inner -->
        </div><!-- /.main -->
    </div><!-- /.page-wrapper -->
@endsection
@push('js')
    <script src="/public/js/materialize.js"></script>
    {{--    <script src="/public/js/jquery.waituntilexists.min.js"></script>--}}
    <script src="/public/js/list.js" type="text/javascript"></script>
    <script>
        @isset($logged)
        $( window ).on("load",function () {
            M.toast({html: 'Logged in as Client',classes: 'rounded'})
        });
        @endisset
        $(document).ready(function () {
            @foreach($posts as $post)
            $('#{{$post->id}}').carousel({
                full_width: true
            });
            @endforeach
            autoplay();

            function autoplay() {
                $('.carousel').carousel('next');
                setTimeout(autoplay, 6500);
            }

            $('.chips-autocomplete').chips({
                placeholder: 'Enter a filter',
                secondaryPlaceholder: '+Filter',
                autocompleteOptions: {
                    data: {
                        @foreach($services as $service)
                        '{{$service->name}}': '{{config('image.path').$service->image}}',
                        @endforeach
                    },
                    limit: Infinity,
                    minLength: 1
                },
                onChipAdd: () => {
                    filter();
                },
                onChipDelete:() => {
                    removeFilter();
                }
            })
        });


        var options = {
            valueNames: ['categories'],
        };
        var postsList = new List('posts-list', options);


        function filter() {
            postsList.filter(function (item) {
                var bool = false;
                const chips = document.querySelectorAll('.chip');
                for (var i = 0; i < chips.length; i++) {
                    if(item.values().categories.includes(chips[i].innerText.replace('close',''))) {
                        bool = true
                    }
                }
                return bool;
            });
        }

        function removeFilter() {
            const chips = document.querySelectorAll('.chip');
            if(chips.length===0){
                postsList.filter();
            }
            else{
                filter();
            }
        }
    </script>
@endpush

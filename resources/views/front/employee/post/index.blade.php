@extends('layouts.employee.app')
@push('css')
    <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/pagination.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/posts.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/post-detail.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/common-classes.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/widgets.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/add-post-button.css')}}" rel="stylesheet">
    <style>
        img {
            vertical-align: middle;
        }

        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        /* Next & previous buttons */
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a grey background color */
        .prev:hover, .next:hover {
            background-color: #f1f1f1;
            color: black;
        }

    </style>
@endpush
@section('content')
    <div class="page-wrapper">
        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-lg-9">
                            <div class="content">
                                <div class="page-title">
                                    <h1>My Posts</h1>
                                        <a href="{{route('employee.post.create')}}" class="btn-floating btn-large waves-effect waves-light bg-deep-blue" style="float: right;">
                                            <i class="material-icons">add</i>
                                        </a>
                                </div><!-- /.page-title -->
                                <div class="posts">
                                    <div id="posts-list">
                                        <div class="list">
                                            @foreach($user->posts as $post)
                                                <div class="post post-boxed">
                                                    <div class="post-image">
                                                        <div class="slideshow-container">
                                                            @php
                                                                $bool=false;
                                                            @endphp
                                                            @foreach($post->images as $image)
                                                                <div class="mySlides{{$loop->parent->index}}">
                                                                    <img src="{{config('image.path').$image}}"
                                                                         style="width:100%" alt="">
                                                                </div>
                                                                @if($loop->index>0)
                                                                    @php
                                                                    $bool=true;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                            @if($bool==true)
                                                                <a class="prev"
                                                                   onclick="plusSlides(-1, {{$loop->index}})">&#10094;</a>
                                                                <a class="next"
                                                                   onclick="plusSlides(1, {{$loop->index}})">&#10095;</a>
                                                            @endif
                                                        </div>
                                                    </div><!-- /.post-image -->
                                                    <div class="post-content">
                                                        <h2><a href=""> {{$post->title}} </a>
                                                            <div style="position:absolute; right: 3%">
{{--                                                                <a href="{{route('employee.post.edit',$post->id)}}"> <i--}}
{{--                                                                        class="fa fa-edit"></i> </a>--}}
                                                                <a href="#"
                                                                   onclick="deletePost('{{$post->id}}')">
                                                                    <i class="fa fa-trash"></i> </a>
                                                                <form
                                                                    action="{{route('employee.post.destroy', $post->id)}}"
                                                                    method="post" id="{{$post->id}}" style="display: none">
                                                                    @csrf
                                                                    @method('delete')
                                                                </form>
                                                            </div>
                                                        </h2>
                                                        <p> {{$post->body}} </p>
                                                    </div><!-- /.post-content -->
                                                    <div class="post-meta clearfix">
                                                        <div class="post-meta-date">
                                                            {{$post->created_at}}
                                                        </div><!-- /.post-meta-date -->
                                                        <div class="post-meta-categories categories">
                                                            <i class="fa fa-tags"></i>
                                                                @foreach($post->tags as $tag)
                                                                    @if($loop->index !=0)
                                                                        ,
                                                                    @endif
                                                                    <a href="{{$tag->id}}"> {{$tag->name}} </a>
                                                                @endforeach
                                                        </div>
                                                        <!-- /.post-meta-categories -->
                                                    {{--                                                <div class="post-meta-comments"><i class="fa fa-comments"></i> <a--}}
                                                    {{--                                                        href="">3 comments</a></div>--}}
                                                    <!-- /.post-meta-comments -->
                                                        <div class="post-meta-more"><a href="">Read More <i
                                                                    class="fa fa-chevron-right"></i></a></div>
                                                        <!-- /.post-meta-more -->
                                                    </div><!-- /.post-meta -->
                                                </div><!-- /.post -->
                                            @endforeach
                                        </div><!-- /.posts-lists -->
                                        @if($user->posts->count() == 0)
                                            <div class="container" style="background-size:contain;background-repeat: no-repeat;background-position: center;height:150px;background-image:url('/public/images/employee/posts-empty.gif');">
                                            </div>
                                        @endif
                                        <ul class="pagination"></ul>
                                    </div><!-- /.list -->
                                </div><!-- /.posts -->
                            </div><!-- /.content -->
                        </div><!-- /.col-* -->
                        <div class="col-sm-4 col-lg-3">
                            <div class="sidebar">
                                <div class="widget">
                                    <h2 class="widgettitle">Categories</h2>

                                    <ul class="menu">
                                        <li><a href="#" onclick="removeFilters()"> All categories </a></li>
                                    @foreach($services as $service)
                                            <li><a href="#" onclick="filter('{{$service->name}}')"> {{$service->name}} </a></li>
                                        @endforeach
                                    </ul><!-- /.menu -->
                                </div><!-- /.wifget -->
                            </div><!-- /.sidebar -->
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
            function deletePost(id){
                var result = confirm("Want to delete this post?");
                if (result) {
                    document.getElementById(id).submit();
                }
            }
            var options = {
                valueNames: ['categories'],
                page: 10,
                pagination: true
            };
            var postsList = new List('posts-list', options);

            function filter(category) {
                postsList.filter(function (item) {
                    return !!item.values().categories.includes(category);
                });
            }

            function removeFilters() {
                postsList.filter();
            }
        </script>
    <script>
        var slideIndex = @json($slideIndex);
        var slideId = @json($slideId);
        @for($index=0;$index<$postCount;$index++)
        showSlides(1, {{$index}});

        @endfor
        function plusSlides(n, no) {
            showSlides(slideIndex[no] += n, no);
        }

        function showSlides(n, no) {
            var i;
            var x = document.getElementsByClassName(slideId[no]);
            if (n > x.length) {
                slideIndex[no] = 1
            }
            if (n < 1) {
                slideIndex[no] = x.length
            }
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            x[slideIndex[no] - 1].style.display = "block";
        }
    </script>
@endpush

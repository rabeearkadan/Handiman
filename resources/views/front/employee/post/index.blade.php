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
                                    <div class="pull-right" style="width:50px;position: absolute;top:6px;left: 75%;">
                                        <a href="{{route('employee.post.create')}}" class="header-action-inner">
                                            <i class="fa fa-plus" style="margin-top:15px;"></i>
                                        </a>
                                        <div class="tooltip fade bottom"  style="margin-left:-6px;">
                                            <div class="tooltip-arrow"></div>
                                            <div class="tooltip-inner"> New Post</div>
                                        </div>
                                    </div>
                                </div><!-- /.page-title -->
                                <div class="posts">
                                    @foreach($user->posts as $post)
                                        <div class="post post-boxed">
                                            <div class="post-image">
                                                <img src="{{config('image.path').$post->image}}"
                                                     alt="A Clockwork Origin">
                                                <a class="read-more" href="blog-detail-right-sidebar.html">View</a>
                                            </div><!-- /.post-image -->
                                            <div class="post-content">
                                                <h2><a href="blog-detail.html"> {{$post->title}} </a>
                                                    <div class="pull-right">
                                                        <a href="{{route('employee.post.edit',$post->id)}}"> <i
                                                                class="fa fa-edit"></i> </a>
                                                        <a href="#"
                                                           onclick="document.getElementById('{{$post->_id}}').submit();">
                                                            <i class="fa fa-trash"></i> </a>
                                                        <form action="{{route('employee.post.destroy', $post->id)}}"
                                                              method="post" id="{{$post->_id}}">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                    </div>
                                                </h2>
                                                <p> {{$post->body}} </p>
                                            </div><!-- /.post-content -->
                                            <div class="post-meta clearfix">
                                                <div class="post-meta-date">08/24/2015</div><!-- /.post-meta-date -->
                                                <div class="post-meta-categories">
                                                    <i class="fa fa-tags"></i>
                                                    @foreach($post->tags as $tag)
                                                        <a href=""> {{$tag->name}} </a>
                                                    @endforeach
                                                </div>
                                                <!-- /.post-meta-categories -->
                                                <div class="post-meta-comments"><i class="fa fa-comments"></i> <a
                                                        href="blog-detail.html">3 comments</a></div>
                                                <!-- /.post-meta-comments -->
                                                <div class="post-meta-more"><a href="blog-detail.html">Read More <i
                                                            class="fa fa-chevron-right"></i></a></div>
                                                <!-- /.post-meta-more -->
                                            </div><!-- /.post-meta -->
                                        </div><!-- /.post -->
                                    @endforeach
                                </div><!-- /.posts -->
                                <div class="pager">
                                    <ul>
                                        <li><a href="#">Prev</a></li>
                                        <li><a href="#">5</a></li>
                                        <li class="active"><a>6</a></li>
                                        <li><a href="#">7</a></li>
                                        <li><a href="#">Next</a></li>
                                    </ul>
                                </div><!-- /.pagination -->
                            </div><!-- /.content -->
                        </div><!-- /.col-* -->
                        <div class="col-sm-4 col-lg-3">
                            <div class="sidebar">
                                <div class="widget">
                                    <h2 class="widgettitle">Categories</h2>

                                    <ul class="menu">
                                        @foreach($services as $service)
                                            <li><a href="#"> {{$service->name}} </a></li>
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

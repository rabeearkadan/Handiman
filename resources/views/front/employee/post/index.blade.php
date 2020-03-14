@extends('layouts.employee.app')
<link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
<link href="{{asset('css/app.css')}}" rel="stylesheet">
<link href="{{asset('css/employee/pagination.css')}}" rel="stylesheet">
<link href="{{asset('css/employee/posts.css')}}" rel="stylesheet">
<link href="{{asset('css/employee/post-detail.css')}}" rel="stylesheet">
<link href="{{asset('css/employee/common-classes.css')}}" rel="stylesheet">
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
                                </div><!-- /.page-title -->
                                <div class="posts">
                                    @foreach($user->posts as $post)
                                    <div class="post post-boxed">
                                        <div class="post-image">
                                            <img src="{{config('image.path').$post->image}}" alt="A Clockwork Origin">
                                            <a class="read-more" href="blog-detail-right-sidebar.html">View</a>
                                        </div><!-- /.post-image -->
                                        <div class="post-content">
                                            <h2><a href="blog-detail.html"> {{$post->title}} </a>
                                                <div class="pull-right">
                                                    <a href="#"> <i class="fa fa-edit"></i> </a>
                                                    <a href="#"> <i class="fa fa-trash"></i> </a>
                                                </div>
                                            </h2>
                                            <p> {{$post->content}} </p>
                                        </div><!-- /.post-content -->
                                        <div class="post-meta clearfix">
                                            <div class="post-meta-date">08/24/2015</div><!-- /.post-meta-date -->
                                            <div class="post-meta-categories"><i class="fa fa-tags"></i> <a href="blog-detail.html"> Put tags here </a></div><!-- /.post-meta-categories -->
                                            <div class="post-meta-comments"><i class="fa fa-comments"></i> <a href="blog-detail.html">3 comments</a></div><!-- /.post-meta-comments -->
                                            <div class="post-meta-more"><a href="blog-detail.html">Read More <i class="fa fa-chevron-right"></i></a></div><!-- /.post-meta-more -->
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
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.main-inner -->
        </div><!-- /.main -->
    </div><!-- /.page-wrapper -->
@endsection

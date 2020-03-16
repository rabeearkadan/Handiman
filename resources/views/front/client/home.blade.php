@extends('layouts.client.app')
@push('css')
    <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/posts.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/post-detail.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/common-classes.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div class="page-wrapper">
        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-lg-10">
                            <div class="content">
                                <div class="page-title">
                                    <h1>Title</h1>
                                </div><!-- /.page-title -->
                                <div class="posts">
                                    @foreach($posts as $post)
                                    <div class="post">
                                        <div class="post-image">
                                            <img src="{{config_path('image.path').$post->image}}" alt="A Clockwork Origin">
                                        </div><!-- /.post-image -->
                                        <div class="post-content">
                                            <h2> {{$post->title}} </h2>
                                            <p> {{$post->body}} </p>
                                        </div><!-- /.post-content -->
                                        <div class="post-meta clearfix">
                                            <div class="post-meta-author">
                                                <a>By </a>
                                                <a href=""> {{$post->users->first()->name}} </a>
                                            </div><!-- /.post-meta-author -->
                                            <div class="post-meta-date"> {{$post->created_at}} </div><!-- /.post-meta-date -->
                                            <div class="post-meta-categories">
                                                <i class="fa fa-tags"></i>
                                                @foreach($post->tags as $tag)
                                                <a href=""> {{$tag->name}} </a>
                                                @endforeach
                                            </div><!-- /.post-meta-categories -->
                                            <div class="post-meta-comments">
                                                <i class="fa fa-comments"></i>
                                                <a href="">3 comments</a>
                                            </div><!-- /.post-meta-comments -->
                                            <div class="post-meta-more">
                                                <a href="">Read More <i class="fa fa-chevron-right"></i></a>
                                            </div><!-- /.post-meta-more -->
                                        </div><!-- /.post-meta -->
                                    </div><!-- /.post -->
                                    @endforeach
                                </div>
                            </div><!-- /.content -->
                        </div><!-- /.col-* -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.main-inner -->
        </div><!-- /.main -->
    </div><!-- /.page-wrapper -->
@endsection

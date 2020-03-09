@extends('layouts.client.app')
@push('css')
    <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/pagination.css')}}" rel="stylesheet">
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
                                    <div class="post">
                                        <div class="post-image">
                                            <img src="" alt="Image">
                                            <a class="read-more" href="">View</a>
                                        </div><!-- /.post-image -->
                                        <div class="post-content">
                                            <h2><a href=""> Title </a><a></a></h2><a>
                                                <p> Content </p>
                                            </a></div><!-- /.post-content -->
                                        <a> </a>
                                        <div class="post-meta clearfix"><a>
                                            </a><div class="post-meta-author"><a>By </a><a href=""> User </a></div><!-- /.post-meta-author -->
                                            <div class="post-meta-date">08/24/2015</div><!-- /.post-meta-date -->
                                            <div class="post-meta-categories"><i class="fa fa-tags"></i> <a href="">Tags here</a></div><!-- /.post-meta-categories -->
                                            <div class="post-meta-comments"><i class="fa fa-comments"></i> <a href="">3 comments</a></div><!-- /.post-meta-comments -->
                                            <div class="post-meta-more"><a href="">Read More <i class="fa fa-chevron-right"></i></a></div><!-- /.post-meta-more -->
                                        </div><!-- /.post-meta -->
                                    </div><!-- /.post -->
                                </div><!-- posts -->
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

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
                                        <li><a href="#">Automotive <strong class="pull-right">12</strong></a></li>
                                    </ul><!-- /.menu -->
                                </div><!-- /.wifget -->
                                <div class="widget">
                                    <h2 class="widgettitle">Archives</h2>
                                    <ul class="menu">
                                        <li><a href="#">August <strong class="pull-right">12</strong></a></li>
                                        <li><a href="#">July <strong class="pull-right">23</strong></a></li>
                                        <li><a href="#">June <strong class="pull-right">53</strong></a></li>
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
                                    <div class="post">
                                        <div class="post-date">08/24/2015</div><!-- /.post-date -->
                                        <div class="post-image">
                                            <a href="">
                                                <img src="" alt="A Clockwork Origin">
                                            </a>
                                        </div><!-- /.post-image -->
                                        <div class="post-content">
                                            <h2><a href="blog-detail.html">A Clockwork Origin</a></h2>
                                            <p>And from now on you're all named Bender Jr. The...</p>
                                        </div><!-- /.post-content -->

                                        <div class="post-more">
                                            <a href="blog-detail.html">Read More</a>
                                        </div><!-- /.post-date -->
                                    </div><!-- /.post -->
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
@push('js')
    <script src="/public/js/client/dropdown.js" type="text/javascript"></script>
    <script src="/public/js/client/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="/public/js/client/superlist.js" type="text/javascript"></script>
@endpush

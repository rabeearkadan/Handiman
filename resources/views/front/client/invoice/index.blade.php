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
    <link href="{{asset('css/client/colorbox.css')}}" rel="stylesheet">
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
                                    <h2 class="widgettitle">Filter</h2>
                                    <div class="background-white p20">
                                        <form method="post" action="?">
                                            <div class="form-group">
                                                <label for="">Keyword</label>
                                                <input type="text" class="form-control" name="" id="">
                                            </div><!-- /.form-group -->

                                            <div class="form-group">
                                                <label for="">Category</label>

                                                <select class="form-control" title="Select Category">
                                                    <option>Automotive</option>
                                                    <option>Real Estate</option>
                                                </select>
                                            </div><!-- /.form-group -->

                                            <div class="form-group">
                                                <label for="">Location</label>
                                                <select class="form-control" title="Select Location">
                                                    <option>New York</option>
                                                    <option>San Francisco</option>
                                                </select>
                                            </div><!-- /.form-group -->

                                            <div class="form-group">
                                                <label for="">Starting Price</label>
                                                <input type="text" class="form-control" name="" id="">
                                            </div><!-- /.form-group -->

                                            <button class="btn btn-primary btn-block" type="submit">Search</button>
                                        </form>
                                    </div>
                                </div><!-- /.widget -->
                                <div class="widget">
                                    <h2 class="widgettitle">Working Hours</h2>

                                    <div class="p20 background-white">
                                        <div class="working-hours">
                                            <div class="day clearfix">
                                                <span class="name">Mon</span><span
                                                    class="hours">07:00 AM - 07:00 PM</span>
                                            </div><!-- /.day -->

                                            <div class="day clearfix">
                                                <span class="name">Tue</span><span
                                                    class="hours">07:00 AM - 07:00 PM</span>
                                            </div><!-- /.day -->

                                            <div class="day clearfix">
                                                <span class="name">Wed</span><span
                                                    class="hours">07:00 AM - 07:00 PM</span>
                                            </div><!-- /.day -->

                                            <div class="day clearfix">
                                                <span class="name">Thu</span><span
                                                    class="hours">07:00 AM - 07:00 PM</span>
                                            </div><!-- /.day -->

                                            <div class="day clearfix">
                                                <span class="name">Fri</span><span
                                                    class="hours">07:00 AM - 07:00 PM</span>
                                            </div><!-- /.day -->

                                            <div class="day clearfix">
                                                <span class="name">Sat</span><span
                                                    class="hours">07:00 AM - 02:00 PM</span>
                                            </div><!-- /.day -->

                                            <div class="day clearfix">
                                                <span class="name">Sun</span><span class="hours">Closed</span>
                                            </div><!-- /.day -->
                                        </div>
                                    </div>
                                </div><!-- /.widget -->
                                <div class="widget">
                                    <h2 class="widgettitle">Categories</h2>
                                    <ul class="menu">
                                        <li><a href="#">Automotive
                                                <strong class="pull-right">12</strong></a></a></li>
                                        <li><a href="#">Jobs</a></li>
                                        <li><a href="#">Nightlife</a></li>
                                        <li><a href="#">Services</a></li>
                                        <li><a href="#">Transportation</a></li>
                                        <li><a href="#">Real Estate</a></li>
                                        <li><a href="#">Restaurants</a></li>
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
                                            <a href="blog-detail.html">
                                                <img src="assets/img/tmp/product-11.jpg" alt="A Clockwork Origin">
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

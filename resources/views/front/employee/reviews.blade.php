@extends('layouts.employee.app')
@push('css')
    <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/common-classes.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/testimonials.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/color-box.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div class="page-wrapper">
        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <div class="content">
                        <div class="mt-80">
                            <div class="page-header">
                                <h1> Reviews </h1>
                                <p>Read what your clients say about your services and products.</p>
                            </div><!-- /.page-header -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="testimonial">
                                        <div class="testimonial-image">
                                            <img src="{{config('image.path')}}" alt="">
                                        </div><!-- /.testimonial-image -->
                                        <div class="testimonial-inner">
                                            <div class="testimonial-title">
                                                <h2> Title </h2>
                                                <div class="testimonial-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div><!-- /.testimonial-rating -->
                                            </div><!-- /.testimonial-title -->
                                            Content
                                            <div class="testimonial-sign">- Name</div><!-- /.testimonial-sign -->
                                        </div><!-- /.testimonial-inner -->
                                    </div><!-- /.testimonial -->
                                </div><!-- /.col-* -->
                                <div class="col-sm-6">
                                </div><!-- /.col-* -->
                            </div><!-- row -->
                        </div><!-- mt-80 -->
                    </div><!-- /.content -->
                </div><!-- /.container -->
            </div><!-- /.main-inner -->
        </div><!-- /.main -->
    </div><!-- /.page-wrapper -->
@endsection

@extends('layouts.employee.app')
@push('css')
    <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/common-classes.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/testimonials.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/color-box.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div class="page-wrapper" style="background-color: white">
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
                                @foreach($feedbacks as $feedback)
                                <div class="col-sm-6">
                                    <div class="testimonial">
                                        <div class="testimonial-image">
                                            <img src="{{config('image.path')}}.{{$feedback['client']['image']}}" alt="client">
                                        </div><!-- /.testimonial-image -->
                                        <div class="testimonial-inner">
                                            <div class="testimonial-title">
                                                <h2> Title </h2>
                                                <div class="testimonial-rating">
                                                    @for($index=0;$index<$feedback['rating'];$index++)
                                                    <i class="fa fa-star"></i>
                                                    @endfor
                                                </div><!-- /.testimonial-rating -->
                                            </div><!-- /.testimonial-title -->
                                            Content
                                            <div class="testimonial-sign">- {{$feedback['client']['name']}}</div><!-- /.testimonial-sign -->
                                        </div><!-- /.testimonial-inner -->
                                    </div><!-- /.testimonial -->
                                </div><!-- /.col-* -->
                                @endforeach
                            </div>
                            @if(count($feedbacks) ==0)
                                <div class="container" style="background-size:contain;background-repeat: no-repeat;background-position: center;height:400px;background-image:url('/public/images/employee/reviews-empty.gif');">
                                </div>
                                @endif
                        </div><!-- mt-80 -->
                    </div><!-- /.content -->
                </div><!-- /.container -->
            </div><!-- /.main-inner -->
        </div><!-- /.main -->
    </div><!-- /.page-wrapper -->
@endsection

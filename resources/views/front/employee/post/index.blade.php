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
        .img-container
        {
            width:170px;
        }
        .img-container img {

            left: 0;
            object-fit: cover;
            object-position: center;
            opacity: 0;
            position: absolute;
            top: 0;

            z-index: -1;
        }

        .img-container img.next {
            opacity: 1;
            z-index: 1;
        }

        .img-container img.prev {
            opacity: 1;
            z-index: 2;
        }

        .img-container img.fade-out {
            opacity: 0;
            transition: visibility 0s .5s, opacity .5s linear;
            visibility: hidden;
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
                                                <div class="img-container" data-slideshow>
                                                    @foreach($post->images as $image)
                                                <img src="{{config('image.path').$image}}"
                                                     alt="">
                                                        @endforeach
                                                </div>
                                                <a class="read-more" href="">View</a>
                                            </div><!-- /.post-image -->
                                            <div class="post-content">
                                                <h2><a href=""> {{$post->title}} </a>
                                                    <div style="position:absolute; right: 3%">
                                                        <a href="{{route('employee.post.edit',$post->id)}}"> <i
                                                                class="fa fa-edit"></i> </a>
                                                        <a href="#" onclick="document.getElementById('{{$post->_id}}').submit();">
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
                                                <div class="post-meta-date">
                                                    {{$post->created_at}}
                                                </div><!-- /.post-meta-date -->
                                                <div class="post-meta-categories">
                                                    <i class="fa fa-tags"></i>
                                                    @foreach($post->tags as $tag)
                                                        <a href="{{$tag->id}}"> {{$tag->name}} </a>,
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
@push('js')
    <script>
        class Slideshow {

            constructor() {
                this.initSlides();
                this.initSlideshow();
            }

            // Set a `data-slide` index on each slide for easier slide control.
            initSlides() {
                this.container = $('[data-slideshow]');
                this.slides = this.container.find('img');
                this.slides.each((idx, slide) => $(slide).attr('data-slide', idx));
            }

            // Pseudo-preload images so the slideshow doesn't start before all the images
            // are available.
            initSlideshow() {
                this.imagesLoaded = 0;
                this.currentIndex = 0;
                this.setNextSlide();
                this.slides.each((idx, slide) => {
                    $('<img>').on('load', $.proxy(this.loadImage, this)).attr('src', $(slide).attr('src'));
                });
            }

            // When one image has loaded, check to see if all images have loaded, and if
            // so, start the slideshow.
            loadImage() {
                this.imagesLoaded++;
                if (this.imagesLoaded >= this.slides.length) { this.playSlideshow() }
            }

            // Start the slideshow.
            playSlideshow() {
                this.slideshow = window.setInterval(() => { this.performSlide() }, 3500);
            }

            // 1. Previous slide is unset.
            // 2. What was the next slide becomes the previous slide.
            // 3. New index and appropriate next slide are set.
            // 4. Fade out action.
            performSlide() {
                if (this.prevSlide) { this.prevSlide.removeClass('prev fade-out') }

                this.nextSlide.removeClass('next');
                this.prevSlide = this.nextSlide;
                this.prevSlide.addClass('prev');

                this.currentIndex++;
                if (this.currentIndex >= this.slides.length) { this.currentIndex = 0 }

                this.setNextSlide();

                this.prevSlide.addClass('fade-out');
            }

            setNextSlide() {
                this.nextSlide = this.container.find(`[data-slide="${this.currentIndex}"]`).first();
                this.nextSlide.addClass('next');
            }

        }

        $(document).ready(function() {
            new Slideshow;
        });
    </script>
@endpush

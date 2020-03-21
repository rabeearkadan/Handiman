@extends('layouts.client.app')
@push('css')
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700%7CAllura" rel="stylesheet">
    <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/employee-profile/cards/cards.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/employee-profile/common-css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/employee-profile/common-css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/employee-profile/common-css/fluidbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/employee-profile/cv-portfolio/styles.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/employee-profile/cv-portfolio/responsive.css')}}" rel="stylesheet">
@endpush
@section('content')
<header>
    <div class="container">
        <div class="heading-wrapper">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="info">
                        <i class="icon ion-ios-location-outline"></i>
                        <div class="right-area">
                            <h5>3008 Sarah Drive</h5>
                            <h5>Franklin,LA 70538</h5>
                        </div><!-- right-area -->
                    </div><!-- info -->
                </div><!-- col-sm-4 -->

                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="info">
                        <i class="icon ion-ios-telephone-outline"></i>
                        <div class="right-area">
                            <h5> phone </h5>
                            <h6>MIN - FRI,8AM - 7PM</h6>
                        </div><!-- right-area -->
                    </div><!-- info -->
                </div><!-- col-sm-4 -->

                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="info">
                        <i class="icon ion-ios-chatboxes-outline"></i>
                        <div class="right-area">
                            <h5>contact@colorlib.com</h5>
                            <h6> replies IN N HOURS</h6>
                        </div><!-- right-area -->
                    </div><!-- info -->
                </div><!-- col-sm-4 -->
            </div><!-- row -->
        </div><!-- heading-wrapper -->
        <a class="downlad-btn" href="{{route('client.request.create',[$service->id,$user->id])}}"> Request </a>

    </div><!-- container -->
</header>

<section class="intro-section">
    <div class="container">
        <div class="row">
            <div class="col-md-1 col-lg-2"></div>
            <div class="col-md-10 col-lg-8">
                <div class="intro">
                    <div class="profile-img"><img src="{{config('image.path').$user->image}}" alt=""></div>
                    <h2><b> {{$user->name}} </b></h2>
                    <h4 class="font-yellow">Key Account Manager</h4>
                    <ul class="information margin-tb-30">
                        <li><b>BORN : </b>August 25, 1987</li>
                        <li><b>EMAIL : </b>mymith@mywebpage.com</li>
                        <li><b>MARITAL STATUS : </b>Married</li>
                    </ul>
                    <ul class="social-icons">
                        <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                        <li><a href="#"><i class="ion-social-linkedin"></i></a></li>
                        <li><a href="#"><i class="ion-social-instagram"></i></a></li>
                        <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                        <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                    </ul>
                </div><!-- intro -->
            </div><!-- col-sm-8 -->
        </div><!-- row -->
    </div><!-- container -->
</section><!-- intro-section -->

<section class="portfolio-section section">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="heading">
                    <h3><b>Posts</b></h3>
                    <h6 class="font-lite-black"><b> Most Recent </b></h6>
                </div>
            </div><!-- col-sm-4 -->
            <div class="col-sm-8">
                <div class="portfolioFilter clearfix margin-b-80">
                    <a href="#" data-filter="*" class="current"><b>ALL</b></a>
                    @foreach($user->services as $service)
                        <a href="#" data-filter=".{{$service->name}}"><b> {{$service->name}} </b></a>
                    @endforeach
                </div><!-- portfolioFilter -->
            </div><!-- col-sm-8 -->
        </div><!-- row -->
    </div><!-- container -->

    <div class="portfolioContainer">
        @foreach($user->posts as $post)
            <div class="p-item @foreach($post->tags as $tag) {{$tag->name }} @endforeach">
                <div class="card">
                    <div class="card-image">
                            <img class="img-responsive" src="{{config('image.path').$post->image}}">
                        <span class="card-title"> {{$post->title}} </span>
                    </div>
                    <div class="card-content">
                        <p> {{$post->body}} </p>
                    </div>
                </div>
            </div><!-- p-item -->
        @endforeach
    </div><!-- portfolioContainer -->
</section><!-- portfolio-section -->
<section class="about-section section">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="heading">
                    <h3><b>About me</b></h3>
                    <h6 class="font-lite-black"><b> Biography </b></h6>
                </div>
            </div><!-- col-sm-4 -->
            <div class="col-sm-8">
                <p class="margin-b-50">Duis non volutpat arcu, eu mollis tellus. Sed finibus aliquam neque
                    sit amet sodales. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Nulla maximus pellentes que velit, quis consequat nulla effi citur at.
                    Maecenas sed massa tristique.Duis non volutpat arcu, eu mollis tellus.
                    Sed finibus aliquam neque sit amet sodales. Lorem ipsum dolor sit amet,
                    consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit. Nulla maximus pellentes que velit, quis consequat nulla
                    effi citur at.Maecenas sed massa tristique.</p>

                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="radial-prog-area margin-b-30">
                            <div class="radial-progress" data-prog-percent=".97">
                                <div></div>
                                <h6 class="progress-title">HTML5 & CSS3</h6>
                            </div>
                        </div><!-- radial-prog-area-->
                    </div><!-- col-sm-6-->

                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="radial-prog-area margin-b-30">
                            <div class="radial-progress" data-prog-percent=".78">
                                <div></div>
                                <h6 class="progress-title">WEB DESIGN</h6>
                            </div>
                        </div><!-- radial-prog-area-->
                    </div><!-- col-sm-6-->

                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="radial-prog-area margin-b-30">
                            <div class="radial-progress" data-prog-percent=".67">
                                <div></div>
                                <h6 class="progress-title">JAVA</h6>
                            </div>
                        </div><!-- radial-prog-area-->
                    </div><!-- col-sm-6-->

                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="radial-prog-area margin-b-50">
                            <div class="radial-progress" data-prog-percent=".97">
                                <div></div>
                                <h6 class="progress-title">PHP</h6>
                            </div>
                        </div><!-- radial-prog-area-->
                    </div><!-- col-sm-6-->

                </div><!-- row -->
            </div><!-- col-sm-8 -->
        </div><!-- row -->
    </div><!-- container -->
</section><!-- about-section -->

<section class="experience-section section">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="heading">
                    <h3><b>Work Experience</b></h3>
                    <h6 class="font-lite-black"><b>PREVIOUS JOBS</b></h6>
                </div>
            </div><!-- col-sm-4 -->
            <div class="col-sm-8">

                <div class="experience margin-b-50">
                    <h4><b>JUNIOR PROJECT MANAGER</b></h4>
                    <h5 class="font-yellow"><b>DESIGN STUDIO</b></h5>
                    <h6 class="margin-t-10">MARCH 2015 - PRESENT</h6>
                    <p class="font-semi-white margin-tb-30">Duis non volutpat arcu, eu mollis tellus. Sed finibus aliquam neque sit amet sodales.
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla maximus pellentes que velit,
                        quis consequat nulla effi citur at. Maecenas sed massa tristique.Duis non volutpat arcu,
                        eu mollis tellus. Sed finibus aliquam neque sit amet sodales. </p>
                    <ul class="list margin-b-30">
                        <li>Duis non volutpat arcu, eu mollis tellus.</li>
                        <li>Quis consequat nulla effi citur at.</li>
                        <li>Sed finibus aliquam neque sit.</li>
                    </ul>
                </div><!-- experience -->

                <div class="experience margin-b-50">
                    <h4><b>WEB MASTER/WEB DEVELOPER</b></h4>
                    <h5 class="font-yellow"><b>DESIGN & WEB STUDIO</b></h5>
                    <h6 class="margin-t-10">APRIL 2014 - FEBRUARY 2015</h6>
                    <p class="font-semi-white margin-tb-30">Duis non volutpat arcu, eu mollis tellus. Sed finibus aliquam neque sit amet sodales.
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla maximus pellentes que velit,
                        quis consequat nulla effi citur at. Maecenas sed massa tristique.Duis non volutpat arcu,
                        eu mollis tellus. Sed finibus aliquam neque sit amet sodales. </p>
                    <ul class="list margin-b-30">
                        <li>Duis non volutpat arcu, eu mollis tellus.</li>
                        <li>Quis consequat nulla effi citur at.</li>
                        <li>Sed finibus aliquam neque sit.</li>
                    </ul>
                </div><!-- experience -->

            </div><!-- col-sm-8 -->
        </div><!-- row -->
    </div><!-- container -->

</section><!-- experience-section -->

<section class="education-section section">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="heading">
                    <h3><b>Education</b></h3>
                    <h6 class="font-lite-black"><b>ACADEMIC CAREER</b></h6>
                </div>
            </div><!-- col-sm-4 -->
            <div class="col-sm-8">
                <div class="education-wrapper">
                    <div class="education margin-b-50">
                        <h4><b>MASTER DEGREE IN SCIENCE</b></h4>
                        <h5 class="font-yellow"><b>UCLA - SCIENCE AND ENGINEERING</b></h5>
                        <h6 class="font-lite-black margin-t-10">GRADUATED IN MAY 2010(2 YEARS)</h6>
                        <p class="margin-tb-30">Duis non volutpat arcu, eu mollis tellus. Sed finibus aliquam neque sit amet sodales.
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla maximus pellentes que velit,
                            quis consequat nulla effi citur at. Maecenas sed massa tristique.Duis non volutpat arcu,
                            eu mollis tellus. Sed finibus aliquam neque sit amet sodales. </p>
                    </div><!-- education -->

                    <div class="education margin-b-50">
                        <h4><b>COURSE ON COMPUTER SCIENCE</b></h4>
                        <h5 class="font-yellow"><b>NEW YORK PUBLIC UNIVERSITY</b></h5>
                        <h6 class="font-lite-black margin-t-10">GRADUATED IN MAY 2009(6 MONTHS)</h6>
                        <p class="margin-tb-30">Duis non volutpat arcu, eu mollis tellus. Sed finibus aliquam neque sit amet sodales.
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla maximus pellentes que velit,
                            quis consequat nulla effi citur at. Maecenas sed massa tristique.Duis non volutpat arcu,
                            eu mollis tellus. Sed finibus aliquam neque sit amet sodales. </p>
                    </div><!-- education -->

                    <div class="education margin-b-50">
                        <h4><b>GRADUATED VALEDICTERIAN</b></h4>
                        <h5 class="font-yellow"><b>PUBLIC COLLEGE</b></h5>
                        <h6 class="font-lite-black margin-t-10">GRADUATED IN MAY 2008(4 YEARS)</h6>
                        <p class="margin-tb-30">Duis non volutpat arcu, eu mollis tellus. Sed finibus aliquam neque sit amet sodales.
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla maximus pellentes que velit,
                            quis consequat nulla effi citur at. Maecenas sed massa tristique.Duis non volutpat arcu,
                            eu mollis tellus. Sed finibus aliquam neque sit amet sodales. </p>
                    </div><!-- education -->
                </div><!-- education-wrapper -->
            </div><!-- col-sm-8 -->
        </div><!-- row -->
    </div><!-- container -->

</section><!-- about-section -->

<section class="counter-section" id="counter">
    <div class="container">
        <div class="row">

            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="counter margin-b-30">
                    <h1 class="title"><b><span class="counter-value" data-duration="400" data-count="3">0</span></b></h1>
                    <h5 class="desc"><b>Coder Degrees</b></h5>
                </div><!-- counter -->
            </div><!-- col-md-3-->

            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="counter margin-b-30">
                    <h1 class="title"><b><span class="counter-value" data-duration="1400" data-count="25">0</span></b></h1>
                    <h5 class="desc"><b>Nb of jobs</b></h5>
                </div><!-- counter -->
            </div><!-- col-md-3-->

            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="counter margin-b-30">
                    <h1 class="title"><b><span class="counter-value" data-duration="700" data-count="311">0</span></b></h1>
                    <h5 class="desc"><b>Satisfied Clients</b></h5>
                </div><!-- counter -->
            </div><!-- col-md-3-->

            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="counter margin-b-30">
                    <h1 class="title"><b><span class="counter-value" data-duration="2000" data-count="732">0</span></b></h1>
                    <h5 class="desc"><b>NNb of Requests</b></h5>
                </div><!-- margin-b-30 -->
            </div><!-- col-md-3-->

        </div><!-- row-->
    </div><!-- container-->
</section><!-- counter-section-->
@endsection
@push('js')
    <script src="/public/common-js/jquery-3.2.1.min.js"></script>
    <script src="/public/common-js/tether.min.js"></script>
    <script src="/public/common-js/bootstrap.js"></script>
    <script src="/public/common-js/isotope.pkgd.min.js"></script>
    <script src="/public/common-js/jquery.waypoints.min.js"></script>
    <script src="/public/common-js/progressbar.min.js"></script>
    <script src="/public/common-js/jquery.fluidbox.min.js"></script>
    <script src="/public/common-js/scripts.js"></script>
@endpush





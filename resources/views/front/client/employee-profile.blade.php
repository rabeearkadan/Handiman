@extends('layouts.client.app')
@push('css')
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700%7CAllura" rel="stylesheet">
    <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/employee-profile/cards/cards.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/employee-profile/reviews/review-cards.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/employee-profile/reviews/review-modal.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/employee-profile/common-css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/employee-profile/common-css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/employee-profile/common-css/fluidbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/employee-profile/cv-portfolio/styles.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/employee-profile/cv-portfolio/responsive.css')}}" rel="stylesheet">
    <style>
        .current{
            color:#FFA804;
        }
    </style>
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
                                <h5> {{$employee->phone}} </h5>
                                <h6>MIN - FRI,8AM - 7PM</h6>
                            </div><!-- right-area -->
                        </div><!-- info -->
                    </div><!-- col-sm-4 -->
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="info">
                            <i class="icon ion-ios-chatboxes-outline"></i>
                            <div class="right-area">
                                <h5>{{$employee->email}}</h5>
                                {{-- <h6> replies IN N HOURS</h6>--}}
                            </div><!-- right-area -->
                        </div><!-- info -->
                    </div><!-- col-sm-4 -->
                </div><!-- row -->
            </div><!-- heading-wrapper -->
            <a class="downlad-btn" href="
@isset($service)
            {{route('client.request.create',['service_id'=>$service->id,'employee_id'=>$employee->id])}}
            @else
                    {{route('client.request.create',['employee_id'=>$employee->id])}}
                @endisset
                ">
                Request
            </a>
        </div><!-- container -->
    </header>

    <section class="intro-section">
        <div class="container">
            <div class="row">
                <div class="col-md-1 col-lg-2"></div>
                <div class="col-md-10 col-lg-8">
                    <div class="intro">
                        <div class="profile-img"><img src="{{config('image.path').$employee->image}}" alt=""></div>
                        <h2><b> {{$employee->name}} </b></h2>
                        @foreach($employee->services as $employee_service)
                            <h4 class="font-yellow"> {{$employee_service->name}} </h4>
                        @endforeach
                        <ul class="information margin-tb-30">
                            <li><b>BORN : </b>August 25, 1987</li>
                            <li><b>Price : </b>${{$employee->price}}/hr</li>
                        </ul>
                        <ul class="social-icons">
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
                        @foreach($employee->services as $employee_service)
                            <a href="#" data-filter=".{{$employee_service->name}}"><b> {{$employee_service->name}} </b></a>
                        @endforeach
                    </div><!-- portfolioFilter -->
                </div><!-- col-sm-8 -->
            </div><!-- row -->
        </div><!-- container -->

        <div class="portfolioContainer">
            @foreach($employee->posts as $post)
                <div class="p-item @foreach($post->tags as $tag) {{$tag->name }} @endforeach">
                    <div class="card">
                        <div class="card-image">
                            <img class="img-responsive" src="{{config('image.path').$post->images[0]}}" alt="">
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
                    <p class="margin-b-50"> {{$employee->biography}} </p>
                </div><!-- col-sm-8 -->
            </div><!-- row -->
        </div><!-- container -->
    </section><!-- about-section -->

    <section class="l-content-width section section--bordered">
        <div class="portfolioFilter clearfix margin-b-80" style="text-align: center;margin-bottom: 20px;">
            <a href="#" onclick="filter('all')" @isset($service)@else class="current" @endisset><b>ALL</b></a>
            @foreach($employee->services as $employee_service)
                <a href="#" onclick="filter('{{$employee_service->name}}')"
                   @if($employee_service->id == $service->id)
                       class="current"
                   @endif>
                    <b>{{$employee_service->name}}</b></a>
            @endforeach
        </div>
        <div class="section__nav">
            <h2 class="section__headline">
                Ratings and Reviews
            </h2>
            <a href="{{route('client.user-profile.all.reviews',[$service->id,$employee->id])}}" class="link section__nav__see-all-link ember-view"> See All</a>
        </div>


        <div id="reviews-list">
            <div class="list">

                <div>
                <div class="reviewservice" style="display: none">all</div>
                    @if($all_rating[0]!=0)
                        <div class="we-customer-ratings lockup ember-view">
                            <div class="l-row">
                                <div class="we-customer-ratings__stats l-column small-4 medium-6 large-4">
                                    <div class="we-customer-ratings__averages">
                                        <span class="we-customer-ratings__averages__display">{{round($all_rating[0],2)}}</span>
                                         out of 5
                                    </div>
                                    <div class="we-customer-ratings__count small-hide medium-show"> {{$all_rating[6]}}
                                        Ratings
                                    </div>
                                </div>
                                <div class=" l-column small-8 medium-6 large-4">
                                    <figure class="we-star-bar-graph">
                                    @for($index=5;$index>0;$index--)
                                        <div class="we-star-bar-graph__row">
                                                <span class="we-star-bar-graph__stars we-star-bar-graph__stars--{{$index}}"></span>
                                            <div class="we-star-bar-graph__bar">
                                                <div class="we-star-bar-graph__bar__foreground-bar" style="width:{{$all_rating[$index]}}%;"></div>
                                            </div>
                                        </div>
                                       @endfor
                                    </figure>
                                    <p class="we-customer-ratings__count medium-hide">
                                        {{$all_rating[6]}} Ratings
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="l-row l-row--peek">
                            @foreach($latest_feedbacks as $feedback)
                                @if($loop->index > 2)
                                    @break
                                @endif
                                <div class="ember-view small-valign-top l-column--equal-height l-column small-4 medium-6 large-4">
                                    <div class="ember-view">
                                    </div>
                                    <div class="we-customer-review lockup ember-view">
                                        <figure aria-label="{{$feedback['rating']}} out of 5" class="we-star-rating ember-view we-customer-review__rating we-star-rating--large">
                                            <span class="we-star-rating-stars-outlines">
                                               <span class="we-star-rating-stars we-star-rating-stars-{{$feedback['rating']}}"></span>
                                            </span>
                                        </figure>
                                        <div class="we-customer-review__header we-customer-review__header--user">
                                                <span class="we-truncate we-truncate--single-line ember-view we-customer-review__user">
                                                    {{$feedback['client']['name']}}
                                                </span>
                                            <span class="we-customer-review__separator">, </span>
                                            <time aria-label="May 00, 2020" class="we-customer-review__date">
                                                00/00/2020
                                            </time>
                                        </div>
                                        <h3 class="we-truncate we-truncate--single-line ember-view we-customer-review__title">
                                            Title
                                        </h3>
                                        <blockquote class="we-truncate we-truncate--multi-line we-truncate--interactive we-truncate--truncated ember-view we-customer-review__body" @if($feedback['rating']>=3)style="border-left:2px solid #5c9a6f"@endif>
                                            <div class="we-clamp ember-view">
                                                <p>Review</p>
                                            </div>
{{--                                            <button onclick="more('{{$service->id}}',{{$loop->index}})" class="we-truncate__button link">--}}
{{--                                                more--}}
{{--                                            </button>--}}
                                        </blockquote><!---->
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @else
                        <div>
                            <p>
                                Hasn't recieved enogh rating
                            </p>
                        </div>
                    @endif
                </div>

                @foreach($employee->services as $employee_service)
                    <div>
                    <div class="reviewservice" style="display: none">{{$employee_service->name}}</div>
                    @isset($service_rating[$employee_service->id])
                        @if($service_rating[$employee_service->id][0]!=0)
                            <div class="we-customer-ratings lockup ember-view">
                                <div class="l-row">
                                    <div class="we-customer-ratings__stats l-column small-4 medium-6 large-4">
                                        <div class="we-customer-ratings__averages">
                                        <span class="we-customer-ratings__averages__display">{{round($service_rating[$employee_service->id][0],2)}}</span>
                                            out of 5
                                        </div>
                                        <div
                                            class="we-customer-ratings__count small-hide medium-show"> {{$service_rating[$employee_service->id][6]}}
                                            Ratings
                                        </div>
                                    </div>
                                    <div class=" l-column small-8 medium-6 large-4">
                                        <figure class="we-star-bar-graph">
                                            @for($index=5;$index>0;$index--)
                                            <div class="we-star-bar-graph__row">
                                                <span class="we-star-bar-graph__stars we-star-bar-graph__stars--{{$index}}"></span>
                                                <div class="we-star-bar-graph__bar">
                                                    <div class="we-star-bar-graph__bar__foreground-bar" style="width: {{($service_rating[$employee_service->id][$index]/$service_rating[$service->id][6])*100}}%;"></div>
                                                </div>
                                            </div>
                                           @endfor
                                        </figure>
                                        <p class="we-customer-ratings__count medium-hide">
                                            {{$service_rating[$employee_service->id][6]}} Ratings
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="l-row l-row--peek">
                                @foreach($feedbacks[$employee_service->id] as $feedback)
                                    @if($loop->index > 2)
                                        @break
                                    @endif
                                    <div class="ember-view small-valign-top l-column--equal-height l-column small-4 medium-6 large-4">
                                        <div class="ember-view">
                                        </div>
                                        <div class="we-customer-review lockup ember-view">
                                            <figure aria-label="{{$feedback['rating']}} out of 5" class="we-star-rating ember-view we-customer-review__rating we-star-rating--large">
                                            <span class="we-star-rating-stars-outlines">
                                               <span class="we-star-rating-stars we-star-rating-stars-{{$feedback['rating']}}"></span>
                                            </span>
                                            </figure>
                                            <div class="we-customer-review__header we-customer-review__header--user">
                                                <span class="we-truncate we-truncate--single-line ember-view we-customer-review__user">
                                                    {{$feedback['client']['name']}}
                                                </span>
                                                <span class="we-customer-review__separator">, </span>
                                                <time aria-label="May 00, 2020" class="we-customer-review__date">
                                                    00/00/2020
                                                </time>
                                            </div>
                                            <h3 class="we-truncate we-truncate--single-line ember-view we-customer-review__title">
                                                Title
                                            </h3>
                                            <blockquote class="we-truncate we-truncate--multi-line we-truncate--interactive we-truncate--truncated ember-view we-customer-review__body"  @if($feedback['rating']>=3)style="border-left:2px solid #5c9a6f"@endif>
                                                <div class="we-clamp ember-view">
                                                    <p>Review</p>
                                                </div>
                                                <button onclick="more('{{$employee_service->id}}',{{$loop->index}})" class="we-truncate__button link">
                                                    more
                                                </button>
                                            </blockquote><!---->
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div>
                                <p>
                                    Hasn't received enough rating
                                </p>
                            </div>
                        @endif
                    @endisset
                    </div>
                @endforeach
            </div><!-- /.list -->
        </div><!-- /#reviews-list -->
    </section>


    <div id="modal-container">
    </div>


{{--    <section class="experience-section section">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-4">--}}
{{--                    <div class="heading">--}}
{{--                        <h3><b>Work Experience</b></h3>--}}
{{--                        <h6 class="font-lite-black"><b>PREVIOUS JOBS</b></h6>--}}
{{--                    </div>--}}
{{--                </div><!-- col-sm-4 -->--}}
{{--                <div class="col-sm-8">--}}

{{--                    <div class="experience margin-b-50">--}}
{{--                        <h4><b>JUNIOR PROJECT MANAGER</b></h4>--}}
{{--                        <h5 class="font-yellow"><b>DESIGN STUDIO</b></h5>--}}
{{--                        <h6 class="margin-t-10">MARCH 2015 - PRESENT</h6>--}}
{{--                        <p class="font-semi-white margin-tb-30">Duis non volutpat arcu, eu mollis tellus. Sed finibus--}}
{{--                            aliquam neque sit amet sodales.--}}
{{--                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla maximus pellentes que velit,--}}
{{--                            quis consequat nulla effi citur at. Maecenas sed massa tristique.Duis non volutpat arcu,--}}
{{--                            eu mollis tellus. Sed finibus aliquam neque sit amet sodales. </p>--}}
{{--                        <ul class="list margin-b-30">--}}
{{--                            <li>Duis non volutpat arcu, eu mollis tellus.</li>--}}
{{--                            <li>Quis consequat nulla effi citur at.</li>--}}
{{--                            <li>Sed finibus aliquam neque sit.</li>--}}
{{--                        </ul>--}}
{{--                    </div><!-- experience -->--}}

{{--                    <div class="experience margin-b-50">--}}
{{--                        <h4><b>WEB MASTER/WEB DEVELOPER</b></h4>--}}
{{--                        <h5 class="font-yellow"><b>DESIGN & WEB STUDIO</b></h5>--}}
{{--                        <h6 class="margin-t-10">APRIL 2014 - FEBRUARY 2015</h6>--}}
{{--                        <p class="font-semi-white margin-tb-30">Duis non volutpat arcu, eu mollis tellus. Sed finibus--}}
{{--                            aliquam neque sit amet sodales.--}}
{{--                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla maximus pellentes que velit,--}}
{{--                            quis consequat nulla effi citur at. Maecenas sed massa tristique.Duis non volutpat arcu,--}}
{{--                            eu mollis tellus. Sed finibus aliquam neque sit amet sodales. </p>--}}
{{--                        <ul class="list margin-b-30">--}}
{{--                            <li>Duis non volutpat arcu, eu mollis tellus.</li>--}}
{{--                            <li>Quis consequat nulla effi citur at.</li>--}}
{{--                            <li>Sed finibus aliquam neque sit.</li>--}}
{{--                        </ul>--}}
{{--                    </div><!-- experience -->--}}

{{--                </div><!-- col-sm-8 -->--}}
{{--            </div><!-- row -->--}}
{{--        </div><!-- container -->--}}

{{--    </section><!-- experience-section -->--}}

{{--    <section class="education-section section">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-4">--}}
{{--                    <div class="heading">--}}
{{--                        <h3><b>Education</b></h3>--}}
{{--                        <h6 class="font-lite-black"><b>ACADEMIC CAREER</b></h6>--}}
{{--                    </div>--}}
{{--                </div><!-- col-sm-4 -->--}}
{{--                <div class="col-sm-8">--}}
{{--                    <div class="education-wrapper">--}}
{{--                        <div class="education margin-b-50">--}}
{{--                            <h4><b>MASTER DEGREE IN SCIENCE</b></h4>--}}
{{--                            <h5 class="font-yellow"><b>UCLA - SCIENCE AND ENGINEERING</b></h5>--}}
{{--                            <h6 class="font-lite-black margin-t-10">GRADUATED IN MAY 2010(2 YEARS)</h6>--}}
{{--                            <p class="margin-tb-30">Duis non volutpat arcu, eu mollis tellus. Sed finibus aliquam neque--}}
{{--                                sit amet sodales.--}}
{{--                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla maximus pellentes que--}}
{{--                                velit,--}}
{{--                                quis consequat nulla effi citur at. Maecenas sed massa tristique.Duis non volutpat arcu,--}}
{{--                                eu mollis tellus. Sed finibus aliquam neque sit amet sodales. </p>--}}
{{--                        </div><!-- education -->--}}

{{--                        <div class="education margin-b-50">--}}
{{--                            <h4><b>COURSE ON COMPUTER SCIENCE</b></h4>--}}
{{--                            <h5 class="font-yellow"><b>NEW YORK PUBLIC UNIVERSITY</b></h5>--}}
{{--                            <h6 class="font-lite-black margin-t-10">GRADUATED IN MAY 2009(6 MONTHS)</h6>--}}
{{--                            <p class="margin-tb-30">Duis non volutpat arcu, eu mollis tellus. Sed finibus aliquam neque--}}
{{--                                sit amet sodales.--}}
{{--                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla maximus pellentes que--}}
{{--                                velit,--}}
{{--                                quis consequat nulla effi citur at. Maecenas sed massa tristique.Duis non volutpat arcu,--}}
{{--                                eu mollis tellus. Sed finibus aliquam neque sit amet sodales. </p>--}}
{{--                        </div><!-- education -->--}}

{{--                        <div class="education margin-b-50">--}}
{{--                            <h4><b>GRADUATED VALEDICTERIAN</b></h4>--}}
{{--                            <h5 class="font-yellow"><b>PUBLIC COLLEGE</b></h5>--}}
{{--                            <h6 class="font-lite-black margin-t-10">GRADUATED IN MAY 2008(4 YEARS)</h6>--}}
{{--                            <p class="margin-tb-30">Duis non volutpat arcu, eu mollis tellus. Sed finibus aliquam neque--}}
{{--                                sit amet sodales.--}}
{{--                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla maximus pellentes que--}}
{{--                                velit,--}}
{{--                                quis consequat nulla effi citur at. Maecenas sed massa tristique.Duis non volutpat arcu,--}}
{{--                                eu mollis tellus. Sed finibus aliquam neque sit amet sodales. </p>--}}
{{--                        </div><!-- education -->--}}
{{--                    </div><!-- education-wrapper -->--}}
{{--                </div><!-- col-sm-8 -->--}}
{{--            </div><!-- row -->--}}
{{--        </div><!-- container -->--}}

{{--    </section><!-- about-section -->--}}

    <section class="counter-section" id="counter">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="counter margin-b-30">
                        <h1 class="title">
                            <b><span class="counter-value" data-duration="400" data-count="3">0</span></b>
                        </h1>
                        <h5 class="desc"><b>Coder Degrees</b></h5>
                    </div><!-- counter -->
                </div><!-- col-md-3-->
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="counter margin-b-30">
                        <h1 class="title">
                            <b><span class="counter-value" data-duration="1400" data-count="25">0</span></b>
                        </h1>
                        <h5 class="desc"><b>Nb of jobs</b></h5>
                    </div><!-- counter -->
                </div><!-- col-md-3-->
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="counter margin-b-30">
                        <h1 class="title">
                            <b><span class="counter-value" data-duration="700" data-count="311">0</span></b>
                        </h1>
                        <h5 class="desc"><b>Satisfied Clients</b></h5>
                    </div><!-- counter -->
                </div><!-- col-md-3-->
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="counter margin-b-30">
                        <h1 class="title">
                            <b><span class="counter-value" data-duration="2000" data-count="732">0</span></b>
                        </h1>
                        <h5 class="desc"><b>NNb of Requests</b></h5>
                    </div><!-- margin-b-30 -->
                </div><!-- col-md-3-->
            </div><!-- row-->
        </div><!-- container-->
    </section><!-- counter-section-->
@endsection
@push('js')
    <script src="/public/js/list.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            @isset($service)
                filter('{{$service->name}}');
            @else
            filter('all');
            @endisset
        });
        var options = {
            valueNames: ['reviewservice']
        };
        var reviewsList = new List('reviews-list', options);
        function filter(service) {
            reviewsList.filter(function (item) {
                return !!item.values().reviewservice.includes(service);
            });
        }

        var feedbacks = @json($feedbacks);

        function more(serviceId,index) {
            document.documentElement.style.overflow = 'hidden';
            document.getElementById('modal-container').innerHTML = ' <div class="we-modal  we-modal--open" role="dialog">' +
                '<div class="we-modal__content large-10 medium-12 we-modal__content--review" >' +
                '<div class="we-modal__content__wrapper">' +
                '<div aria-labelledby="we-customer-review-21" class="we-customer-review lockup ember-view">' +
                '<figure aria-label="'+feedbacks[serviceId][index]["rating"]+'out of 5" class="we-star-rating ember-view we-customer-review__rating we-star-rating--large">' +
                '<span class="we-star-rating-stars-outlines">' +
                '<span class="we-star-rating-stars we-star-rating-stars-'+feedbacks[serviceId][index]["rating"]+'"></span></span>' +
                '</figure>' +
                '<div class="we-customer-review__header we-customer-review__header--user">' +
                '<span class="we-truncate we-truncate--single-line ember-view we-customer-review__user"> ' +
                'Client '+feedbacks[serviceId][index]["client"]["name"]+'</span>' +
                '<span class="we-customer-review__separator">, </span>' +
                '<time class="we-customer-review__date">00/00/2020</time>' +
                '</div><h3 class="we-truncate we-truncate--single-line ember-view we-customer-review__title">  Title</h3>' +
                '<blockquote class="we-customer-review__body--modal">' +
                '<p>Review</p></blockquote></div></div>' +
                '<button class="we-modal__close" onclick="less()" aria-label="Close" ></button>' +
                '</div><button class="we-modal__close--overlay" id="close-div" aria-label="Close" ></button>' +
                '</div><div class="overlay"></div>';
            if(feedbacks[serviceId][index]["rating"]>=3){
                $('#modal-container > blockquote').css('border-left', 'border-left:2px solid #5c9a6f');
            }
        }

        function less() {
            document.documentElement.style.overflow = 'scroll';
            const e = document.getElementById("modal-container");
            let child = e.lastElementChild;
            while (child) {
                e.removeChild(child);
                child = e.lastElementChild;
            }
        }
    </script>
    <script src="/public/common-js/jquery-3.2.1.min.js"></script>
    <script src="/public/common-js/tether.min.js"></script>
    <script src="/public/common-js/bootstrap.js"></script>
    <script src="/public/common-js/isotope.pkgd.min.js"></script>
    <script src="/public/common-js/jquery.waypoints.min.js"></script>
    <script src="/public/common-js/progressbar.min.js"></script>
    <script src="/public/common-js/jquery.fluidbox.min.js"></script>
    <script src="/public/common-js/scripts.js"></script>
@endpush

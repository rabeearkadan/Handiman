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
    <style>


        .link:link,.link:visited,a:link,a:visited{text-decoration:none;}
        button{border:0;}
        h2+*,h3+*,p+*{margin-top:0;}
        h2,h3{color:#1d1d1f;}
        blockquote,button,figure,h2,h3,p{margin:0;padding:0;}
        button{background:0 0;-webkit-box-sizing:content-box;box-sizing:content-box;color:inherit;cursor:pointer;font:inherit;line-height:inherit;overflow:visible;vertical-align:inherit;}
        button:disabled{cursor:default;}
        :focus{outline:rgba(0,125,250,.6) solid 4px;outline-offset:1px;}
        ::-moz-focus-inner{border:0;padding:0;}
        h2,h3{font-weight:600;}
        button{font-synthesis:none;-moz-font-feature-settings:'kern';-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;direction:ltr;text-align:left;}
        .link,a{color:#0070c9;letter-spacing:inherit;}
        .link:hover,a:hover{text-decoration:underline;}
        .link:active,a:active{text-decoration:none;}
        .link:disabled,a:disabled{opacity:.32;}
        *,::after,::before{-webkit-box-sizing:inherit;box-sizing:inherit;}
        h2,h3{font-size:1em;font-weight:400;}
        .l-row{padding:0;font-size:0;}
        .l-row--peek{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:end;-webkit-align-items:flex-end;-ms-flex-align:end;align-items:flex-end;}
        .l-row--margin-top{margin-top:20px;}
        .l-column{margin:0;padding:0;display:inline-block;vertical-align:bottom;font-size:13px;}
        .l-row{margin-left:-3.39506%;}
        .l-column{margin-left:3.28358%;}
        .small-valign-top{vertical-align:top!important;-webkit-align-self:start;-ms-flex-item-align:start;align-self:start;}
        @media only screen and (max-width:734px){
            .l-row--peek{overflow-x:auto;overflow-y:hidden;-webkit-overflow-scrolling:touch;overflow-scrolling:touch;width:auto;min-width:100%;white-space:nowrap;margin-bottom:-9.75px;margin-left:-6.25vw;margin-right:-6.25vw;padding-left:6.25vw;padding-right:6.25vw;}
            .l-row--peek::after{content:'';display:block;-webkit-box-flex:0;-webkit-flex:0 0 6.25vw;-ms-flex:0 0 6.25vw;flex:0 0 6.25vw;-webkit-align-self:stretch;-ms-flex-item-align:stretch;align-self:stretch;}
            .l-row--peek .l-column:first-child{margin-left:0;}
            .l-row--peek .small-4{-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0;width:87.5vw;max-width:87.5vw;}
            .l-row--peek .l-column{white-space:normal;padding-bottom:9.75px;}
        }
        .small-4{-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0;width:30.04975%;max-width:30.04975%;}
        .small-8{-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0;width:63.38308%;max-width:63.38308%;}
        @media only screen and (min-width:735px){
            .small-4{-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0;width:30.44316%;max-width:30.44316%;}
            .small-8{-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0;width:63.77649%;max-width:63.77649%;}
        }
        @media only screen and (min-width:1069px){
            .small-4{-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0;width:31.39456%;max-width:31.39456%;}
            .small-8{-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0;width:64.72789%;max-width:64.72789%;}
        }
        @media only screen and (min-width:735px){
            .l-row{margin-left:-2.97619%;}
            .l-column{margin-left:2.89017%;}
        }
        @media only screen and (min-width:735px){
            .medium-6{-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0;width:47.10983%;max-width:47.10983%;}
        }
        @media only screen and (min-width:1069px){
            .medium-6{-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0;width:48.06122%;max-width:48.06122%;}
            .l-row{margin-left:-1.97711%;}
            .l-column{margin-left:1.93878%;}
        }
        @media only screen and (min-width:1069px){
            .large-4{-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0;width:31.39456%;max-width:31.39456%;}
        }
        .l-column--equal-height{-webkit-align-self:stretch;-ms-flex-item-align:stretch;align-self:stretch;}
        .small-hide{display:none;}
        @media only screen and (min-width:735px){
            .medium-hide{display:none;}
            .medium-show{display:block;}
        }
        .l-content-width{margin-left:auto;margin-right:auto;width:87.5%;}
        @media only screen and (min-width:735px){
            .l-content-width{margin-left:auto;margin-right:auto;width:692px;}
        }
        @media only screen and (min-width:1069px){
            .l-content-width{margin-left:auto;margin-right:auto;width:980px;}
        }
        .link{text-decoration:none;}
        .link{color:#0070c9;}
        @media (monochrome),(min-monochrome:1){
            .link{text-decoration:underline!important;}
        }
        .is-app-theme .link{color:#0070c9;}
        .link:active,.link:focus,.link:hover{text-decoration:underline;}
        .section{padding-top:19px;padding-bottom:32px;height:100}
        .section--bordered{border-top:1px solid #d6d6d6;}
        .section__headline{margin-bottom:17px;-webkit-flex-shrink:1;-ms-flex-negative:1;flex-shrink:1;font-size:20px;line-height:1.2;font-weight:700;letter-spacing:.024em;font-family:"SF Pro Display","SF Pro Icons","Apple WebExp Icons Custom","Helvetica Neue",Helvetica,Arial,sans-serif;}
        .section__nav{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-pack:justify;-webkit-justify-content:space-between;-ms-flex-pack:justify;justify-content:space-between;-webkit-box-align:end;-webkit-align-items:flex-end;-ms-flex-align:end;align-items:flex-end;}
        .section__nav__see-all-link{margin-bottom:17px;display:inline-block;-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0;margin-left:16px;}
        .we-truncate{position:relative;z-index:1;}
        .we-truncate--single-line{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
        .we-truncate__button{float:right;}
        .l-column--equal-height>.we-customer-review{min-height:184px;}
        .we-star-rating{display:inline-block;}
        .we-star-rating-stars,.we-star-rating-stars-outlines{display:inline-block;height:9.5px;background-image:url(https://apps.apple.com/assets/images/stars-lg-bc4f4bfdd931e007ab096dd1c209c689.svg);background-size:10px 19px;}
        .we-star-rating--large .we-star-rating-stars,.we-star-rating--large .we-star-rating-stars-outlines{height:25px;background-size:24px 50px;}
        .we-star-rating-stars-outlines{width:50px;background-position:0 9.5px;line-height:9.5px;z-index:1;}
        .we-star-rating--large .we-star-rating-stars-outlines{width:120px;background-position:0 25px;}
        .we-star-rating-stars{width:0;background-position-x:0;}
        .we-star-rating--large .we-star-rating-stars.we-star-rating-stars-1{width:24px;}
        .we-star-rating--large .we-star-rating-stars.we-star-rating-stars-2{width:48px;}
        .we-star-rating--large .we-star-rating-stars.we-star-rating-stars-3{width:72px;}
        .we-star-rating--large .we-star-rating-stars.we-star-rating-stars-4{width:96px;}
        .we-star-rating--large .we-star-rating-stars.we-star-rating-stars-5{width:120px;}


        .we-star-rating-stars.we-star-rating-stars-1{width:10px;}
        .we-star-rating-stars.we-star-rating-stars-2{width:20px;}
        .we-star-rating-stars.we-star-rating-stars-3{width:30px;}
        .we-star-rating-stars.we-star-rating-stars-4{width:40px;}
        .we-star-rating-stars.we-star-rating-stars-5{width:50px;}


        .we-customer-ratings{margin-bottom:15px;}
        .we-customer-ratings__stats{display:-webkit-inline-box;display:-webkit-inline-flex;display:-ms-inline-flexbox;display:inline-flex;vertical-align:bottom;-webkit-box-pack:justify;-webkit-justify-content:space-between;-ms-flex-pack:justify;justify-content:space-between;}
        .we-customer-ratings__averages{text-align:center;color:#636366;font-size:13px;line-height:1.38462;font-weight:600;letter-spacing:-.005em;font-family:"SF Pro Text","SF Pro Icons","Apple WebExp Icons Custom","Helvetica Neue",Helvetica,Arial,sans-serif;}
        @media only screen and (min-width:735px){
            .we-customer-ratings__averages{text-align:left;}
        }
        .we-customer-ratings__count{margin-top:8px;text-align:right;color:#636366;font-size:13px;line-height:1.38462;font-weight:400;letter-spacing:-.005em;font-family:"SF Pro Text","SF Pro Icons","Apple WebExp Icons Custom","Helvetica Neue",Helvetica,Arial,sans-serif;}
        @media only screen and (min-width:735px){
            .we-customer-ratings__count{margin-top:0;-webkit-align-self:flex-end;-ms-flex-item-align:end;align-self:flex-end;}
        }
        .we-customer-review{background-color:#f8f8f8;border-radius:6px;-webkit-align-self:start;-ms-flex-item-align:start;align-self:start;height:100%;}
        .we-customer-ratings__averages__display{margin-bottom:10px;display:block;line-height:43px;font-size:60px;font-weight:700;letter-spacing:-.07em;color:#4c4c50;margin-right:3px;}
        @media only screen and (min-width:735px){
            .we-customer-ratings__averages__display{margin-bottom:0;display:inline-block;}
        }
        .we-customer-review{padding:13px 16px 16px;}
        .we-customer-review__rating{margin-bottom:3px;}
        .we-customer-review__header{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;}
        .we-customer-review__separator{white-space:pre;}
        .we-customer-review__title{font-size:13px;line-height:1.38462;font-weight:600;letter-spacing:-.005em;font-family:"SF Pro Text","SF Pro Icons","Apple WebExp Icons Custom","Helvetica Neue",Helvetica,Arial,sans-serif;}
        .we-customer-review__body{font-size:13px;line-height:1.38462;font-weight:400;letter-spacing:-.005em;font-family:"SF Pro Text","SF Pro Icons","Apple WebExp Icons Custom","Helvetica Neue",Helvetica,Arial,sans-serif;}
        .we-customer-review__header--user{margin-bottom:15px;color:#636366;font-size:12px;line-height:1.33337;font-weight:600;letter-spacing:0;font-family:"SF Pro Text","SF Pro Icons","Apple WebExp Icons Custom","Helvetica Neue",Helvetica,Arial,sans-serif;}
        .we-customer-review__date{-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0;white-space:nowrap;}
        .we-star-bar-graph__row{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;}
        .we-star-bar-graph__bar{width:calc(100% - 59px);height:2px;position:relative;top:1px;background-color:#efeff4;border-radius:4px;margin-left:10px;z-index:1;}
        .we-star-bar-graph__bar__foreground-bar{max-width:100%;height:100%;position:absolute;top:0;background-color:#636366;border-radius:4px;left:0;z-index:1;}
        .we-star-bar-graph__stars{width:10px;height:9px;display:inline-block;background-image:url(https://apps.apple.com/assets/images/five-star-rating-gray-ec0707c56bc834adf5dd504c555d4982.svg);background-size:49px 9px;background-position:100% center;background-repeat:no-repeat;margin-left:auto;}
        .we-star-bar-graph__stars--2{width:19.5px;}
        .we-star-bar-graph__stars--3{width:29.5px;}
        .we-star-bar-graph__stars--4{width:39.5px;}
        .we-star-bar-graph__stars--5{width:49px;}
        @media only screen and (min-width:735px){
            .we-star-bar-graph{margin-bottom:4px;}
        }
        .we-clamp{display:block;overflow:hidden;-webkit-mask-size:100% 100%;mask-size:100% 100%;-webkit-mask-position:right bottom;mask-position:right bottom;word-break:break-word;}








        button{border:0;}
        h3+*,p+*{margin-top:0;}
        h3{color:#1d1d1f;}
        blockquote,button,figure,h3,p{margin:0;padding:0;}
        button{background:0 0;-webkit-box-sizing:content-box;box-sizing:content-box;color:inherit;cursor:pointer;font:inherit;line-height:inherit;overflow:visible;vertical-align:inherit;}
        button:disabled{cursor:default;}
        :focus{outline:rgba(0,125,250,.6) solid 4px;outline-offset:1px;}
        ::-moz-focus-inner{border:0;padding:0;}
        h3{font-weight:600;}
        button{font-synthesis:none;-moz-font-feature-settings:'kern';-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;direction:ltr;text-align:left;}
        *,::after,::before{-webkit-box-sizing:inherit;box-sizing:inherit;}
        h3{font-size:1em;font-weight:400;}
        @media only screen and (min-width:735px){
            .medium-12{-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0;width:97.10983%;max-width:97.10983%;}
        }
        @media only screen and (min-width:1069px){
            .medium-12{-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0;width:98.06122%;max-width:98.06122%;}
        }
        @media only screen and (min-width:1069px){
            .large-10{-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0;width:81.39456%;max-width:81.39456%;}
        }
        .we-truncate{position:relative;z-index:1;}
        .we-truncate--single-line{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
        .we-star-rating{display:inline-block;}
        .we-star-rating-stars,.we-star-rating-stars-outlines{display:inline-block;height:9.5px;background-image:url(https://apps.apple.com/assets/images/stars-lg-bc4f4bfdd931e007ab096dd1c209c689.svg);background-size:10px 19px;}
        .we-star-rating--large .we-star-rating-stars,.we-star-rating--large .we-star-rating-stars-outlines{height:25px;background-size:24px 50px;}
        .we-star-rating-stars-outlines{width:50px;background-position:0 9.5px;line-height:9.5px;z-index:1;}
        .we-star-rating--large .we-star-rating-stars-outlines{width:120px;background-position:0 25px;}
        .we-star-rating-stars{width:0;background-position-x:0;}
        .we-star-rating-stars.we-star-rating-stars-4{width:40px;}
        .we-star-rating--large .we-star-rating-stars.we-star-rating-stars-4{width:96px;}
        .we-customer-review{background-color:#f8f8f8;border-radius:6px;-webkit-align-self:start;-ms-flex-item-align:start;align-self:start;height:100%;}
        .we-customer-review{padding:13px 16px 16px;}
        .we-modal__content__wrapper .we-customer-review{padding-left:0;padding-right:0;}
        .we-customer-review__rating{margin-bottom:3px;}
        .we-customer-review__header{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;}
        .we-customer-review__separator{white-space:pre;}
        .we-customer-review__title{font-size:13px;line-height:1.38462;font-weight:600;letter-spacing:-.005em;font-family:"SF Pro Text","SF Pro Icons","Apple WebExp Icons Custom","Helvetica Neue",Helvetica,Arial,sans-serif;}
        .we-customer-review__header--user{margin-bottom:15px;color:#636366;font-size:12px;line-height:1.33337;font-weight:600;letter-spacing:0;font-family:"SF Pro Text","SF Pro Icons","Apple WebExp Icons Custom","Helvetica Neue",Helvetica,Arial,sans-serif;}
        .we-customer-review__date{-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0;white-space:nowrap;}
        .we-modal{
            position:sticky;
            top:48px;right:0;bottom:0;left:10;display:none;max-height:100vh;z-index:0;}
        @media (-ms-high-contrast:none),(-ms-high-contrast:active){
            .we-modal{top:0;}
        }
        @media only screen and (min-width:735px){
            .we-modal{top:0;}
        }
        .we-modal__content{height:calc(100vh - 49px);width:100%;position:fixed;top:50%;background:#fff;word-break:break-word;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%);left:50%;z-index:1;border-top:1px solid #d6d6d6;padding:30px 5px 30px 20px;}
        @media only screen and (min-width:735px){
            .we-modal__content{height:auto;max-width:600px;max-height:calc(100vh - 108px);border:1px solid rgba(0,0,0,.08);border-radius:10px;-webkit-box-shadow:0 15px 20px rgba(0,0,0,.5);box-shadow:0 15px 20px rgba(0,0,0,.5);}
        }
        .we-modal__content--review{background-color:#f8f8f8;}
        .we-modal__content__wrapper{max-height:calc(100vh - 109px);overflow:auto;-webkit-overflow-scrolling:touch;padding-right:15px;}
        @media only screen and (min-width:735px){
            .we-modal__content__wrapper{max-height:calc(100vh - 168px);}
        }
        @media (-ms-high-contrast:none),(-ms-high-contrast:active){
            .we-modal__content{border-top:0;height:100vh;}
            .we-modal__content__wrapper{max-height:100%;}
        }
        .we-modal--open{display:block;z-index:10001;}
        .we-modal__close{
            margin:0;
            padding:0 20px 0 0;
            width:40px;
            height:30px;
            -webkit-box-sizing:border-box;
            box-sizing:border-box;border:0;
            position:absolute;
            top:15px;
            overflow:hidden;
            -webkit-transform:translateY(-50%);
            -ms-transform:translateY(-50%);
            transform:translateY(-50%);
            font-size:20px;
            cursor:pointer;background:0 0;
            color:#636366;
            text-align:right;
            left:0;
            z-index:10001;

        }
        .we-modal__close::after,.we-modal__close::before{
            font-family:"SF Pro Icons","Apple WebExp Icons Custom";
            color:inherit;
            display:inline-block;
            font-style:normal;
            font-weight:inherit;
            font-size:inherit;line-height:1;
            position:relative;z-index:1;alt:'';
            text-decoration:none;
            content: "\00d7";

        }
        .we-modal__close::before{display:none;}
        .we-modal__close--overlay{width:100%;position:absolute;top:0;right:0;bottom:0;left:0;cursor:default;z-index:0;}


        .we-customer-review__body {
            font-size: 13px;
            line-height: 1.38462;
            font-weight: 400;
            letter-spacing: -.005em;
            font-family: "SF Pro Text","SF Pro Icons","Apple WebExp Icons Custom","Helvetica Neue",Helvetica,Arial,sans-serif;
        }
        .we-truncate__button {
            position: absolute;
            bottom: 0;
            float: initial;
            right: 0;
            z-index: 1;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: 1000;
            background-color: rgba(255,255,255,.9);
        }
        modal-open{
            overflow:hidden;
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
        <a class="downlad-btn" href="{{route('client.request.create',['service_id'=>$service->id,'employee_id'=>$employee->id])}}"> Request </a>

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
                    @foreach($employee->services as $service)
                        <a href="#" data-filter=".{{$service->name}}"><b> {{$service->name}} </b></a>
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


<section class="l-content-width section section--bordered">
    <div class="section__nav">
        <h2 class="section__headline">
            Ratings and Reviews
        </h2>

        <a href="#" class="link section__nav__see-all-link ember-view">See All</a>
    </div>
    <div class="we-customer-ratings lockup ember-view">
        <div class="l-row">
            <div class="we-customer-ratings__stats l-column small-4 medium-6 large-4">
                <div class="we-customer-ratings__averages">
                    <span class="we-customer-ratings__averages__display">N.M</span> out of 5
                </div>
                <div class="we-customer-ratings__count small-hide medium-show"> N Ratings</div>
            </div>
            <div class=" l-column small-8 medium-6 large-4">
                <figure class="we-star-bar-graph">
                    <div class="we-star-bar-graph__row">
                        <span class="we-star-bar-graph__stars we-star-bar-graph__stars--5"></span>
                        <div class="we-star-bar-graph__bar">
                            <div class="we-star-bar-graph__bar__foreground-bar" style="width: 0%;"></div>
                        </div>
                    </div>
                    <div class="we-star-bar-graph__row">
                        <span class="we-star-bar-graph__stars we-star-bar-graph__stars--4"></span>
                        <div class="we-star-bar-graph__bar">
                            <div class="we-star-bar-graph__bar__foreground-bar" style="width: 0%;"></div>
                        </div>
                    </div>
                    <div class="we-star-bar-graph__row">
                        <span class="we-star-bar-graph__stars we-star-bar-graph__stars--3"></span>
                        <div class="we-star-bar-graph__bar">
                            <div class="we-star-bar-graph__bar__foreground-bar" style="width: 0%;"></div>
                        </div>
                    </div>
                    <div class="we-star-bar-graph__row">
                        <span class="we-star-bar-graph__stars we-star-bar-graph__stars--2"></span>
                        <div class="we-star-bar-graph__bar">
                            <div class="we-star-bar-graph__bar__foreground-bar" style="width: 0%;"></div>
                        </div>
                    </div>
                    <div class="we-star-bar-graph__row">
                        <span class="we-star-bar-graph__stars "></span>
                        <div class="we-star-bar-graph__bar">
                            <div class="we-star-bar-graph__bar__foreground-bar" style="width: 0%;"></div>
                        </div>
                    </div>
                </figure>
                <p class="we-customer-ratings__count medium-hide"> N Ratings</p>
            </div>
        </div>
    </div>

    <div class="l-row l-row--peek">

        <div class="ember-view small-valign-top l-column--equal-height l-column small-4 medium-6 large-4">
            <div class="ember-view">
            </div>
            <div class="we-customer-review lockup ember-view">
                <figure aria-label="4 out of 5" class="we-star-rating ember-view we-customer-review__rating we-star-rating--large"><span class="we-star-rating-stars-outlines">
         <span class="we-star-rating-stars we-star-rating-stars-4"></span>
       </span>
                    <!----></figure>

                <div class="we-customer-review__header we-customer-review__header--user">
         <span class="we-truncate we-truncate--single-line ember-view we-customer-review__user">  Client Name
       </span>

                    <span class="we-customer-review__separator">, </span>

                    <time aria-label="May 00, 2020" class="we-customer-review__date">00/00/2020</time>
                </div>

                <h3 class="we-truncate we-truncate--single-line ember-view we-customer-review__title"> Title
                </h3>

                <blockquote class="we-truncate we-truncate--multi-line we-truncate--interactive we-truncate--truncated ember-view we-customer-review__body">

                    <div class="we-clamp ember-view" style="height: 72px; -webkit-mask: linear-gradient(0deg, rgba(0, 0, 0, 0) 0px, rgba(0, 0, 0, 0) 18.0001px, rgb(0, 0, 0) 18.0001px), linear-gradient(270deg, rgba(0, 0, 0, 0) 0px, rgba(0, 0, 0, 0) 32.8px, rgb(0, 0, 0) 68.8002px);">
                        <p>Review</p>
                    </div>




                    <button onclick="more()" class="we-truncate__button link">
                        more
                    </button>
                </blockquote>

                <!----></div>

        </div>


        <div  class="ember-view small-valign-top l-column--equal-height l-column small-4 medium-6 large-4">
            <div  class="ember-view">
            </div>
            <div class="we-customer-review lockup ember-view">
                <figure aria-label="4 out of 5"  class="we-star-rating ember-view we-customer-review__rating we-star-rating--large"><span class="we-star-rating-stars-outlines">
         <span class="we-star-rating-stars we-star-rating-stars-4"></span>
       </span>
                    <!----></figure>

                <div class="we-customer-review__header we-customer-review__header--user">
         <span class="we-truncate we-truncate--single-line ember-view we-customer-review__user">  Client Name
       </span>

                    <span class="we-customer-review__separator">, </span>

                    <time  aria-label="May 00, 2020" class="we-customer-review__date">00/00/2020</time>
                </div>

                <h3  class="we-truncate we-truncate--single-line ember-view we-customer-review__title"> Title
                </h3>

                <blockquote  class="we-truncate we-truncate--multi-line we-truncate--interactive we-truncate--truncated ember-view we-customer-review__body">

                    <div  class="we-clamp ember-view"  style="height: 72px; -webkit-mask: linear-gradient(0deg, rgba(0, 0, 0, 0) 0px, rgba(0, 0, 0, 0) 18.0001px, rgb(0, 0, 0) 18.0001px), linear-gradient(270deg, rgba(0, 0, 0, 0) 0px, rgba(0, 0, 0, 0) 32.8px, rgb(0, 0, 0) 68.8002px);">
                        <p >Review</p>
                    </div>




                    <button onclick="more()" class="we-truncate__button link">
                        more
                    </button>
                </blockquote>

                <!----></div>

        </div>



    </div>


    </div>

    <div class="l-row l-row--margin-top medium-hide">

        <!---->

        <!---->

        <!---->

        <!---->

        <!---->

        <!---->

        <!---->

        <!---->

        <!---->

        <!---->

    </div>
</section>



<div id="modal-container">

</div>





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
    <script>

        function more(){
            document.documentElement.style.overflow = 'hidden';
            document.body.innerHTML+= '<div class="overlay"></div> ';
            document.getElementById('modal-container').innerHTML = ' <div class="we-modal  we-modal--open" role="dialog"><div class="we-modal__content large-10 medium-12 we-modal__content--review" ><div class="we-modal__content__wrapper"><div aria-labelledby="we-customer-review-21" class="we-customer-review lockup ember-view"><figure aria-label="3 out of 5" class="we-star-rating ember-view we-customer-review__rating we-star-rating--large"><span class="we-star-rating-stars-outlines"><span class="we-star-rating-stars we-star-rating-stars-3"></span></span></figure><div class="we-customer-review__header we-customer-review__header--user"><span class="we-truncate we-truncate--single-line ember-view we-customer-review__user"> Client Name</span><span class="we-customer-review__separator">, </span><time class="we-customer-review__date">00/00/2020</time></div><h3 class="we-truncate we-truncate--single-line ember-view we-customer-review__title">  Title</h3><blockquote class="we-customer-review__body--modal"><p>Review</p></blockquote></div></div><button class="we-modal__close" onclick="less()" aria-label="Close" ></button></div><button class="we-modal__close--overlay" id="close-div" aria-label="Close" ></button></div>';
        }


        function less() {

            document.documentElement.style.overflow = 'scroll';
            Element.prototype.remove = function() {
                this.parentElement.removeChild(this);
            };
            NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
                for(var i = this.length - 1; i >= 0; i--) {
                    if(this[i] && this[i].parentElement) {
                        this[i].parentElement.removeChild(this[i]);
                    }
                }
            };
            document.getElementsByClassName('overlay').remove();

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





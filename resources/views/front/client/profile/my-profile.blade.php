@extends('layouts.client.app')
@push('css')
    <link href="{{asset('css/client/my-profile.css')}}" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
@endpush
@section('content')
    <div class="page-wrapper" id="profile">
        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-lg-3">
                            <div class="sidebar">
                                <div class="widget">
                                    <div class="user-photo">
                                        <a href="#">
                                            <img src="assets/img/tmp/agent-2.jpg" alt="User Photo">
                                            <span class="user-photo-action">Click here to reupload</span>
                                        </a>
                                    </div><!-- /.user-photo -->
                                </div><!-- /.widget -->


                                <div class="widget">

                                    <ul class="menu-advanced">
                                        <li class="@if(request()->is('client/profile')) {{'is-active'}} @endif"><a href="{{route('client.profile')}}"><i class="fa fa-user"></i> Edit Profile</a></li>
                                        <li class="@if(request()->is('client/profile/password')) {{'is-active'}} @endif"><a href="{{route('client.password')}}"><i class="fa fa-key"></i> Password</a></li>
                                        <li class="@if(request()->is('client/profile/payment')) {{'is-active'}} @endif"><a href="{{route('client.payment')}}"><i class="fas fa-wallet"></i> Payment</a></li>
                                    </ul>
                                </div><!-- /.widget -->

                            </div><!-- /.sidebar -->
                        </div><!-- /.col-* -->

                        <div class="col-sm-8 col-lg-9">
                            <div class="content">
                                @yield('content')
                            </div>
                        </div><!-- /.col-* -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.main-inner -->
        </div><!-- /.main -->



    </div><!-- /.page-wrapper -->
@endsection



@extends('layouts.client.app')
@push('css')
    <link href="{{asset('css/client/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/buttons.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/common-classes.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/forms.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/widgets.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/user.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/colorbox.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div class="page-wrapper" id="profile" style="background-color: #f7f8f9;">
        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-lg-3">
                            <div class="sidebar">
                                <div class="widget">
                                    <div class="user-photo">
                                        <a href="#">
                                            <img src="" alt="User Photo">
                                            <span class="user-photo-action">Click here to re-upload</span>
                                        </a>
                                    </div><!-- /.user-photo -->
                                </div><!-- /.widget -->
                                <div class="widget">
                                    <ul class="menu-advanced">
                                        <li class="@if(request()->is('client/profile')) {{'active'}} @endif"><a href="{{route('client.profile')}}"><i class="fa fa-user"></i> Edit Profile </a></li>
                                        <li class="@if(request()->is('client/profile/password')) {{'active'}} @endif"><a href="{{route('client.password')}}"><i class="fa fa-key"></i> Security </a></li>
                                        <li class="@if(request()->is('client/profile/payment')) {{'active'}} @endif"><a href="{{route('client.payment')}}"><i class="fa fa-money"></i> Payment </a></li>
                                    </ul>
                                </div><!-- /.widget -->
                            </div><!-- /.sidebar -->
                        </div><!-- /.col-* -->
                        <div class="col-sm-8 col-lg-9">
                            <div class="content">
                                @yield('profile-content')
                            </div>
                        </div><!-- /.col-* -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.main-inner -->
        </div><!-- /.main -->
    </div><!-- /.page-wrapper -->
@endsection



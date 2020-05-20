@extends('layouts.employee.app')
@push('css')
    <link href="{{asset('css/employee/my-profile.css')}}" rel="stylesheet">
    <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <style>
        @media screen and (min-width: 460px) {
            .col-sm-12 {
                padding-right: 5px;
                padding-left: 5px;
            }
        }
    </style>
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
                                            <img src="" alt="User Photo">
                                            <span class="user-photo-action">Click here to reupload</span>
                                        </a>
                                    </div><!-- /.user-photo -->
                                </div><!-- /.widget -->
                                <div class="widget">
                                    <ul class="menu-advanced">
                                        <li class="@if(request()->is('employee/profile')) {{'active'}} @endif">
                                            <a href="{{route('employee.profile')}}">
                                                <i class="fa fa-user"></i>
                                                Edit Profile
                                            </a>
                                        </li>
                                        <li class="@if(request()->is('employee/profile/password')) {{'active'}} @endif">
                                            <a href="{{route('employee.password')}}">
                                                <i class="fa fa-key"></i>
                                                Password
                                            </a>
                                        </li>
                                        <li class="@if(request()->is('employee/profile/payment')) {{'active'}} @endif">
                                            <a href="{{route('employee.payment')}}">
                                                <i class="fa fa-money"></i>
                                                Payment
                                            </a>
                                        </li>
                                        <li class="@if(request()->is('employee/profile/schedule/edit')) {{'active'}} @endif">
                                            <a href="{{route('employee.schedule.edit')}}">
                                                <i class="fa fa-calendar"></i>
                                                Schedule
                                            </a>
                                        </li>
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

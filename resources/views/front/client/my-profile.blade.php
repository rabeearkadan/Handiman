@extends('layouts.client.app')
@push('css')
    <link href="{{asset('css/client/my-profile.css')}}" rel="stylesheet">
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
                                        <li><a href="listing-submit.html"><i class="fa fa-pencil"></i> Submit Listing</a></li>
                                        <li class="active"><a href="#"><i class="fa fa-user"></i> Edit Profile</a></li>
                                        <li><a href="#"><i class="fa fa-key"></i> Password</a></li>
                                        <li><a href="#"><i class="fa fa-sign-out"></i> Logout</a></li>
                                    </ul>
                                </div><!-- /.widget -->

                            </div><!-- /.sidebar -->
                        </div><!-- /.col-* -->

                        <div class="col-sm-8 col-lg-9">
                            @include('front.client.partials.profile.edit-profile')
                        </div><!-- /.col-* -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.main-inner -->
        </div><!-- /.main -->



    </div><!-- /.page-wrapper -->
@endsection



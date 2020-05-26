@extends('layouts.employee.app')
@push('css')
    <link href="{{asset('css/employee/my-profile.css')}}" rel="stylesheet">
    <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div class="page-wrapper" id="profile">
        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-lg-3">
                            <div class="sidebar">
                                <form method="post" action="{{route('employee.image.update')}}" id="image-form" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="widget">
                                        <div class="user-photo">
                                            <a href="#">
                                                <img id="image" src="@if(Auth::user()->image){{config('image.path').Auth::user()->image}}@else /public/images/employee/profile-image.png @endif" alt="User Photo">
                                                <a href="#" onclick="removeImage()" style="position: absolute; @if(!Auth::user()->image) display:none @endif">
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                                <label for="image-input" style="height: 25px">
                                                    <span class="user-photo-action" >Click here to change</span>
                                                    <input type="file" id="image-input" name="image-input"  onchange="readURL(this);" style="display:none" accept="image/jpeg, image/png">
                                                </label>
                                            </a>
                                        </div><!-- /.user-photo -->
                                    </div><!-- /.widget -->
                                </form>
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
                                        <li class="@if(request()->is('employee/profile/documents/edit')) {{'active'}} @endif">
                                            <a href="{{route('employee.documents.edit')}}">
                                                <i class="fa fa-paperclip"></i>
                                                Documents
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
@push('js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image')
                        .attr('src', e.target.result)
                };
                reader.readAsDataURL(input.files[0]);
            }
            var form = document.getElementById('image-form');
            form.submit();
        }
        function removeImage() {
            var form = document.getElementById('image-remove');
            form.submit();
        }
    </script>
@endpush

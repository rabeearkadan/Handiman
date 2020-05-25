@extends('layouts.client.app')
@push('css')
    <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/client/buttons.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/common-classes.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/forms.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/widgets.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/user.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/color-box.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="page-wrapper" id="profile" style="background-color: #f7f8f9;">
        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-lg-3">
                            <div class="sidebar">
                                <form method="post" action="{{route('client.image.update')}}" id="image-form" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                <div class="widget">
                                    <div class="user-photo">
                                        <a href="#">
                                            <img id="image" src="@if(Auth::user()->image){{config('image.path').Auth::user()->image}}@else /public/images/client/profile-image.png @endif" alt="User Photo">
                                            <label for="image-input" style="height: 25px">
                                                <span class="user-photo-action" >Click here to re-upload</span>
                                                <input type="file" id="image-input" name="image-input"  onchange="readURL(this);" style="display:none" accept="image/jpeg, image/png">
                                            </label>
                                        </a>
                                    </div><!-- /.user-photo -->
                                </div><!-- /.widget -->
                                </form>
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
    </script>
@endpush

@extends('layouts.employee.app')
@push('css')
    <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/buttons.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/common-classes.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/forms.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/listing-detail.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/color-box.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/file-input.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/submit-button-post.css')}}" rel="stylesheet">
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
                                    <h1>Add post</h1>
                                </div>
                                <form action="{{route('employee.post.store')}}" method="post" id="new_post">
                                    @csrf
                                    <div class="background-white p30 mb30">
                                        <h3 class="page-title">Description</h3>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="title" placeholder="Title">
                                        </div><!-- /.form-group -->
                                        <div class="form-group">
                                            <textarea class="form-control" name="body" placeholder="Body" rows="8"></textarea>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.box -->

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="background-white p30 mb30">
                                                <h3 class="page-title">Gallery</h3>
                                                <input type="file" id="input-file">
                                            </div><!-- /.box -->
                                        </div>
                                    </div><!-- /.row -->
                                    <div class="background-white p30 mb30">
                                        <h3 class="page-title"> Tags </h3>
                                        <ul class="amenities">
                                            @foreach($user->services() as $service)
                                                <li class="checkbox">
                                                    <input type="checkbox" name="tags[]" value="{{$service['id']}}" id="{{$service['id']}}">
                                                    <label for="{{$service['id']}}"> {{$service['name']}} </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </form>
                                <div class="center">
                                    <div class="button">
                                        <a>
                                            <span>Upload Now</span>
                                            <svg class="load" x="0px" y="0px" width="30px" height="30px"
                                                 viewBox="0 0 40 40" enable-background="new 0 0 40 40">
                                                <path opacity="0.3" fill="#fff" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
            s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
            c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/>
                                                <path fill="#fff" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
            C22.32,8.481,24.301,9.057,26.013,10.047z">
                                                    <animateTransform attributeType="xml" attributeName="transform"
                                                                      type="rotate" from="0 20 20"
                                                                      to="360 20 20"
                                                                      dur="0.5s"
                                                                      repeatCount="indefinite"/>
                                                </path>
                                            </svg>
                                            <svg class="check" xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                 viewBox="0 0 24 24">
                                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                            </svg>
                                        </a>
                                        <div>
                                            <span></span>
                                        </div>
                                    </div>
                                </div><!-- /.center -->
                            </div><!-- /.content -->
                        </div><!-- /.col-* -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.main-inner -->
        </div><!-- /.main -->
    </div><!-- /.page-wrapper -->
@endsection
@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="/public/js/employee/collapse.js" type="text/javascript"></script>
    <script src="/public/js/employee/dropdown.js" type="text/javascript"></script>
    <script src="/public/js/employee/jquery.colorbox-min.js" type="text/javascript"></script>
    <script src="/public/js/employee/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="/public/js/employee/fileinput.min.js" type="text/javascript"></script>
    <script src="/public/js/employee/superlist.js" type="text/javascript"></script>
    <script src="/public/js/employee/submit-button-add-post.js" type="text/javascript"></script>
@endpush

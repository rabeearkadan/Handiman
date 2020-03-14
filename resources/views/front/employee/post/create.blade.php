@extends('layouts.employee.app')
@push('css')
    <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/buttons.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/common-classes.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/forms.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/listing-detail.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/color-box.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/fileinput.min.css')}}" rel="stylesheet">
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
                                <div class="background-white p30 mb30">
                                    <h3 class="page-title">Description</h3>
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Title">
                                    </div><!-- /.form-group -->

                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Listing Description"
                                                  rows="8"></textarea>
                                    </div><!-- /.form-group -->
                                </div><!-- /.box -->

                                <div class="background-white p30 mb30">
                                    <h3 class="page-title">Attributes</h3>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <select name="property">
                                                    <option>Property Type</option>
                                                    <option>Apartment</option>
                                                    <option>Condo</option>
                                                    <option>House</option>
                                                    <option>Villa</option>
                                                </select>
                                            </div><!-- /.form-group -->

                                            <div class="form-group">
                                                <select name="contract">
                                                    <option>Contract</option>
                                                    <option>Rent</option>
                                                    <option>Sale</option>
                                                </select>
                                            </div><!-- /.form-group -->

                                            <div class="form-group">
                                                <select name="location">
                                                    <option>Location</option>
                                                    <option>Kensal</option>
                                                    <option>Braymer</option>
                                                    <option>Horton Bay</option>
                                                    <option>Laurel Run</option>
                                                    <option>Estherville</option>
                                                    <option>Millhousen</option>
                                                    <option>Allegan</option>
                                                    <option>Florala</option>
                                                    <option>Dundarrach</option>
                                                    <option>Neligh</option>
                                                    <option>Roseboro</option>
                                                    <option>Mount Pleasant</option>
                                                    <option>Moro</option>
                                                    <option>Strathmoor Village</option>
                                                    <option>Mabton</option>
                                                    <option>Loup City</option>
                                                    <option>Wolverine</option>
                                                    <option>San Leandro</option>
                                                    <option>Dunwoody</option>
                                                    <option>Battle Ground</option>
                                                    <option>Hanson</option>
                                                    <option>Reedley</option>
                                                    <option>Bayshore</option>
                                                    <option>Tupelo</option>
                                                    <option>Lone Pine</option>
                                                </select>
                                            </div><!-- /.form-group -->

                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                                <input class="form-control" type="text" placeholder="Price">
                                            </div><!-- /.form-group -->
                                        </div><!-- /.col-* -->

                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                                                <input class="form-control" type="text" placeholder="Address">
                                            </div><!-- /.form-group -->

                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-map-o"></i></span>
                                                <input class="form-control" type="text" placeholder="City">
                                            </div><!-- /.form-group -->

                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                <input class="form-control" type="text" placeholder="Phone">
                                            </div><!-- /.form-group -->

                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-at"></i></span>
                                                <input class="form-control" type="text" placeholder="E-mail">
                                            </div><!-- /.form-group -->
                                        </div><!-- /.col-* -->
                                    </div><!-- /.row -->
                                </div><!-- /.box -->

                                <div class="row">


                                    <div class="col-sm-12">
                                        <div class="background-white p30 mb30">
                                            <h3 class="page-title">Gallery</h2>
                                                <input type="file" id="input-file">
                                        </div><!-- /.box -->
                                    </div>
                                </div><!-- /.row -->

                                <div class="background-white p30 mb30">
                                    <h3 class="page-title">Amenities</h3>

                                    <ul class="amenities">
                                        <li class="checkbox"><input type="checkbox" id="amenity-1"> <label
                                                for="amenity-1">Air conditioning</label></li>
                                        <li class="checkbox"><input type="checkbox" id="amenity-2"> <label
                                                for="amenity-2">Balcony</label></li>
                                        <li class="checkbox"><input type="checkbox" id="amenity-3"> <label
                                                for="amenity-3">Bedding</label></li>
                                        <li class="checkbox"><input type="checkbox" id="amenity-4"> <label
                                                for="amenity-4">Cable TV</label></li>
                                        <li class="checkbox"><input type="checkbox" id="amenity-5"> <label
                                                for="amenity-5">Cleaning after exit</label></li>
                                        <li class="checkbox"><input type="checkbox" id="amenity-6"> <label
                                                for="amenity-6">Cofee pot</label></li>
                                        <li class="checkbox"><input type="checkbox" id="amenity-7"> <label
                                                for="amenity-7">Computer</label></li>
                                        <li class="checkbox"><input type="checkbox" id="amenity-8"> <label
                                                for="amenity-8">Cot</label></li>
                                        <li class="checkbox"><input type="checkbox" id="amenity-9"> <label
                                                for="amenity-9">Dishwasher</label></li>


                                    </ul>
                                </div>

                                <div class="center">
                                    <div class="button">
                                        <a>
                                            <span>Upload Now</span>
                                            <svg class="load" version="1.1" x="0px" y="0px" width="30px" height="30px"
                                                 viewBox="0 0 40 40" enable-background="new 0 0 40 40">
                                                <path opacity="0.3" fill="#fff" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
            s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
            c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/>
                                                <path fill="#fff" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
            C22.32,8.481,24.301,9.057,26.013,10.047z">
                                                    <animateTransform attributeType="xml"
                                                                      attributeName="transform"
                                                                      type="rotate"
                                                                      from="0 20 20"
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
    <script src="/public/js/employee/collapse.js" type="text/javascript"></script>
    <script src="/public/js/employee/dropdown.js" type="text/javascript"></script>
    <script src="/public/js/employee/jquery.colorbox-min.js" type="text/javascript"></script>
    <script src="/public/js/employee/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="/public/js/employee/fileinput.min.js" type="text/javascript"></script>
    <script src="/public/js/employee/superlist.js" type="text/javascript"></script>
    <script src="/public/js/employee/submit-button-add-post.js" type="text/javascript"></script>
@endpush

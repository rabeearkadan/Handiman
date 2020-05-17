@extends('layouts.client.app')
@push('css')
    <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/buttons.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/forms.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/fullscreen-classes.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/listing-cards.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/filter.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/color-box.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/bootstrap-select.min.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div class="page-wrapper">
        <div class="main">
            <div id="employees-list" class="fullscreen-wrapper" style="padding:12px">
                <form class="filter" method="post" action="?">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <input type="text" placeholder="Keyword" class="form-control search">
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->

                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <select class="form-control" title="Select Location">
                                    <option> N</option>

                                </select>
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->

                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <select class="form-control" title="Select Category">
                                    <option value=""> N</option>
                                </select>
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->
                    </div><!-- /.row -->

                    <hr>

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="filter-actions">
                                <a href="#"><i class="fa fa-close"></i> Reset Filter</a>
                                <a href="#"><i class="fa fa-save"></i> Save Search</a>
                            </div><!-- /.filter-actions -->
                        </div><!-- /.col-* -->

                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary">Redefine Search Result</button>
                        </div><!-- /.col-* -->
                    </div><!-- /.row -->
                </form>

                <h2 class="page-title">
                    N results matching your query
                </h2><!-- /.page-title -->

                <form method="get" action="?" class="filter-sort">
                    <div class="form-group">
                        <select title="Sort by">
                            <option name="price">Price</option>
                            <option name="rating">Rating</option>
                        </select>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <select title="Order">
                            <option name="ASC">Asc</option>
                            <option name="DESC">Desc</option>
                        </select>
                    </div><!-- /.form-group -->
                </form>

                <div class="cards-row" style="margin-top:75px">
                    <div class="list">
                    @foreach($service->users as $employee)
                        <div class="card-row">
                            <div class="card-row-inner">
                                <div class="card-row-image"
                                     data-background-image="{{config('image.path').$employee->image}}">
                                    <a href="{{route('client.user-profile',[$service->id,$employee->id])}}">
                                        <div class="card-row-label">{{$service->name}} </div><!-- /.card-row-label -->
                                        <div class="card-row-price"> ${{$employee->price}} / hr</div><!-- -->
                                    </a>
                                </div><!-- /.card-row-image -->
                                <div class="card-row-body">
                                    <h2 class="card-row-title">
                                        <a href="{{route('client.user-profile',[$service->id,$employee->id])}}" class="name">{{$employee->name}} </a>
                                    </h2>
                                    <div class="card-row-content">
                                        <p class="biography"> {{$employee->biography}} </p>
                                    </div><!-- /.card-row-content -->
                                </div><!-- /.card-row-body -->
                                <div class="card-row-properties">
                                    <dl>
                                        <dd>Price</dd>
                                        <dt class="price"> ${{$employee->price}} / hr</dt>
                                        <dd>Category</dd>
                                        <dt> Category</dt>
                                        <dd>Location</dd>
                                        <dt>Location</dt>
                                        <dd> Rating</dd>
                                        <dt>
                                            <div class="card-row-rating">
                                                @for($x=$employee->rating;$x>0;$x--)
                                                    @if($x<1)
                                                        <i class="fa fa-star-half-o"></i>
                                                    @else
                                                        <i class="fa fa-star"></i>
                                                    @endif
                                                @endfor
                                                @for($x=5-ceil($employee->rating);$x>0;$x--)
                                                    <i class="fa fa-star-o"></i>
                                                @endfor
                                            </div><!-- /.card-row-rating -->
                                        </dt>
                                    </dl>
                                </div><!-- /.card-row-properties -->
                            </div><!-- /.card-row-inner -->
                        </div><!-- /.card-row -->
                    @endforeach
                    </div><!-- /.list -->
                </div><!-- /.cards-row -->
            </div><!-- /.fullscreen-wrapper -->
        </div><!-- /.main -->
    </div><!-- /.page-wrapper -->
@endsection
@push('js')
    <script src="/public/js/client/dropdown.js" type="text/javascript"></script>
    <script src="/public/js/client/jquery.colorbox-min.js" type="text/javascript"></script>
    <script src="/public/js/client/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="/public/js/client/superlist.js" type="text/javascript"></script>
    <script src="/public/js/client/list.js" type="text/javascript"></script>
    <script>

        var options = {
            valueNames: [ 'name', 'price' ],
            fuzzySearch: {
                searchClass: "fuzzy-search",
                location: 0,
                distance: 100,
                threshold: 0.4,
                multiSearch: true
            }
        };
        var employeesList = new List('employees-list', options);
        function defaultSort(element){
            employeeslist.sort(element.innerHTML, { order: "asc" })
        }
    </script>
@endpush





@extends('layouts.client.app')
@push('css')
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/buttons.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/common-classes.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/requests/materialize.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/requests/file-uploader.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/color-box.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/requests/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="screen">
    <link href="{{asset('css/client/requests/icons.css')}}" rel="stylesheet" media="screen">
    <style>
        .main-inner {
            padding: 0;
        }

        .pull-right {
            float: right;
        }

        /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #description {
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
        }

        #infowindow-content .title {
            font-weight: bold;
        }

        #infowindow-content {
            display: none;
        }

        #map #infowindow-content {
            display: inline;
        }

        .pac-card {
            margin: 10px 10px 0 0;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            font-family: Roboto;
        }

        #pac-container {
            padding-bottom: 12px;
            margin-right: 12px;
        }

        .pac-controls {
            display: inline-block;
            padding: 5px 11px;
        }

        .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }

        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        #title {
            color: #fff;
            background-color: #4d90fe;
            font-size: 25px;
            font-weight: 500;
            padding: 6px 12px;
        }
        #target {
            width: 345px;
        }
    </style>

@endpush
@section('content')
    <body>
    <div class="page-wrapper">
        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <div class="content">
                        @if($employee)
                            <div class="contact-form-wrapper clearfix background-white p30">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <img src="{{config('image.path').$employee->image}}" class="img-thumbnail"
                                             alt="employee">
                                        <h2>
                                            {{$employee->name}}
                                        </h2>
                                    </div>
                                    <div class="col-sm-10">
                                        <h3>will put employee info later here</h3>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <h3> The more you elaborate, the more we can help!</h3>
                        <div class="contact-form-wrapper clearfix background-white p30">
                            <form class="contact-form" method="post" action="{{route('client.request.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="contact-form-subject">Subject</label>
                                            <input type="text" name="subject" id="contact-form-subject"
                                                   class="form-control">
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->
                                </div><!-- /.row -->

                                <div class="form-group">
                                    <label for="contact-form-message"> Problem Description</label>
                                    <textarea class="form-control" id="contact-form-message" rows="6"></textarea>
                                </div><!-- /.form-group -->
                                <div class="form-group">
                                    <label for="contact-form-message"> Pick time </label>
                                    <div class="form-group">
                                        <label for="dtp_input2" class="col-md-2 control-label">Date Picking</label>
                                        <div class="input-group date form_date col-md-7" data-date=""
                                             data-date-format="dd MM yyyy" data-link-field="dtp_input2"
                                             data-link-format="yyyy-mm-dd">
                                            <input name="date" class="form-control" size="16" type="text" value="" readonly>
                                            <span class="input-group-addon"><span
                                                    class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><span
                                                    class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <input type="hidden" id="dtp_input2" value=""/><br/>
                                    </div>
                                </div><!-- /.form-group -->

                                <input id="pac-input" class="controls" type="text" placeholder="Search Box">
                                <div id="map"></div>


                                <button class="btn btn-primary pull-right"> Request</button>
                            </form><!-- /.contact-form -->
                        </div><!-- /.contact-form-wrapper -->
                    </div><!-- /.content -->
                </div><!-- /.container -->
            </div><!-- /.main-inner -->
        </div><!-- /.main -->
    </div><!-- /.page-wrapper -->
    @endsection
    @push('js')
        <script src="/public/js/client/requests/materialize.js"></script>
        <script src="/public/js/client/requests/drop-zone.js"></script>
        <script src="/public/js/client/requests/file-uploader.js"></script>

        <script src="/public/js/client/requests/bootstrap-datetimepicker.js" type="text/javascript"></script>
        <script type="text/javascript">
            $('.form_date').datetimepicker({
                language: 'en',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0
            });
        </script>

        <script>
            // This example adds a search box to a map, using the Google Place Autocomplete
            // feature. People can enter geographical searches. The search box will return a
            // pick list containing a mix of places and predicted search terms.

            // This example requires the Places library. Include the libraries=places
            // parameter when you first load the API. For example:
            // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

            function initAutocomplete() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: -33.8688, lng: 151.2195},
                    zoom: 13,
                    mapTypeId: 'roadmap'
                });

                // Create the search box and link it to the UI element.
                var input = document.getElementById('pac-input');
                var searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                // Bias the SearchBox results towards current map's viewport.
                map.addListener('bounds_changed', function() {
                    searchBox.setBounds(map.getBounds());
                });

                var markers = [];
                // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.
                searchBox.addListener('places_changed', function() {
                    var places = searchBox.getPlaces();

                    if (places.length == 0) {
                        return;
                    }

                    // Clear out the old markers.
                    markers.forEach(function(marker) {
                        marker.setMap(null);
                    });
                    markers = [];

                    // For each place, get the icon, name and location.
                    var bounds = new google.maps.LatLngBounds();
                    places.forEach(function(place) {
                        if (!place.geometry) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        var icon = {
                            url: place.icon,
                            size: new google.maps.Size(71, 71),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(17, 34),
                            scaledSize: new google.maps.Size(25, 25)
                        };

                        // Create a marker for each place.
                        markers.push(new google.maps.Marker({
                            map: map,
                            icon: icon,
                            title: place.name,
                            position: place.geometry.location
                        }));

                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                    });
                    map.fitBounds(bounds);
                });
            }

        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCz2sr8lqv78g7jcTN8Kjk2i-p1MO5H560&libraries=places&callback=initAutocomplete"
                async defer></script>
    @endpush

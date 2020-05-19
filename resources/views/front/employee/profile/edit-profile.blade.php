@extends('front.employee.profile.my-profile')
@push('css')
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 550px;
        }
        /* Optional: Makes the sample page fill the window. */
        #description {
            font-family: Roboto, serif;
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
            font-family: Roboto, serif;
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
            font-family: Roboto, serif;
            font-size: 13px;
            font-weight: 300;
        }

        #pac-input {
            background-color: #fff;
            font-family: Roboto, serif;
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
@section('profile-content')
    <div class="page-title">
        <h1>Edit Profile</h1>
    </div><!-- /.page-title -->

    <div class="background-white p20 mb30">
        <h3 class="page-title">
            Contact Information

            <a href="#" class="btn btn-primary btn-xs pull-right">Save</a>
        </h3>

        <div class="row">
            <div class="form-group col-sm-6">
                <label>Name</label>
                <input type="text" class="form-control" value="John">
            </div><!-- /.form-group -->

            <div class="form-group col-sm-6">
                <label>Surname</label>
                <input type="text" class="form-control" value="Doe">
            </div><!-- /.form-group -->

            <div class="form-group col-sm-6">
                <label>E-mail</label>
                <input type="text" class="form-control" value="sample@example.com">
            </div><!-- /.form-group -->

            <div class="form-group col-sm-6">
                <label>Phone</label>
                <input type="text" class="form-control" value="123-456-789">
            </div><!-- /.form-group -->
        </div><!-- /.row -->
    </div>

    <div class="background-white p20 mb30">
        <h3 class="page-title">
            Social Connections

            <a href="#" class="btn btn-primary btn-xs pull-right">Save</a>
        </h3>

        <div class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">Facebook</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" value="http://facebook.com/">
                </div><!-- /.col-* -->
            </div><!-- /.form-group -->

            <div class="form-group">
                <label class="col-sm-2 control-label">Twitter</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" value="http://twitter.com/">
                </div><!-- /.col-* -->
            </div><!-- /.form-group -->





            <div class="form-group">
                <label class="col-sm-2 control-label">Instagram</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" value="http://instagram.com/">
                </div><!-- /.col-* -->
            </div><!-- /.form-group -->
        </div><!-- /.form-inline -->
    </div><!-- /.background-white -->

    <div class="background-white p20 mb30">
        <h3 class="page-title">
            Address

            <a href="#" class="btn btn-primary btn-xs pull-right">Save</a>
        </h3>
        <div class="map-position">
            <input id="pac-input" name="map-input" class="controls" type="text" placeholder="Search Box">
            <input type="hidden" name="lat" id="lat">
            <input type="hidden" name="lng" id="lng">
            <div id="map"></div>
        </div><!-- /.map-property -->
        <div class="row">
            <div class="form-group col-sm-6">
                <label>State</label>
                <input type="text" class="form-control" value="New York">
            </div><!-- /.form-group -->

            <div class="form-group col-sm-6">
                <label>City</label>
                <input type="text" class="form-control" value="New York City">
            </div><!-- /.form-group -->

            <div class="form-group col-sm-6">
                <label>Street</label>
                <input type="text" class="form-control" value="Everton Eve">
            </div><!-- /.form-group -->

            <div class="form-group col-sm-3">
                <label>House Number</label>
                <input type="text" class="form-control" value="123">
            </div><!-- /.form-group -->

            <div class="form-group col-sm-3">
                <label>ZIP</label>
                <input type="text" class="form-control" value="12345">
            </div><!-- /.form-group -->
        </div><!-- /.row -->
    </div>

    <div class="background-white p20 mb30">
        <h3 class="page-title">
            Biography

            <a href="#" class="btn btn-primary btn-xs pull-right">Save</a>
        </h3>

        <textarea class="form-control" rows="7"></textarea><div class="textarea-resize"></div>
    </div>
@endsection
@push('js')
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
            map.addListener('bounds_changed', function () {
                searchBox.setBounds(map.getBounds());
            });

            var markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function () {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }


                // Clear out the old markers.
                markers.forEach(function (marker) {
                    marker.setMap(null);
                });
                markers = [];

                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function (place) {
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
                    $('#lat').val(place.geometry.location.lat())
                    $('#lng').val(place.geometry.location.lng())
                });
                map.fitBounds(bounds);
            });
        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApA0BZrqcfRauI8W5RLAQYjNJla_AS3gA&libraries=places&callback=initAutocomplete"
        async defer></script>
@endpush

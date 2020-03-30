@extends('front.client.profile.my-profile')
@section('profile-content')
    <div class="page-title">
        <h1>Edit Profile</h1>
    </div><!-- /.page-title -->
    <div class="background-white p20 mb30">
        <h4 class="page-title">
            Contact Information
            <a href="#" class="btn btn-primary btn-xs pull-right">Save</a>
        </h4>
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
        <h4 class="page-title">
            Address
            <a href="#" class="btn btn-primary btn-xs pull-right">Save</a>
        </h4>

        <div class="map-position">
            <input id="pac-input" class="controls" type="text" placeholder="Search Box">
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
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <select name="contract">
                    <option>Contract</option>
                    <option>Rent</option>
                    <option>Sale</option>
                </select>
            </div><!-- /.form-group -->
        </div><!-- /.col-* -->
    </div><!-- /.row -->
    </div>

    <div class="background-white p20 mb30">
        <h4 class="page-title">
            Biography
            <a href="#" class="btn btn-primary btn-xs pull-right">Save</a>
        </h4>
        <textarea class="form-control" rows="7"></textarea>
        <div class="textarea-resize"></div>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApA0BZrqcfRauI8W5RLAQYjNJla_AS3gA&libraries=places&callback=initAutocomplete"
            async defer></script>
    <script src="/public/js/client/dropdown.js" type="text/javascript"></script>
    <script src="/public/js/client/collapse.js" type="text/javascript"></script>
    <script src="/public/js/client/jquery.colorbox-min.js" type="text/javascript"></script>
    <script src="/public/js/client/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="/public/js/client/superlist.js" type="text/javascript"></script>
@endpush

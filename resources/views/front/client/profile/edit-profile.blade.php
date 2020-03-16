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
    </div><!-- /.box -->


    <div class="background-white p20 mb30">
        <h4 class="page-title">
            Address
            <a href="#" class="btn btn-primary btn-xs pull-right">Save</a>
        </h4>
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
        <h4 class="page-title">
            Biography
            <a href="#" class="btn btn-primary btn-xs pull-right">Save</a>
        </h4>
        <textarea class="form-control" rows="7"></textarea>
        <div class="textarea-resize"></div>
    </div>
@endsection
@push('js')
    <script src="/public/js/client/dropdown.js" type="text/javascript"></script>
    <script src="/public/js/client/collapse.js" type="text/javascript"></script>
    <script src="/public/js/client/jquery.colorbox-min.js" type="text/javascript"></script>
    <script src="/public/js/client/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="/public/js/client/superlist.js" type="text/javascript"></script>
@endpush

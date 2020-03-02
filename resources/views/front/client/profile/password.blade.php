@extends('front.client.profile.my-profile')
@section('profile-content')
    <div class="page-title">
        <h1> Security </h1>
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
@endsection

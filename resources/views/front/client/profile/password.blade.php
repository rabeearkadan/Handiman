@extends('front.client.profile.my-profile')
@section('profile-content')
    <div class="page-title">
        <h1> Security </h1>
    </div><!-- /.page-title -->
    <div class="background-white p20 mb30">
        <h3 class="page-title">
            Change Password
        </h3><!-- /.page-title -->
        <div class="row">
            <form method="post" action="?">
                <div class="form-group col-sm-6">
                    <label for="login-form-password">Password</label>
                    <input type="password" class="form-control" name="password" id="login-form-password">
                </div><!-- /.form-group -->

                <div class="form-group col-sm-6">
                    <label for="login-form-password-retype">Retype password</label>
                    <input type="password" class="form-control" name="password" id="login-form-password-retype">
                </div><!-- /.form-group -->
                <div class="center">
                    <button type="submit" class="btn btn-primary pull-right">Change</button>
                </div>
            </form>

        </div>
    </div>
@endsection


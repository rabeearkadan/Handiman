@extends('front.client.profile.my-profile')
@section('profile-content')
    <h3 class="page-title">
        Change Password
    </h3><!-- /.page-title -->
    <div class="background-white p20 mb30">
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

                <button type="submit" class="btn btn-primary pull-right">Change</button>
            </form>

        </div>
    </div>

@endsection


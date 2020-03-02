@extends('front.client.profile.my-profile')
@section('profile-content')
                <div class="page-title">
                    <h1>Change Password</h1>
                </div><!-- /.page-title -->
                <form method="post" action="?">
                    <div class="form-group">
                        <label for="login-form-password">Password</label>
                        <input type="password" class="form-control" name="password" id="login-form-password">
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label for="login-form-password-retype">Retype password</label>
                        <input type="password" class="form-control" name="password" id="login-form-password-retype">
                    </div><!-- /.form-group -->

                    <button type="submit" class="btn btn-primary pull-right">Change</button>
                </form>

@endsection


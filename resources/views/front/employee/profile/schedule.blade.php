@extends('front.employee.profile.my-profile')
@push('css')

@endpush
@section('profile-content')
    <div class="page-title">
        <h1>Schedule</h1>
    </div><!-- /.page-title -->

    <div class="background-white p20 mb30">
        <h3 class="page-title">
            Social Connections
            <a href="#" class="btn btn-primary btn-xs pull-right">Save</a>
        </h3>
        <div class="form-horizontal">
            <div class="form-group">
                <label for="facebook" class="col-sm-2 control-label">Facebook</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="facebook" id="facebook" value="@if($user->facebook){{$user->facebook}}@else http://facebook.com/@endif">
                </div><!-- /.col-* -->
            </div><!-- /.form-group -->

            <div class="form-group">
                <label for="twitter" class="col-sm-2 control-label">Twitter</label>
                <div class="col-sm-9">
                    <input type="text" id="twitter" name="twitter" class="form-control" value="@if($user->twitter){{$user->twitter}}@else http://twitter.com/@endif">
                </div><!-- /.col-* -->
            </div><!-- /.form-group -->
            <div class="form-group">
                <label for="instagram" class="col-sm-2 control-label">Instagram</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="instagram" id="instagram" value="@if($user->instagram){{$user->instagram}}@else http://instagram.com/@endif">
                </div><!-- /.col-* -->
            </div><!-- /.form-group -->
        </div><!-- /.form-inline -->
    </div><!-- /.background-white -->

@endsection
@push('js')

@endpush

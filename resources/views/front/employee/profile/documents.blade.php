@extends('front.employee.profile.my-profile')
@push('css')
@endpush
@section('profile-content')
    <div class="page-title">
        <h1>Documents</h1>
    </div><!-- /.page-title -->

    <div class="background-white p20 mb30">
        <h3 class="page-title">
            Resumé
            <a href="#" class="btn btn-primary btn-xs pull-right">Save</a>
        </h3>

        <div class="row">
            <div class="form-group col-sm-6">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{$user->name}}">
            </div><!-- /.form-group -->

            <div class="form-group col-sm-6">
                <label>Surname</label>
                <input type="text" name="surname" class="form-control" value="{{$user->surname}}">
            </div><!-- /.form-group -->

            <div class="form-group col-sm-6">
                <label>E-mail</label>
                <input type="text" name="email" class="form-control" value="{{$user->email}}">
            </div><!-- /.form-group -->

            <div class="form-group col-sm-6">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="{{$user->phone}}">
            </div><!-- /.form-group -->
        </div><!-- /.row -->
    </div>

@endsection
@push('js')

@endpush

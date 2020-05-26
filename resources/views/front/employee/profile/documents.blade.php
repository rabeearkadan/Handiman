@extends('front.employee.profile.my-profile')
@push('css')
@endpush
@section('profile-content')
    <div class="page-title">
        <h1>Documents</h1>
    </div><!-- /.page-title -->
    <div class="background-white p20 mb30">
        <form method="post" action="{{route('employee.cv.update')}}" enctype="multipart/form-data">
            @csrf
            @method('put')
        <h3 class="page-title">
            Resumé 
            <input type="submit" value="Save" class="btn btn-primary btn-xs pull-right"/>
        </h3>
            <div class="row">
                <div class="col-sm-12">
                    <p> This document can only be viewed by the website administrators.
                    Uploading one is mandatory to get approved.
                    </p>
                </div>
            </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="file-field input-field">
                    <div class="btn" style="position: static">
                        <span>Select a pdf File</span>
                        <input type="file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" name="cv" type="text" accept="application/pdf">
                    </div>
                </div>
            </div>
        </div><!-- /.row -->
        </form>
    </div>
    <div class="background-white p20 mb30">
        <form method="post" action="{{route('employee.cr.update')}}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <h3 class="page-title">
                Criminal Record
                <input type="submit" value="Save" class="btn btn-primary btn-xs pull-right"/>
            </h3>
            <div class="row">
                <div class="col-sm-12">
                    <p> This document can only be viewed by the website administrators.
                        Uploading one is mandatory to get approved.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="file-field input-field">
                        <div class="btn" style="position: static">
                            <span>Select a pdf File</span>
                            <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" name="cv" type="text" accept="application/pdf">
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </form>
    </div>
@endsection
@push('js')

@endpush

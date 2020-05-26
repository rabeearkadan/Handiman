@extends('front.employee.profile.my-profile')
@push('css')
@endpush
@section('profile-content')
    <div class="page-title">
        <h1>Documents</h1>
    </div><!-- /.page-title -->

    <div class="background-white p20 mb30">
        <form method="post" action="#" enctype="multipart/form-data">
        <h3 class="page-title">
            Resumé
            <a href="#" class="btn btn-primary btn-xs pull-right">Save</a>
        </h3>

        <div class="row">
            <div class="col-sm-12">
                <div class="file-field input-field">
                    <div class="btn" style="position: static">
                        <span>File</span>
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

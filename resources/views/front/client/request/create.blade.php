@extends('layouts.client.app')
@push('css')
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/buttons.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/common-classes.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/requests/materialize.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/requests/file-uploader.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/color-box.css')}}" rel="stylesheet">
@endpush
@section('content')
    <body>
    <div class="page-wrapper">
        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <div class="content">
                        <h3> The more you elaborate, the more we can help!</h3>
                        <div class="contact-form-wrapper clearfix background-white p30">
                            <form class="contact-form" method="post" action="">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="contact-form-name">Name</label>
                                            <input type="text" name="name" id="contact-form-name" class="form-control">
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="contact-form-subject">Subject</label>
                                            <input type="text" name="subject" id="contact-form-subject" class="form-control">
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="contact-form-email">E-mail</label>
                                            <input type="text" name="email" id="contact-form-email" class="form-control">
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->
                                </div><!-- /.row -->


                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- Uploader Dropzone -->
                                        <div id="zdrop" class="fileuploader ">
                                            <div id="upload-label" style="width: 200px;">
                                                <i class="material-icons">cloud_upload</i>
                                                <span class="title">Drag your Files here</span>
                                                <span>Some description here <span/>
                                            </div>
                                        </div>
                                        <!-- Preview collection of uploaded documents -->
                                        <div class="preview-container">
                                            <div class="header">
                                                <span>Uploaded Files</span>
                                                <i id="controller" class="material-icons">keyboard_arrow_down</i>
                                            </div>
                                            <div class="collection card" id="previews">
                                                <div class="collection-item clearhack valign-wrapper item-template" id="zdrop-template">
                                                    <div class="left pv zdrop-info" data-dz-thumbnail>
                                                        <div>
                                                            <span data-dz-name></span> <span data-dz-size></span>
                                                        </div>
                                                        <div class="progress">
                                                            <div class="determinate" style="width:0" data-dz-uploadprogress></div>
                                                        </div>
                                                        <div class="dz-error-message"><span data-dz-errormessage></span></div>
                                                    </div>

                                                    <div class="secondary-content actions">
                                                        <a href="#" data-dz-remove class="btn-floating ph red white-text waves-effect waves-light"><i class="material-icons white-text">clear</i></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.row -->
                                <div class="form-group">
                                    <label for="contact-form-message"> Problem Description</label>
                                    <textarea class="form-control" id="contact-form-message" rows="6"></textarea>
                                </div><!-- /.form-group -->
                                <button class="btn btn-primary pull-right"> Request </button>
                            </form><!-- /.contact-form -->
                        </div><!-- /.contact-form-wrapper -->
                    </div><!-- /.content -->
                </div><!-- /.container -->
            </div><!-- /.main-inner -->
        </div><!-- /.main -->
    </div><!-- /.page-wrapper -->
@endsection
@push('js')
    <script src="/public/js/client/requests/materialize.js"></script>
    <script src="/public/js/client/requests/drop-zone.js"></script>
    <script src="/public/js/client/requests/file-uploader.js"></script>
@endpush

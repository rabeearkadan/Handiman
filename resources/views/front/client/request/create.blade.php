@extends('layouts.client.app')
@push('css')
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/buttons.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/common-classes.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/requests/materialize.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/requests/file-uploader.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/color-box.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/requests/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="screen">

    <style>
        /*! CSS Used from: https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css */
        @media print {
            *, :after, :before {
                color: #000 !important;
                text-shadow: none !important;
                background: 0 0 !important;
                -webkit-box-shadow: none !important;
                box-shadow: none !important;
            }
        }

        .glyphicon {
            position: relative;
            top: 1px;
            display: inline-block;
            font-family: "Glyphicons Halflings";
            font-style: normal;
            font-weight: 400;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .glyphicon-remove:before {
            content: "\e014";
        }

        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        :after, :before {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .input-group-addon {
            display: table-cell;
        }

        .input-group-addon:not(:first-child):not(:last-child) {
            border-radius: 0;
        }

        .input-group-addon {
            width: 1%;
            white-space: nowrap;
            vertical-align: middle;
        }

        .input-group-addon {
            padding: 13px 32px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1;
            color: #555;
            text-align: center;
            background-color: #eee;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /*! CSS Used fontfaces */
        @font-face {
            font-family: "Glyphicons Halflings";
            src: url(https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/fonts/glyphicons-halflings-regular.eot);
            src: url(https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/fonts/glyphicons-halflings-regular.eot#iefix) format("embedded-opentype"), url(https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/fonts/glyphicons-halflings-regular.woff2) format("woff2"), url(https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/fonts/glyphicons-halflings-regular.woff) format("woff"), url(https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/fonts/glyphicons-halflings-regular.ttf) format("truetype"), url(https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/fonts/glyphicons-halflings-regular.svg#glyphicons_halflingsregular) format("svg");
        }

        /*! CSS Used from: https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css */
        @media print {
            *, :after, :before {
                color: #000 !important;
                text-shadow: none !important;
                background: 0 0 !important;
                -webkit-box-shadow: none !important;
                box-shadow: none !important;
            }
        }

        .glyphicon {
            position: relative;
            top: 1px;
            display: inline-block;
            font-family: "Glyphicons Halflings";
            font-style: normal;
            font-weight: 400;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .glyphicon-calendar:before {
            content: "\e109";
        }

        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        :after, :before {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        /*! CSS Used fontfaces */
        @font-face {
            font-family: "Glyphicons Halflings";
            src: url(https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/fonts/glyphicons-halflings-regular.eot);
            src: url(https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/fonts/glyphicons-halflings-regular.eot#iefix) format("embedded-opentype"), url(https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/fonts/glyphicons-halflings-regular.woff2) format("woff2"), url(https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/fonts/glyphicons-halflings-regular.woff) format("woff"), url(https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/fonts/glyphicons-halflings-regular.ttf) format("truetype"), url(https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/fonts/glyphicons-halflings-regular.svg#glyphicons_halflingsregular) format("svg");
        }

        .main-inner {
            padding: 0;
        }

        .pull-right {
            float: right;
        }
    </style>
@endpush
@section('content')
    <body>
    <div class="page-wrapper">
        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <div class="content">
                        @if($employee)
                            <div class="contact-form-wrapper clearfix background-white p30">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <img src="{{config('image.path').$employee->image}}" class="img-thumbnail"
                                             alt="employee">
                                        <h2>
                                            {{$employee->name}}
                                        </h2>
                                    </div>
                                    <div class="col-sm-10">
                                        <h3>will put employee info later here</h3>
                                    </div>
                                </div>
                            </div>
                        @endif
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
                                            <input type="text" name="subject" id="contact-form-subject"
                                                   class="form-control">
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="contact-form-email">E-mail</label>
                                            <input type="text" name="email" id="contact-form-email"
                                                   class="form-control">
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
                                                <span> Images help asses your problem </span>
                                            </div>
                                        </div>
                                        <!-- Preview collection of uploaded documents -->
                                        <div class="preview-container">
                                            <div class="header">
                                                <span>Uploaded Files</span>
                                                <i id="controller" class="material-icons">keyboard_arrow_down</i>
                                            </div>
                                            <div class="collection card" id="previews">
                                                <div class="collection-item clearhack valign-wrapper item-template"
                                                     id="zdrop-template">
                                                    <div class="left pv zdrop-info" data-dz-thumbnail>
                                                        <div>
                                                            <span data-dz-name></span> <span data-dz-size></span>
                                                        </div>
                                                        <div class="progress">
                                                            <div class="determinate" style="width:0"
                                                                 data-dz-uploadprogress></div>
                                                        </div>
                                                        <div class="dz-error-message"><span data-dz-errormessage></span>
                                                        </div>
                                                    </div>

                                                    <div class="secondary-content actions">
                                                        <a href="#" data-dz-remove
                                                           class="btn-floating ph red white-text waves-effect waves-light">
                                                            <i class="material-icons white-text">clear</i>
                                                        </a>
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
                                <div class="form-group">
                                    <label for="contact-form-message"> Pick time </label>
                                    <div class="form-group">
                                        <label for="dtp_input2" class="col-md-2 control-label">Date Picking</label>
                                        <div class="input-group date form_date col-md-5" data-date=""
                                             data-date-format="dd MM yyyy" data-link-field="dtp_input2"
                                             data-link-format="yyyy-mm-dd">
                                            <input class="form-control" size="16" type="text" value="" readonly>
                                            <span class="input-group-addon"><span
                                                    class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><span
                                                    class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <input type="hidden" id="dtp_input2" value=""/><br/>
                                    </div>
                                </div><!-- /.form-group -->

                                <button class="btn btn-primary pull-right"> Request</button>
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

        <script src="/public/js/client/requests/bootstrap-datetimepicker.js" type="text/javascript"></script>
        <script type="text/javascript">
            $('.form_date').datetimepicker({
                language: 'en',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0
            });
        </script>
    @endpush

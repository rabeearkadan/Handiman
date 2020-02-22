@extends('cms.layouts.app')

@section('content')
    @push('js_links')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.1.0/knockout-min.js">
        <link href="https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.js">

    @endpush
    @push('style_links')
        <link rel="stylesheet"
              href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet"
              href="https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.css">
    @endpush
    <div class="page-title-heading">
        <div class="page-title-icon">
            <i class="pe-7s-graph text-success">
            </i>
        </div>
        <div>
            <div class="page-title-subheading">Add new service
            </div>
        </div>
    </div>


    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title">Service</h5>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="position-relative form-group"><label for="exampleEmail11"
                                                                                 class="">Service Name</label><input
                                        name="service_name" placeholder="Example.." type="text"
                                        class="form-control">
                                </div>
                            </div>

                        </div>


                        <div class="container">
                            <h1>
                                <a target="_blank" href="https://github.com/safrazik/knockout-file-bindings">knockout-file-bindings</a>
                            </h1>
                            <div class="well" data-bind="fileDrag: fileData">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <img style="height: 125px;" class="img-rounded  thumb"
                                             data-bind="attr: { src: fileData().dataURL }, visible: fileData().dataURL">
                                        <div data-bind="ifnot: fileData().dataURL">
                                            <label class="drag-label">Drag file here</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="file" data-bind="fileInput: fileData, customFileInput: {
              buttonClass: 'btn btn-success',
              fileNameClass: 'disabled form-control',
              onClear: onClear,
            }" accept="image/*">
                                    </div>
                                </div>
                            </div>

                            <h3>Multiple File Uploads</h3>
                            <div class="well" data-bind="fileDrag: multiFileData">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <!-- ko foreach: {data: multiFileData().dataURLArray, as: 'dataURL'} -->
                                        <img style="height: 100px; margin: 5px;" class="img-rounded  thumb"
                                             data-bind="attr: { src: dataURL }, visible: dataURL">
                                        <!-- /ko -->
                                        <div data-bind="ifnot: fileData().dataURL">
                                            <label class="drag-label">Drag files here</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="file" multiple data-bind="fileInput: multiFileData, customFileInput: {
              buttonClass: 'btn btn-success',
              fileNameClass: 'disabled form-control',
              onClear: onClear,
            }" accept="image/*">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-default" data-bind="click: debug">Debug</button>
                        </div>

                        {{--<div  class="container">--}}
                        {{--                        <div class="well" data-bind="fileDrag: fileData">--}}
                        {{--                            <div class="form-group row">--}}
                        {{--                                <div class="col-md-6">--}}
                        {{--                                    <img style="height: 125px;" class="img-rounded  thumb"--}}
                        {{--                                         data-bind="attr: { src: fileData().dataURL }, visible: fileData().dataURL">--}}
                        {{--                                    <div data-bind="ifnot: fileData().dataURL">--}}
                        {{--                                        <label class="drag-label">Drag file here</label>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="col-md-6">--}}
                        {{--                                    <input type="file" data-bind="fileInput: fileData, customFileInput: {--}}
                        {{--              buttonClass: 'btn btn-success',--}}
                        {{--              fileNameClass: 'disabled form-control',--}}
                        {{--              onClear: onClear,--}}
                        {{--            }"--}}
                        {{--                                           accept="image/*">--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--</div>--}}

                        <button class="mt-2 btn btn-primary">Save Changes</button>
                        <button class="btn-danger">Discard</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>

            $(function () {
                var viewModel = {};
                viewModel.fileData = ko.observable({
                    dataURL: ko.observable(),
                    // base64String: ko.observable(),
                });
                viewModel.multiFileData = ko.observable({
                    dataURLArray: ko.observableArray(),
                });
                viewModel.onClear = function (fileData) {
                    if (confirm('Are you sure?')) {
                        fileData.clear && fileData.clear();
                    }
                };
                viewModel.debug = function () {
                    window.viewModel = viewModel;
                    console.log(ko.toJSON(viewModel));
                    debugger;
                };
                ko.applyBindings(viewModel);
            });
        </script>
    @endpush


@endsection

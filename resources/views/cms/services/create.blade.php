@extends('cms.layouts.app')

@section('content')
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

    {{--    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">--}}
    {{--        <li class="nav-item">--}}
    {{--            <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">--}}
    {{--                <span>Layout</span>--}}
    {{--            </a>--}}
    {{--        </li>--}}
    {{--        <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">--}}
    {{--            <span>Grid</span>--}}
    {{--        </a>--}}
    {{--        </li>--}}
    {{--    </ul>--}}
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title">Service</h5>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="position-relative form-group"><label for="exampleEmail11"
                                                                                 class="">Service Name</label><input
                                        name="service_name"  placeholder="Example.." type="text"
                                        class="form-control"></div>
                            </div>

                        </div>



{{--                        <div class="position-relative form-check">--}}
{{--                            <input type="file" name="fileToUpload" id="fileToUpload">--}}
{{--                            <label for="exampleCheck" class="form-check-label">Upload service photo</label>--}}
{{--                        </div>--}}

                        <div class="well" data-bind="fileDrag: fileData">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <img style="height: 125px;" class="img-rounded  thumb" data-bind="attr: { src: fileData().dataURL }, visible: fileData().dataURL">
                                    <div data-bind="if not: fileData().dataURL">
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


                        <button class="mt-2 btn btn-primary">Save Changes</button>
                        <button class="btn-danger">Discard</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@push('js')
    <script>

        $(function(){
            var viewModel = {};
            viewModel.fileData = ko.observable({
                dataURL: ko.observable(),
                // base64String: ko.observable(),
            });
            viewModel.multiFileData = ko.observable({
                dataURLArray: ko.observableArray(),
            });
            viewModel.onClear = function(fileData){
                if(confirm('Are you sure?')){
                    fileData.clear && fileData.clear();
                }
            };
            viewModel.debug = function(){
                window.viewModel = viewModel;
                console.log(ko.toJSON(viewModel));
                debugger;
            };
            ko.applyBindings(viewModel);
        });
    </script>
    @endpush


@endsection

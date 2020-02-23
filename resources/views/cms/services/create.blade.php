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


    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="text-center">
                <div class="card-body"><h5 class="card-title">Service</h5>

                    <form action="{{route('service.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <div class="col-md-6">
                                <div class="position-relative form-group"><label for="exampleEmail11"
                                                                                 class="">Service Name</label><input
                                        name="service_name" placeholder="Example.." type="text"
                                        class="form-control">
                                </div>
                            </div>

                        </div>


                        <div class="container" >
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
                                        <input  name="service_picture"  type="file" data-bind="fileInput: fileData, customFileInput: {
                                      buttonClass: 'btn btn-success',
                                      fileNameClass: 'disabled form-control',
                                      onClear: onClear,
                                    }"
                                               accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="mt-2 btn btn-primary">Submit Service</button>

                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>


@endsection



@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.1.0/knockout-min.js"></script>
    <script type="text/javascript"  src="{{asset('js/file-uploader.js')}}"></script>

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

@push('css')
    <link rel="stylesheet"
          src="{{asset('css/file-uploader.css')}}">
    <link rel="stylesheet" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
@endpush

@extends('cms.layouts.app')

@section('content')
@push('css')

    <link rel="stylesheet" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    @endpush
@push('js')
    <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

@endpush

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title">Service Table</h5>

                    <button class="mb-2 mr-2 btn btn-primary" onclick="location.href='{{route('service.create')}}'">Add
                        New Service
                    </button>
                    <table class="mb-0 table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th># Users</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($services as $service)
                            <tr id="row-{{$service->id}}">
                                <th scope="row">{{$loop->index +1 }}</th>
                                <td>{{$service->name}}</td>
                                <td>{{$service->users()->count()}}</td>
                                <td>
                                    {{--                                   <a href="{{route('service.edit', $service->id)}}"><i class="pe-7s-pen"> </i></a>--}}
                                    {{--                                   <a href="{{route('service.show', $service->id)}}"><i class="pe-7s-display"> </i></a>--}}
                                    {{--                                   // modal as popup delete to be added--}}
                                    {{--                                   <a  href="javascript:deleteService({{$service->id}})"><i class="pe-7s-trash"> </i></a>--}}

                                    <a href="#my_modal" data-toggle="modal" data-book-id="my_id_value">Open Modal</a>

{{--                                    <button   type="button" class="btn mr-2 mb-2 btn-danger" data-toggle="modal"--}}
{{--                                            data-target="#exampleModal">--}}
{{--                                        Delete--}}
{{--                                    </button>--}}


                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Are you sure you want to delete this service?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button     type="button"  class="btn btn-danger">Delete and Save Changes</button>
            </div>
        </div>
    </div>
</div>



<div class="modal" id="my_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Modal header</h4>
            </div>
            <div class="modal-body">
                <p>some content</p>
                <input type="text" name="bookId" value=""/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>

    $('#my_modal').on('show.bs.modal', function(e) {
        var bookId = $(e.relatedTarget).data('book-id');
        $(e.currentTarget).find('input[name="bookId"]').val(bookId);
    });
</script>

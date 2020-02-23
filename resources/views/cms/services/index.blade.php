@extends('cms.layouts.app')

@section('content')

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

                                    <a data-toggle="modal" data-id="ISBN564541" title="Add this item" class="open-AddBookDialog btn btn-primary" href="#addBookDialog">test</a>


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




<div class="modal hide" id="addBookDialog">
    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Modal header</h3>
    </div>
    <div class="modal-body">
        <p>some content</p>
        <input type="text" name="bookId" id="bookId" value=""/>
    </div>
</div>

<script>

    $(document).on("click", ".open-AddBookDialog", function () {

        var myBookId = $(this).data('id');

        alert(myBookId);
        $(".modal-body #bookId").val( myBookId );
        // As pointed out in comments,
        // it is unnecessary to have to manually call the modal.
        // $('#addBookDialog').modal('show');
    });
</script>

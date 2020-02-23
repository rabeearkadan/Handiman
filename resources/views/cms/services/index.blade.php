@extends('cms.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title">Service Table</h5>

                    <button class="mb-2 mr-2 btn btn-primary" onclick="location.href='{{route('service.create')}}'">Add New Service</button>
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
                           <tr id="row-{{$service->id}}" >
                               <th scope="row">{{$loop->index +1 }}</th>
                               <td>{{$service->name}}</td>
                               <td>{{$service->users()->count()}}</td>
                           <td>
{{--                                   <a href="{{route('service.edit', $service->id)}}"><i class="pe-7s-pen"> </i></a>--}}
{{--                                   <a href="{{route('service.show', $service->id)}}"><i class="pe-7s-display"> </i></a>--}}
{{--                                   // modal as popup delete to be added--}}
{{--                                   <a  href="javascript:deleteService({{$service->id}})"><i class="pe-7s-trash"> </i></a>--}}
                               <button type="button" class="btn mr-2 mb-2 btn-danger" data-toggle="modal" data-target="#exampleModal">
                                  Delete
                               </button>
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
@push('js')

    <script type="text/javascript">
        function deleteService(id) {
            alert('successfully deleted service id: ' + id);
            $.ajax({
                url: '/CMS/ServiceController/destroy?id=' + id,
                type: 'delete',
                success: function (res) {
                    if (res) {
                        alert('successfully deleted service id: ' + id);
                        $('#row-' + id).remove();
                    } else {
                        alert('failed');
                    }
                },
                error: function () {
                    alert('failed');
                    console.error("something went wrong");
                }
            });
        }
    </script>
    @endpush
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

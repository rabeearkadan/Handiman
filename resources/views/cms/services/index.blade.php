@extends('cms.layouts.app')

@section('content')
{{-- meet mara fahmatak l push barat l section--}}

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
                                    <button class="btn btn-danger waves-effect" type="button" onclick="deletePost({{ $service->id }})">
                                        <i class="material-icons">delete</i>
                                    </button>
                                    <form id="delete-form-{{ $service->id }}" action="{{ route('service.destroy',$service->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

{{--                                    <button href="#exampleModal" type="button"   data-service-id="{{$service->id}}" try--}}
{{--                                            class="btn mr-2 mb-2 btn-danger" data-toggle="modal"--}}
{{--                                    > Delete--}}
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

{{--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"--}}
{{--     aria-hidden="true">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="exampleModalLabel">Delete Service</h5>--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">&times;</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                <p class="mb-0">Are you sure you want to delete this service? </p>--}}

{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--                --}}{{--                <button type="button" class="btn btn-secondary"  data-dismiss="modal">Close</button>--}}
{{--                <form class="delete"   action="{{ route('service.index') }}" method="POST">--}}
{{--                    @csrf--}}
{{--                    this serviceID will be holding the serviceID--}}
{{--                </form>--}}


{{--                --}}{{--                <form class="delete" action="{{ route('service.destroy', serviceId) }}" method="delete">--}}


{{--                @csrf--}}

{{--                <button type="button" class="btn btn-danger">Delete and Save Changes</button>--}}
{{--                </form>--}}


{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection


@push('js')

    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deletePost(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush
@push('css')

    <link rel="stylesheet" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
@endpush




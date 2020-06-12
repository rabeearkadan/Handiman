@extends('cms.layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title">Rejected Payments</h5>

                    <table class="mb-0 table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Service</th>
                            <th>Subject</th>
                            <th>
                                Date
                            </th>
                            <th>Actions</th>
                            <th>info</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $request)
                            <tr id="row-{{$request->id}}">
                                <th scope="row">{{$loop->index +1 }}</th>
                                <td> {{ $request->client['name'] }}</td>
                                <td> {{ $request->service['name'] }}</td>
                                <td>{{$request->rejected_payment}}</td>
                                <td>{{$request->date}}</td>
                                <td>
                                    <button class="btn btn-danger waves-effect" type="button"
                                            onclick="deletePost('{{ $request->id }}')">
                                        <i class="material-icons">delete</i>
                                    </button>
                                    <form id="delete-form-{{ $request->id }}"
                                          action="{{ route('request.destroy', $request->id) }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                </td>
                                <td>
                                    <button class="mb-2 mr-2 btn btn-info"
                                            onclick="location.href='{{route('request.show',$request->id)}}'"> info..

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
                    document.getElementById('delete-form-' + id).submit();
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




<?php
@extends('cms.layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title">Clients Table</h5>

{{--                    <button class="mb-2 mr-2 btn btn-primary" onclick="location.href='{{route('service.create')}}'">Add--}}
{{--                        New Service--}}
{{--                    </button>--}}
{{--                    <button  class="mb-2 mr-2 btn btn-danger" onclick="location.href='{{route('service.test')}}'"> data tables</button>--}}

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
                        @foreach($clients as $client)
                            <tr id="row-{{$client->id}}">
                                <th scope="row">{{$loop->index +1 }}</th>
                                <td>{{$client->name}}</td>
                                <td>{{$client->email}}</td>
                                <td>
                                    <button class="btn btn-danger waves-effect" type="button" onclick="deletePost('{{ $client->id }}')">
                                        <i class="material-icons">delete</i>
                                    </button>
                                    <form id="delete-form-{{ $client->id }}" action="{{ route('client.destroy',$client->id) }}" method="POST" style="display: none;">
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




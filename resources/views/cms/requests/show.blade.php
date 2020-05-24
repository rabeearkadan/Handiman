@extends('cms.layouts.app')

@section('content')



    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
        <div class="main-card mb-3 card">
            <div class="card-body"><h5 class="card-title">Request Information</h5>
                <form class="">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="exampleEmail11" class="">Client</label>
                                <input value="{{$request->client['name']}}" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="examplePassword11"
                                                                             class="">Employee</label><input
                                    name="employee" id="examplePassword11"
                                    value="{{$request->handyman['name']}} "
                                    class="form-control"></div>
                        </div>
                    </div>
                    <div class="position-relative form-group"><label for="exampleAddress" class="">Subject</label><input
                            name="address" id="exampleAddress" value="{{$request->subject}}" type="text"
                            class="form-control"></div>
                    <div class="position-relative form-group"><label for="exampleAddress2" class="">Description
                            2</label><input name="address2" id="exampleAddress2" value="{{$request->description}}"
                                            type="text" class="form-control">
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleCity"
                                                                             class="">Date</label><input name="city"
                                                                                                         id="exampleCity"
                                                                                                         type="text"
                                                                                                         value="{{$request->date}}"
                                                                                                         class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative form-group"><label for="exampleState"
                                                                             class="">From</label><input name="state"
                                                                                                         id="exampleState"
                                                                                                         value="{{$request->from}}:00"
                                                                                                         type="text"
                                                                                                         class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="position-relative form-group"><label for="exampleZip" class="">To</label><input
                                    value="{{$request->to}}:00" name="zip" id="exampleZip" type="text"
                                    class="form-control"></div>
                        </div>
                    </div>
                    <div class="position-relative form-check"><input name="check" id="exampleCheck" type="checkbox"
                                                                     class="form-check-input"><label for="exampleCheck"
                                                                                                     class="form-check-label">Check
                            me out</label></div>
                    <button class="mt-2 btn btn-primary">Sign in</button>
                </form>
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




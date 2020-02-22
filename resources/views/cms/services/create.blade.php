@extends('cms.layouts.app')

@section('content')
    <div class="page-title-heading">
        <div class="page-title-icon">
            <i class="pe-7s-graph text-success">
            </i>
        </div>
        <div>Form Layouts
            <div class="page-title-subheading">Build whatever layout you need with our Architect framework.
            </div>
        </div>
    </div>

    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
        <li class="nav-item">
            <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                <span>Layout</span>
            </a>
        </li>
        <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
            <span>Grid</span>
        </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title">Grid Rows</h5>
                    <form class="">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="position-relative form-group"><label for="exampleEmail11"
                                                                                 class="">Email</label><input
                                        name="email" id="exampleEmail11" placeholder="with a placeholder" type="email"
                                        class="form-control"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group"><label for="examplePassword11" class="">Password</label><input
                                        name="password" id="examplePassword11" placeholder="password placeholder"
                                        type="password"
                                        class="form-control"></div>
                            </div>
                        </div>
                        <div class="position-relative form-group"><label for="exampleAddress"
                                                                         class="">Address</label><input name="address"
                                                                                                        id="exampleAddress"
                                                                                                        placeholder="1234 Main St"
                                                                                                        type="text"
                                                                                                        class="form-control">
                        </div>
                        <div class="position-relative form-group"><label for="exampleAddress2" class="">Address
                                2</label><input name="address2" id="exampleAddress2"
                                                placeholder="Apartment, studio, or floor" type="text"
                                                class="form-control">
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="position-relative form-group"><label for="exampleCity" class="">City</label><input
                                        name="city" id="exampleCity" type="text" class="form-control"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group"><label for="exampleState"
                                                                                 class="">State</label><input
                                        name="state" id="exampleState" type="text" class="form-control"></div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group"><label for="exampleZip"
                                                                                 class="">Zip</label><input name="zip"
                                                                                                            id="exampleZip"
                                                                                                            type="text"
                                                                                                            class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="position-relative form-check"><input name="check" id="exampleCheck" type="checkbox"
                                                                         class="form-check-input"><label
                                for="exampleCheck" class="form-check-label">Check me out</label></div>
                        <button class="mt-2 btn btn-primary">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

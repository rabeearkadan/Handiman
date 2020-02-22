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

@endsection

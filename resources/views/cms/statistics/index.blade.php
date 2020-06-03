@extends('cms.layouts.app')

@section('content')

    <div class="row">
        {!! $chart->container() !!}
        {!! $chart->script() !!}
    </div>
@endsection
@push('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
@endpush

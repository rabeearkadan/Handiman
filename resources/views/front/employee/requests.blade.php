@extends('layouts.employee.app')
@push('css')
{{--    <link href="{{asset('css/employee/collapsible.css')}}" rel="stylesheet" type="text/css">--}}
@endpush
@section('content')
    <p>Urgent Requests:</p>
<button class="collapsible urgent">A request</button>
<div class="content">
    <p>sample</p>
</div>

<h3>Requests:</h3>
    <div class="row">
    <div class="col-sm-12">
    <div class="card">
        <div class="card-content">
            <p>Subject, description</p>
        </div>
        <div class="card-tabs">
            <ul class="tabs tabs-fixed-width">
                <li class="tab" ><a class="active" href="#test4">Client</a></li>
                <li class="tab"><a  href="#test5">Address</a></li>
                <li class="tab"><a href="#test6">Date</a></li>
                <li class="tab"><a href="#test7">Images</a></li>
            </ul>
        </div>
        <div class="card-content grey lighten-4">
            <div id="test4">Test 1</div>
            <div id="test5">Test 2</div>
            <div id="test6">
                <div class="carousel">
                    <a class="carousel-item" href="#one!"><img src="/public/images/client-home.png"></a>
                    <a class="carousel-item" href="#two!"><img src="/public/images/employee/profile.png"></a>
                    <a class="carousel-item" href="#three!"><img src="/public/images/employee-home.png"></a>
                </div>

            </div>
            <div id="test7">Test 2</div>
        </div>
    </div>
    </div>
    </div>
@endsection
@push('js')
{{--    <script>--}}
{{--        var coll = document.getElementsByClassName("collapsible");--}}
{{--        var i;--}}

{{--        for (i = 0; i < coll.length; i++) {--}}
{{--            coll[i].addEventListener("click", function() {--}}
{{--                this.classList.toggle("active");--}}
{{--                var content = this.nextElementSibling;--}}
{{--                if (content.style.maxHeight){--}}
{{--                    content.style.maxHeight = null;--}}
{{--                } else {--}}
{{--                    content.style.maxHeight = content.scrollHeight + "px";--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}
{{--    </script>--}}

<script>
    var el = document.querySelector('.tabs');
    var instance = M.Tabs.init(el, {});
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.carousel');
        var instances = M.Carousel.init(elems);
    });
</script>
@endpush

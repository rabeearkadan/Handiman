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
                <li class="tab" ><a class="active" href="#client">Client</a></li>
                <li class="tab"><a  href="#address">Address</a></li>
                <li class="tab"><a href="#images">Images</a></li>
            </ul>
        </div>
        <div class="card-content grey lighten-4">
            <div id="client">
                <ul class="collection" style="overflow:scroll">
                    <li class="collection-item avatar">
                            <img src="/public/images/employee-home.png" alt="" class="circle">
                            <span class="title">nnn</span>
                            <p>rating
                                <br> Second Line
                            </p>
                            <a href="#!" class="secondary-content">
                                <i class="material-icons">grade</i>
                            </a>
                    </li>
                    <li class="collection-item avatar">
                        <i class="material-icons circle">folder</i>
                        <span class="title">Service</span>
                        <p>First Line
                            <br> Second Line
                        </p>
                    </li>
                    <li class="collection-item avatar">
                        <i class="material-icons circle green">assessment</i>
                        <span class="title">Date Time</span>
                        <p>Date:
                            <br>
                        </p>
                    </li>
                    <li class="collection-item avatar">
                        <i class="material-icons circle red">play_arrow</i>
                        <span class="title">Address</span>
                        <p>First Line
                            <br> Second Line
                        </p>
                    </li>
                </ul>
            </div>
            <div id="address">address </div>
            <div id="images">
                <div class="slider">
                    <ul class="slides">
                        <li>
                            <img src="/public/images/employee-home.png"> <!-- random image -->

                        </li>
                        <li>
                            <img src="/public/images/employee/profile.png"> <!-- random image -->

                        </li>
                        <li>
                            <img src="/public/images/client/profile-image.png"> <!-- random image -->
                        </li>
                        <li>
                            <img src="/public/images/employee/profile-image.png"> <!-- random image -->
                        </li>
                    </ul>
                </div>
            </div>
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
        var elems = document.querySelectorAll('.slider');
        var instances = M.Slider.init(elems);
    });

</script>
@endpush

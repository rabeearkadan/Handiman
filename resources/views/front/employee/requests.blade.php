@extends('layouts.employee.app')
@push('css')
    <link href="{{asset('css/employee/collapsible')}}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <p>Urgent Requests:</p>
<button class="collapsible urgent">A request</button>
<div class="content">
    <p></p>
</div>

<p>Requests:</p>
<button class="collapsible">Request info</button>
<div class="content">
    <p></p>
</div>
@endsection
@push('js')
    <script>
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.maxHeight){
                    content.style.maxHeight = null;
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
        }
    </script>
@endpush

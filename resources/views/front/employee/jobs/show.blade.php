@extends('layouts.employee.app')
@push('css')

@endpush
@section('content')
    <ul class="collapsible popout">
        <li>
            <div class="collapsible-header">
                <i class="material-icons">details</i>
                Request Details
            </div>
            <div class="collapsible-body">
                <span>Request client.</span>
                <span>Request.subject</span>
                <span>Request.desc</span>
            </div>
        </li>
        <li>
            <div class="collapsible-header">
                <i class="material-icons">home_repair_service</i>
                Service
            </div>
            <div class="collapsible-body">
                <span>Service type</span>

            </div>
        </li>
        <li>
            <div class="collapsible-header">
                <i class="material-icons">event</i>
                Date & Time
            </div>
            <div class="collapsible-body">
                <span>Date</span>
                <span>Time</span>
            </div>
        </li>
        <li>
            <div class="collapsible-header">
                <i class="material-icons">place</i>
                Second
            </div>
            <div class="collapsible-body">
                <span>Lorem ipsum dolor sit amet.</span>
            </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">images</i>
                Images</div>
            <div class="collapsible-body">
{{--                <img class="materialboxed"  width="250" src="{{config('image.path').$image}}">--}}
                </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">payment</i>
                bill</div>
            <div class="collapsible-body">
                <div class="row">
                    <form class="col s12">
                        <div class="row">

                        </div>
                    </form>
                </div>
                <span>Items</span>
                <table class="responsive-table">
                    <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Item Price</th>
                        <th>Quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="input-field col s4">
                                <i class="material-icons prefix">delete</i>
                                <textarea  class="materialize-textarea"></textarea>
                            </div>
                        </td>
                        <td>
                            <div class="input-field col s4">
                                <textarea  class="materialize-textarea"></textarea>
                            </div>
                        </td>
                        <td>
                            <div class="input-field col s4">
                                <textarea  class="materialize-textarea"></textarea>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <span>images.</span>
                <input type="file" name="images[]" id="input-file" accept="image/jpeg, image/png" multiple="multiple">
            </div>
        </li>
    </ul>
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large blue">
            <i class="large material-icons">chat</i>
        </a>

    </div>
@endsection
@push('js')

    <script src="/public/js/materialize.js" type="text/javascript"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.collapsible');
            var instances = M.Collapsible.init(elems);
        });

        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.fixed-action-btn');
            var instances = M.FloatingActionButton.init(elems);
        });
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.materialboxed');
            var instances = M.Materialbox.init(elems);
        });

    </script>
@endpush

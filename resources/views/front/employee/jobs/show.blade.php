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
                <span>Subject.</span>
                <span>{{$job->subject}}</span>
                <br>
                <span>Description</span>
                <span>{{$job->description}}</span>
            </div>
        </li>
        <li>
            <div class="collapsible-header">
                <i class="material-icons">details</i>
                Client Details
            </div>
            <div class="collapsible-body">
                <span>{{$client->name}}</span>
                <br>
                <span>{{$client->phone}}</span>
                <br>
                <span></span>
                <br>
                <span></span>
            </div>
        </li>
        <li>
            <div class="collapsible-header">
                <i class="material-icons">home_repair_service</i>
                Service
            </div>
            <div class="collapsible-body">
                <span>{{$service->name}}</span>

            </div>
        </li>
        <li>
            <div class="collapsible-header">
                <i class="material-icons">event</i>
                Date &amp; Time
            </div>
            <div class="collapsible-body">
                <span>{{$job->date}}  {{$job->from}} -> {{$job->to}}</span>
            </div>
        </li>
        <li>
            <div class="collapsible-header">
                <i class="material-icons">place</i>
                Address
            </div>
            <div class="collapsible-body">
                <h5>Name</h5>
                <h5>state</h5>
                <h5>city</h5>
                <h5>Street: </h5>
                <span>{{$job->client_address['street']}}</span><br>
                <h5>Property Type: </h5>
                <span>{{$job->client_address['property_type']}}</span><br>
                <h5>Building: </h5>
                <span>{{$job->client_address['building']}}</span><br>
                <h5>Floor: </h5>
                <span>{{$job->client_address['floor']}}</span><br>
                <h5>zip: </h5>
                <span>{{$job->client_address['zip']}}</span><br>
            </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">images</i>
                Images</div>
            <div class="collapsible-body">
                @foreach($job->images as $image)
                <img class="materialboxed"  width="350" src="{{config('image.path').$image}}">
                    @endforeach
                </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">payment</i>
                Bill
            </div>
            <div class="collapsible-body">
                @if($job->ispaid == false)
                <form method="post" action="{{route('employee.calendar.add.receipt',$job->id)}}" enctype="multipart/form-data">
                    @csrf
                <span>Items</span>
                    <a href="#" id="addButton" onclick="addItem()">
                        <i style="float: right;width: 30px" class="material-icons">add</i>
                    </a>
                <table>
                    <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Item Price</th>
                        <th>Quantity</th>
                    </tr>
                    </thead>
                    <tbody id="tablebody">
                    <tr id="0">
                        <td>
                            <div class="input-field col s4" id="row0">
                                <textarea name="itemsName[]" placeholder="Item name" class="materialize-textarea"></textarea>
                            </div>
                        </td>
                        <td>
                            <div class="input-field col s4">
                                <textarea name="itemsPrice[]"  placeholder="Item price" class="materialize-textarea"></textarea>
                            </div>
                        </td>
                        <td>
                            <div class="input-field col s4">
                                <textarea name="itemsQuantity[]"  placeholder="Item quantity" class="materialize-textarea"></textarea>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <label for="receiptImages">Receipt Images.</label>
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>Receipt</span>
                            <input type="file" multiple>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" id="receiptImages[]" name="receiptImages" type="text" placeholder="Receipt Images, upload at least one"  accept="image/jpeg, image/png" multiple="multiple">
                        </div>
                    </div>

                    <label for="resultImages">Result Images.</label>
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>Results</span>
                            <input type="file" multiple>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" id="resultImages[]" name="receiptImages" type="text" placeholder="Result Images, upload at least one"  accept="image/jpeg, image/png" multiple="multiple">
                        </div>
                    </div>
                    <button class="btn waves-effect waves-light right" type="submit" name="action" style="line-height: 3.5px;font-size: small;height: 27px;margin-right: 85px;">Submit
                        <i class="material-icons right">send</i>
                    </button>
                </form>
                    @else
                    @endif
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
        var itemsTable = $('#tablebody');
        function addItem() {
            var id = $('table tr:last').attr('id');
            id++;
            itemsTable.append(
               '<tr id="'+id+'">' +
                ' <td>' +
                ' <div class="input-field col s4">' +
                '<textarea name="itemsName[]"  placeholder="Item name" class="materialize-textarea"></textarea>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="input-field col s4">' +
                '<textarea name="itemsPrice[]"  placeholder="Item price" class="materialize-textarea"></textarea>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="input-field col s4">' +
                '<textarea name="itemsQuantity[]"  placeholder="Item quantity" class="materialize-textarea"></textarea>' +
                '<a href="#" onclick="deleteItem('+id+')">' +
                '<i class="material-icons postfix">delete</i>' +
                '</a>' +
                '</div>' +
                '</td>' +
                '</tr>'
            );
        }
        function deleteItem(id) {
            $('#'+id).remove();
        }
    </script>
@endpush

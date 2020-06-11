@extends('layouts.employee.app')
@push('css')
    <style>
        .row {
            display: flex;
        }

        .column {
            flex: 50%;
        }

        .materialboxed {
            width: 450px;
        }

        .btn {
            background-color: #2688a6;
        }

        @media only screen and (max-width: 650px) {
            .materialboxed {
                width: 340px;
            }

            .textarea.materialize-textarea, .btn {
                font-size: 11px;
            }
        }

        @media only screen and (max-width: 450px) {
            .materialboxed {
                width: 200px;
            }
        }
    </style>
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
                <i class="material-icons">perm_identity</i>
                Client Details
            </div>
            <div class="collapsible-body">
                <i class="material-icons">name</i>
                <span>{{$client->name}}</span>
                <br>
                <i class="material-icons">phone</i>
                <span>{{$client->phone}}</span>
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
                <span>
                    <i class="material-icons">date_range</i>
                    {{$job->date->format('d/m/Y')}} </span>
                <br>
                <span>
                    <i class="material-icons">clock</i>
                    {{$job->from}} -> {{$job->to}}</span>
            </div>
        </li>
        <li>
            <div class="collapsible-header">
                <i class="material-icons">place</i>
                Address
            </div>
            <div class="collapsible-body">
                <div class="row">
                    <div class="column">
                        <h6>Name</h6>
                        <h6>state</h6>
                        <h6>city</h6>
                        <h6>Street: </h6>
                        <span>{{$job->client_address['street']}}</span><br>
                    </div>
                    <div class="column">
                        <h6>Property Type: </h6>
                        <span>{{$job->client_address['property_type']}}</span><br>
                        <h6>Building: </h6>
                        <span>{{$job->client_address['building']}}</span><br>
                        <h6>Floor: </h6>
                        {{--                <span>{{$job->client_address['floor']}}</span><br>--}}
                        <h6>zip: </h6>
                        <span>{{$job->client_address['zip']}}</span><br>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">images</i>
                Images
            </div>
            <div class="collapsible-body">
                @foreach($job->images as $image)
                    <img class="materialboxed" src="{{config('image.path').$image}}">
                @endforeach
            </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">payment</i>
                Bill
            </div>
            <div class="collapsible-body">
                @isset($job->receipt)
                    <span>Items</span>
                    <a href="#!" id="addButton" onclick="addItem()">
                        <i style="float: right;width: 30px" class="material-icons">add</i>
                    </a>
                    <table class="striped">
                        <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Item Price</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($job->receipt as $item)
                            <tr>
                                <td>{{$item['name']}}</td>
                                <td>{{$item['price']}}</td>
                                <td>{{$item['qty']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <span>Total: {{$job->total}}</span>
                    @if($job->ispaid == true)
                        <span>Paid</span>
                    @else
                        <span>not paid</span>
                    @endif

                @else
                    <form method="post" action="{{route('employee.calendar.add.receipt',$job->id)}}"
                          enctype="multipart/form-data">
                        @csrf
                        <span>Items</span>
                        <a href="#!" id="addButton" onclick="addItem()">
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
                                        <textarea name="itemsName[]" placeholder="Item name"
                                                  class="materialize-textarea"></textarea>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-field col s4">
                                        <textarea name="itemsPrice[]" placeholder="Item price"
                                                  class="materialize-textarea"></textarea>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-field col s4">
                                        <textarea name="itemsQuantity[]" placeholder="Item quantity"
                                                  class="materialize-textarea"></textarea>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <label for="receiptImages">Receipt Images.</label>
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>Receipt</span>
                                <input type="file" id="receiptImages" name="receiptImages[]" multiple="multiple"
                                       accept="image/jpeg, image/png">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text"
                                       placeholder="Receipt Images, upload at least one">
                            </div>
                        </div>

                        <label for="resultImages">Result Images.</label>
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>Results</span>
                                <input type="file" id="resultImages" name="resultsImages[]"
                                       accept="image/jpeg, image/png" multiple="multiple">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text"
                                       placeholder="Result Images, upload at least one">
                            </div>
                        </div>
                        <button class="btn waves-effect waves-light right" type="submit" name="action"
                                style="line-height: 3.5px;font-size: small;height: 27px;margin-right: 85px;">Submit
                            <i class="material-icons right">send</i>
                        </button>
                    </form>
                @endisset
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

        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.collapsible');
            var instances = M.Collapsible.init(elems);
        });

        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.fixed-action-btn');
            var instances = M.FloatingActionButton.init(elems);
        });
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.materialboxed');
            var instances = M.Materialbox.init(elems);
        });
        var itemsTable = $('#tablebody');

        function addItem() {
            var id = $('table tr:last').attr('id');
            id++;
            itemsTable.append(
                '<tr id="' + id + '">' +
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
                '<a href="#!" onclick="deleteItem(' + id + ')">' +
                '<i class="material-icons postfix">delete</i>' +
                '</a>' +
                '</div>' +
                '</td>' +
                '</tr>'
            );
        }

        function deleteItem(id) {
            $('#' + id).remove();
        }
    </script>
@endpush

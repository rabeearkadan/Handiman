@extends('layouts.client.app')
@push('css')
    <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/invoice.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/colorbox.css')}}" rel="stylesheet">
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
    <div class="page-wrapper">
        <div class="main">
            <div class="main-inner">
                <ul class="collapsible popout">
                    <li>
                        <div class="collapsible-header">
                            <i class="material-icons">details</i>
                            Request Details
                        </div>
                        <div class="collapsible-body">
                            <span>Subject.</span>
                            <span>{{$request->subject}}</span>
                            <br>
                            <span>Description</span>
                            <span>{{$request->description}}</span>
                        </div>
                    </li>
{{--                    <li>--}}
{{--                        <div class="collapsible-header">--}}
{{--                            <i class="material-icons">perm_identity</i>--}}
{{--                            Client Details--}}
{{--                        </div>--}}
{{--                        <div class="collapsible-body">--}}
{{--                            --}}{{--               image ? --}}
{{--                            <i class="material-icons">user</i>--}}
{{--                            <span>{{$client->name}}</span>--}}
{{--                            <i class="material-icons">phone</i>--}}
{{--                            <span>{{$client->phone}}</span>--}}
{{--                        </div>--}}
{{--                    </li>--}}
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
                    {{$request->date->format('d/m/Y')}} </span>
                            <span>
                    <i class="material-icons">clock</i>
                    {{$request->from}} -> {{$request->to}}</span>
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
                                    <span>{{$request->client_address['name']}}</span><br>
                                    <h6>state</h6>
                                    <h6>city</h6>
                                    <h6>Street</h6>
                                    <span>{{$request->client_address['street']}}</span><br>
                                </div>
                                <div class="column">
                                    <h6>Property Type</h6>
                                    <span>{{$request->client_address['property_type']}}</span><br>
                                    <h6>Building: </h6>
                                    <span>{{$request->client_address['building']}}</span><br>
                                    <h6>Floor</h6>
                                    {{--                <span>{{$job->client_address['floor']}}</span><br>--}}
                                    <h6>zip</h6>
                                    <span>{{$request->client_address['zip']}}</span><br>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">images</i>
                            Provided Images
                        </div>
                        <div class="collapsible-body">
                            @foreach($request->images as $image)
                                <img class="materialboxed" src="{{config('image.path').$image}}">
                            @endforeach
                        </div>
                    </li>


                        <li>
                            <div class="collapsible-header"><i class="material-icons">payment</i>
                                Receipt Images
                            </div>
                            <div class="collapsible-body">
                                @foreach($request->receipt_images as $image)
                                    <img class="materialboxed" src="{{config('image.path').$image}}">
                                @endforeach
                            </div>
                        </li>

                        <li>
                            <div class="collapsible-header"><i class="material-icons">payment</i>
                                Finished Product
                            </div>
                            <div class="collapsible-body">
                                @foreach($request->result_images as $image)
                                    <img class="materialboxed" src="{{config('image.path').$image}}">
                                @endforeach
                            </div>
                        </li>
@isset($request->rating)
                    <li>
                        <div class="collapsible-header"><i class="material-icons">rating</i>
                            Review
                        </div>
                        <div class="collapsible-body">
                            <p>rating</p>
                            <p>review</p>
                        </div>
                    </li>
@endisset
                </ul>

                <div class="container">
                    <div class="content">
                        <div class="invoice-wrapper">
                            <div class="invoice">
                                <div class="invoice-header clearfix">
                                    <div class="invoice-logo">
                                        <i class="fa fa-rocket"></i> Handiman.club
                                    </div><!-- /.invoice-logo -->

{{--                                    <div class="invoice-description">--}}
{{--                                        <strong>#1323-3422 / 28.4.2015</strong>--}}
{{--                                        <span>Lorem ipsum dolor sit amet, consectetur...</span>--}}
{{--                                    </div>--}}
                                </div><!-- /.invoice-header -->

                                <div class="invoice-info">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h4>Employee</h4>
                                        <a href="{{route('client.user-profile',['employee_id' => $employee->id])}}">{{$employee->name}}</a>
                                            <br>
{{--                                            Mrs Emma Downson<br>--}}
{{--                                            RootColletions Ltd<br>--}}
{{--                                            Berlin<br>--}}
{{--                                            Germany<br>--}}
{{--                                            9785 45P<br>--}}
                                        </div>

                                        <div class="col-sm-4">
                                            <h4>About</h4>
                                            {{$request->subject}}<br>
                                            {{$request->description}}
                                        </div>
                                        <div class="col-sm-4">
                                            <h4>Service</h4>

                                            <strong>Duration:</strong> {{$request->to - $request->from}}<br>
                                            <strong>SubTotal:</strong> {{($request->to-$request->from)*$request->price}}<br>
                                        </div>
                                    </div>
                                </div><!-- /.invoice-info -->
                                <div class="table-responsive">
                                    <table class="invoice-table table">
                                        <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($request->receipt as $item)
                                        <tr>
                                            <td>{{$item['name']}}</td>
                                            <td>${{$item['price']}}</td>
                                            <td>{{$item['qty']}}</td>
                                            <td>${{$item['price']*$item['qty']}}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="invoice-summary clearfix">
                                    <dl class="dl-horizontal pull-right">
                                        <dt>Grand Total:</dt>
                                        <dd>{{$request->total}}</dd>
                                    </dl>
                                    @if($request->ispaid == false)
                                        <form action="{{route('client.invoice.store',$request->id)}}" method="post" id="payment-form">
                                            @csrf
                                            <input type="hidden" name="total" value="{{$request->total }}">
                                            <div class="form-group">
                                                <div class="card-header">
                                                    <label for="card-element">
                                                        Enter your credit card information
                                                    </label>
                                                </div>
                                                <div class="card-body">
                                                    <div id="card-element">
                                                        <!-- A Stripe Element will be inserted here. -->
                                                    </div>
                                                    <!-- Used to display form errors. -->
                                                    <div id="card-errors" role="alert"></div>
                                                </div>
                                                <div class="card-footer">
                                                    <button class="btn btn-dark" type="submit">Pay</button>
                                                </div>
                                        </form>
                                    @else
                                       <p>paid</p>
                                    @endif
                                </div><!-- /.invoice-summary -->
                            </div><!-- /.invoice -->
                        </div><!-- /.invoice-wrapper -->
                    </div><!-- /.content -->
                </div><!-- /.container -->
            </div><!-- /.main-inner -->
        </div><!-- /.main -->
    </div><!-- /.page-wrapper -->
@endsection
@push('js')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Create a Stripe client.
        var stripe = Stripe('pk_test_Yzk4eIQ2VOEGQFZ70vFBuQur00xW3XqfFv');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
<script>
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.collapsible');
            var instances = M.Collapsible.init(elems);
        });

        // document.addEventListener('DOMContentLoaded', function () {
        //     var elems = document.querySelectorAll('.fixed-action-btn');
        //     var instances = M.FloatingActionButton.init(elems);
        // });
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.materialboxed');
            var instances = M.Materialbox.init(elems);
        });
    </script>

@endpush

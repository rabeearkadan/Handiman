@extends('layouts.client.app')
@push('css')
    <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/invoice.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/colorbox.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div class="page-wrapper">
        <div class="main">
            <div class="main-inner">
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
                                            <h4>Payment Details</h4>

                                            <strong>VAT:</strong> 32132123<br>
                                            <strong>VAT ID:</strong> 345234523<br>
                                            <strong>Payment Type:</strong> Root<br>
                                            <strong>Name:</strong>Lorem Ipsum<br>
                                            <strong>Duration:</strong> Dolor si amet<br>
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
                                            <td>{{$item->name}}</td>
                                            <td>${{$item->price}}</td>
                                            <td>{{$item->qty}}</td>
                                            <td>${{$item->price*$item->qty}}</td>
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
                                </div><!-- /.invoice-summary -->
                            </div><!-- /.invoice -->
                        </div><!-- /.invoice-wrapper -->
                    </div><!-- /.content -->
                </div><!-- /.container -->
            </div><!-- /.main-inner -->
        </div><!-- /.main -->
    </div><!-- /.page-wrapper -->
@endsection

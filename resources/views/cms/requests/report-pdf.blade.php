<!doctype html>
<html>
<head>
    <meta charset="utf-8">

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
<div class="invoice-box rtl">
    <table style="border-collapse: separate; border-spacing: 10px;">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="https:handiman.club/public/img/logo.png">
                        </td>

                        <td>
                            Invoice <br>
                            Request Created at: {{$request->created_at}}<br>
                            Request Due: {{$request->date}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            Client Name:<br>
                            Employee Name:<br>
                            Service Provided:
                        </td>

                        <td>
                            {{$request->client['name']}}<br>
                            {{$request->handyman['name']}}<br>
                            {{$request->service['name']}}

                        </td>
                    </tr>
{{--                                        <tr>Address: {{$rquest->client_address['street']}},--}}
{{--                                            {{$request->client_address['building']}}--}}
{{--                                            {{$request->client_address['floor']}}</tr>--}}
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>
                Payment Method
            </td>

            <td>
                Online
            </td>
        </tr>

        <tr class="details">
            <td>
                Third Party
            </td>

            <td>
                Stripe
            </td>
        </tr>

        <tr class="heading">
            <td>
                Item
            </td>

            <td>
                Price
            </td>
            <td>
                Quantity
            </td>
        </tr>
        @foreach($request->receipt as $item)

            <tr class="item">
                <td>
                    {{$item['name']}}
                </td>

                <td>
                    {{$item['price']}}
                </td>
                <td>{{$item['qty']}}</td>
            </tr>

        @endforeach


        <tr class="total">
            <td></td>

            <td>
                Total: {{$request->total}}
            </td>
        </tr>
    </table>
    {{--    <div class="container mt-2" id="services">--}}
    {{--        <div class="row">--}}
    {{--            @if($request->receipt_images!=null)--}}
    {{--                @foreach($request->receipt_image as $image)--}}
    {{--                    @if ( $loop->index % 4 == 0 )--}}
    {{--        </div>--}}
    {{--        <div class="row">--}}
    {{--            @endif--}}
    {{--            <div class="col-md-3 col-sm-6">--}}
    {{--                <div class="card card-block">--}}
    {{--                    <img src="{{config('image.path').$image}}" alt="later">--}}
    {{--                    </a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            @endforeach--}}
    {{--        </div>--}}
    {{--        @endif--}}
    {{--    </div>--}}

</div>
</body>
</html>

@extends('cms.layouts.app')

@section('content')

<header>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</header>

<table style="width: 100%;">

    <tr>
        <td style="width:80%">
            <div style="width: 40%;">
                <div style="color: #f99100;font-size:30px;font-family:'poppins-m'"> {{__('front.label.voucher.00001')}}</div>
            </div>
        </td>
        <td style="width:20%">
            <img style="width: 20%" src="images/logo-moovtoo-black.svg">
        </td>
    </tr>
</table>
<div style="width: 95%; position: relative;border: 1px solid #eaeaea;border-radius: 10px;margin-top: 20px;height: 40px">
    <table>
        <tr>
            <td>
                <div style="width: 40%;">
                    <div style="font-size: 20px">{{substr($travelLocation->name, 0, 45)}}..</div>
                </div>
            </td>
            <td>
                <div style="text-align: right;margin-right: 40px;color: #555">{{$date}}</div>
            </td>
        </tr>
    </table>
</div>
<div style="position: absolute;
width: 80px;height: 80px;border-radius: 50%;background: #f99100;color: white;right: 20px;top: 105px;text-align: center;font-size: 20px;font-weight: bold">
    <div style="margin-top: 25px;"> {{$currancy}}</div>
</div>

@endsection

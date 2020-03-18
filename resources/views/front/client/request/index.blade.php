@extends('layouts.client.app')
@push('css')
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/tabs.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/requests-table.css')}}" rel="stylesheet">
@endpush
@section('content')
    <button class="tablink" onclick="openPage('Pending', this)" id="defaultOpen"> Pending</button>
    <button class="tablink approved" onclick="openPage('Approved', this)"> Approved </button>
    <div id="Pending" class="tabcontent">
        <div class="table-requests">
            <div class="header"> Pending Requests </div>
            <table>
                <tr>
                    <th> Employee </th>
                    <th> Service </th>
                    <th>Time</th>
                    <th width="500"> Description</th>
                    <th width="230"> </th>
                </tr>

                <tr>
                    <td>
                        <img src="" alt="" />
                        <p> Name </p>
                    </td>
                    <td> Service </td>
                    <td> Time </td>
                    <td style="text-align:left"> Blanditiis, aliquid numquam iure voluptatibus ut maiores explicabo ducimus neque, nesciunt rerum perferendis, inventoreBlanditiis, aliquid numquam iure voluptatibus ut maiores explicabo ducimus neque, nesciunt rerum perferendis, inventoreBlanditiis, aliquid numquam iure voluptatibus ut maiores explicabo ducimus neque, nesciunt rerum perferendis, inventoreBlanditiis, aliquid numquam iure voluptatibus ut maiores explicabo ducimus neque, nesciunt rerumnumquam iure voluptatibus ut maiores explicabo ducimus neque, nesciunt rerumnumquam iure voluptatibus ut maiores explicabo ducimus neque, nesciunt rerumnumquam iure voluptatibus ut maiores explicabo ducimus neque, nesciunt rerumnumquam iure voluptatibus ut maiores explicabo ducimus neque, nesciunt rerumnumquam iure voluptatibus ut maiores explicabo ducimus neque, nesciunt rerum perferendis, inventore </td>
                    <td> <a href="#/" class="view-button"> View </a> </td>
                </tr>
            </table>
        </div>
    </div>

    <div id="Approved" class="tabcontent">
        <div class="table-requests approved">
            <div class="header approved"> Approved Requests </div>
            <table class="approved">
                <tr class="approved" >
                    <th> Employee </th>
                    <th> Service </th>
                    <th>Time</th>
                    <th width="500"> Description</th>
                    <th width="230"> </th>
                </tr>
                <tr class="approved" >
                    <td>
                        <img src="https://i.picsum.photos/id/1005/100/100.jpg" alt="" />
                        <p>Name </p>
                    </td>
                    <td> Service </td>
                    <td> Time </td>
                    <td style="text-align:left;"> </td>
                    <td> <a href="#/" class="view-button approved"> View </a> </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script src="/public/js/client/tabs.js" type="text/javascript"></script>
@endpush

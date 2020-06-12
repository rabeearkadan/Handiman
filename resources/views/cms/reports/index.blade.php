@extends('cms.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title">Done Requests</h5>

                    <table class="mb-0 table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Service</th>
                            <th>Subject</th>
                            <th>
                                Date
                            </th>
                            <th>Open Report</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $request)
                            <tr id="row-{{$request->id}}">
                                <th scope="row">{{$loop->index +1 }}</th>
                                <td> {{ $request->client['name'] }}</td>
                                <td>{{$request->handyman['name']}}</td>
                                <td> {{ $request->service['name'] }}</td>

                                <td>{{$request->subject}}</td>
                                <td>
                                    <button class="mb-2 mr-2 btn btn-info"
                                            onclick="location.href='{{route('report.show',$request->id)}}'">Open Report
                                    </button>
                                </td>


                            </tr>
                            <tr></tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

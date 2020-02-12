@extends('cms.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title">Service Table</h5>
                    <button class="mb-2 mr-2 btn btn-primary" onclick="location.href='{{route('service.create')}}'">Add New Service</button>
                    <table class="mb-0 table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th># Users</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                       @foreach($services as $service)
                           <tr>
                               <th scope="row">{{$loop->index +1 }}</th>
                               <td>{{$service->name}}</td>
                               <td>{{$service->users()->count()}}</td>
                               <td>
                                   <a href="{{route('service.edit', $service->id)}}"><i class="pe-7s-pen"> </i></a>
                                   <a href="{{route('service.show', $service->id)}}"><i class="pe-7s-display"> </i></a>
                                   // modal as popup delete to be added
                                   <i class="pe-7s-trash"> </i>
                               </td>
                           </tr>
                       @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

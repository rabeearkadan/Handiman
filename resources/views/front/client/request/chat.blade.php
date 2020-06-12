@extends('layouts.client.app')
@push('css')
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/client/chat.css')}}" rel="stylesheet">
@endpush
@section('content')

    <div class="container">
        <h3 class=" text-center">Messaging</h3>
        <div class="messaging">
            <div class="inbox_msg">
                <div class="mesgs">
                    <div class="msg_history">
@foreach($messages as $message)
    @if($message->from['_id'] != $user->id)
                            <div class="incoming_msg">
                            <div class="incoming_msg_img">
                                <img src="{{config('image.path').$message->from['image']}}" alt="employee">
                            </div>
                            <div class="received_msg">
                                <div class="received_withd_msg">
                                    <p>{{$message->message}}</p>
                                    <span class="time_date"> {{$message->date}}</span></div>
                            </div>
                        </div>
@else


                        <div class="outgoing_msg">
                            <div class="sent_msg">
                                <p>{{$message->message}}</p>
                                <span class="time_date">{{$message->date}}</span> </div>
                        </div>
@endif
                        @endforeach



                    </div>


                    <div class="type_msg">
                        <div class="input_msg_write">
                            <form id="sendForm" method="post" action="javascript:void(0)">
                            @csrf
                            <input type="text" id="message" name="message" class="write_msg" placeholder="Type a message" />
                            <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
@push('js')
<script>

function update() {

}


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(".msg_send_btn").click(function(e){

    e.preventDefault();

    var message = $("input[name=message]").val();

    $.ajax({
        type:'POST',
        url:"{{ route('client.chat.send',$request->id) }}",
        data:{message:message},
        success:function(data){
            alert(data.status);
            $(".msg_history").append('<div class="incoming_msg">\n' +
                '                            <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>\n' +
                '                            <div class="received_msg">\n' +
                '                                <div class="received_withd_msg">\n' +
                '                                    <p>'+data.message+'</p>\n' +
                '                                    <span class="time_date">'+data.date+'</span></div>\n' +
                '                            </div>\n' +
                '                        </div>');

            $("#message").val('');
        }
    });

});

</script>
@endpush

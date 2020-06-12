@extends('layouts.employee.app')
@push('css')
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/employee/chat.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div class="container">
        <h3 class=" text-center">Messaging</h3>
        <div class="messaging">
            <div class="inbox_msg">
                <div class="mesgs">
                    <div class="msg_history">
                        @isset($messages)
                            @foreach($messages as $message)
                                @if($message['from']['_id'] != $user->id)
                                    <div class="incoming_msg">
                                        <div class="incoming_msg_img">
                                            <img src="{{config('image.path').$message['from']['image']}}"
                                                 alt="employee">
                                        </div>
                                        <div class="received_msg">
                                            <div class="received_withd_msg">
                                                <p>{{$message['message']}}</p>
                                                <span class="time_date"> {{$message['date']}}</span></div>
                                        </div>
                                    </div>
                                @else
                                    <div class="outgoing_msg">
                                        <div class="sent_msg">
                                            <p>{{$message['message']}}</p>
                                            <span class="time_date">{{$message['date']}}</span></div>
                                    </div>
                                @endif
                            @endforeach
                        @endisset
                    </div>
                    <div class="type_msg">
                        <div class="input_msg_write">
                            <form id="sendForm">
                                <input type="text" id="message" name="message" class="write_msg"
                                       placeholder="Type a message"/>
                                <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o"
                                                                              aria-hidden="true"></i></button>
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
        const interval = setInterval(function () {
            update();
        }, 1000);
        clearInterval(interval);

        function update() {
            var numberOfMessages = document.getElementsByClassName('incoming_msg').length + document.getElementsByClassName('outgoing_msg');
            $.ajax({
                type: 'GET',
                url: "{{ route('employee.chat.new',$request->id) }}",
                data: {numberOfMessages: numberOfMessages, _token: '{{csrf_token()}}'},
                success: function (data) {
                    if (data.status === "success") {
                        for (var index = 0; index < data.messages.length; index++) {
                            $(".msg_history").append('<div class="incoming_msg">' +
                                '<div class="incoming_msg_img">' +
                                '<img src="' + data.messages[index]['from']['image'] + '" alt="employee">' +
                                '  </div>' +
                                '<div class="received_msg">' +
                                '<div class="received_withd_msg">' +
                                '<p>' + data.messages[index]['message'] + '</p>' +
                                '<span class="time_date">' + data.messages[index]['date'] + '</span></div>' +
                                '</div>\n' +
                                '</div>');
                        }
                    }
                }
            });
        }

        $(".msg_send_btn").click(function (e) {
            e.preventDefault();
            var message = $("input[name=message]").val();
            if (message.trim().length !== 0) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('employee.chat.send',$request->id) }}",
                    data: {message: message, _token: '{{csrf_token()}}'},
                    success: function (data) {
                        $(".msg_history").append(' <div class="outgoing_msg">' +
                            '<div class="sent_msg">' +
                            '<p>' + data.message + '</p>' +
                            '<span class="time_date">' + data.date + '</span> </div>\n' +
                            '</div>');
                        $("#message").val('');
                    }
                });
            }
        });
    </script>
@endpush

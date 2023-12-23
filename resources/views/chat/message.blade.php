<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/styles/global-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/auth/style.css') }}">
    <link href='{{ asset('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css') }}' rel='stylesheet'>
    <link rel="shortcut icon" href="{{ asset('assets/images/trademark.svg') }}" type="image/x-icon">
    <script
        src="{{ asset('https://code.jquery.com/jquery-3.7.1.js') }}"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

</head>
<body>
<div class="mobile-container" style="padding: 20px">
    <div class="auth-header">
        <div class="get-back-btn">
            <a href="{{ route('user.show', $user->username) }}">
                <div class="reciever_user_info">
                    <div class="img">
                        <img src="{{ $user->getFirstMediaUrl('avatars') }}" alt="">
                    </div>
                    <div class="reciever_info">
                        <span style="display: flex; align-items: center; color: #121212">{!! $user->top_full_name !!}</span>
                        <p><i class='bx bxs-circle' style='color:#e94057'  ></i> {{ $user->is_online ? 'Online' : 'Offline' }}</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="get-back-btn">
            <i class='bx bx-dots-vertical-rounded' style='color:#e94057' ></i>
        </div>
    </div>

    <div class="auth-main chat-panel" style="position: relative">
        <div class="chat-container" id="messageContainer">
            @foreach($messages as $message)
                @if($message->sender_id == auth()->id())
                    <div style="display: flex; justify-content: flex-end">
                        <div class="sender_message" >
                            <div class="sender_message_text">
                                <p>{{ $message->message }}</p>
                            </div>
                            <div style="display: flex; justify-content: flex-end; margin-top: 5px">
                                <span style="font-size: 14px; color: silver">{{ \Carbon\Carbon::parse($message->created_at)->format('g:i A') }}</span>
                            </div>
                        </div>
                    </div>
                @else
                    <div style="display: flex; justify-content: flex-start">
                        <div class="reciever_message">
                            <div class="reciever_message_text">
                                <p>{{ $message->message }}</p>
                            </div>
                            <div style="display: flex; justify-content: flex-start; margin-top: 5px">
                                <span style="font-size: 14px; color: silver">{{ \Carbon\Carbon::parse($message->created_at)->format('g:i A') }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <form action="{{ route('chat.store', $user->username) }}" class="message_send_input" method="post">
        @csrf
        @method('post')
        <div style="position:relative; width: 90%;">
            <input type="text" placeholder="Your message" name="message">
        </div>
        @include('layouts.nav')
    </form>
</div>

{{--<script>--}}
{{--    $(document).ready(function () {--}}
{{--        getMessages();--}}

{{--        console.log('ready');--}}
{{--        displayMessages({{ $messages }});--}}
{{--        $('.message_send_input').submit(sendMessage);--}}
{{--    });--}}

{{--    const sendMessage = (event) => {--}}
{{--        console.log(event);--}}
{{--        event.preventDefault();--}}

{{--        const form = $('.message_send_input');--}}
{{--        const message = form.find('input[name="message"]').val();--}}
{{--        const url = form.attr('action');--}}
{{--        const token = form.find('input[name="_token"]').val();--}}

{{--        $.ajax({--}}
{{--            url: url,--}}
{{--            type: 'post',--}}
{{--            data: {--}}
{{--                message: message,--}}
{{--                _token: token--}}
{{--            },--}}
{{--            success: function (response) {--}}
{{--                console.log(response);--}}
{{--                // После успешной отправки сообщения, вы можете обновить отображение сообщений, вызвав getMessages() или добавив новое сообщение вручную--}}
{{--            }--}}
{{--        });--}}
{{--    }--}}

{{--    const getMessages = () => {--}}
{{--        const url = '{{ route('api.chat.show', $user->username) }}';--}}
{{--        const token = $('meta[name="csrf-token"]').attr('content');--}}
{{--        $.ajax({--}}
{{--            url: url,--}}
{{--            type: 'get',--}}
{{--            data: {--}}
{{--                _token: token--}}
{{--            },--}}
{{--            success: function (response) {--}}
{{--                console.log(response.user);--}}
{{--            }--}}
{{--        });--}}
{{--    }--}}

{{--    const displayMessages = (messages) => {--}}
{{--        const container = $('#messageContainer');--}}
{{--        container.empty();--}}
{{--        messages.forEach(message => {--}}
{{--            if (message.sender_id == {{ auth()->id() }}) {--}}
{{--                container.append(`--}}
{{--                    <div class="sender_message">--}}
{{--                        <div class="sender_message_text">--}}
{{--                            <p>${message.message}</p>--}}
{{--                            <span>${message.created_at}</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                `);--}}
{{--            } else {--}}
{{--                container.append(`--}}
{{--                    <div class="reciever_message">--}}
{{--                        <div class="reciever_message_text">--}}
{{--                            <p>${message.message}</p>--}}
{{--                            <span>${message.created_at}</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                `);--}}
{{--            }--}}
{{--        });--}}
{{--    }--}}
{{--</script>--}}

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

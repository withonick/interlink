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

</head>
<body>
<div class="mobile-container">
    <div class="auth-header">
        <div class="get-back-btn">
            <div class="reciever_user_info">
                <div class="img">
                    <img src="{{ $user->getFirstMediaUrl('avatars') }}" alt="">
                </div>
                <div class="reciever_info">
                    <span style="display: flex; align-items: center; color: #121212">{{ $user->username }}</span>
                    <p><i class='bx bxs-circle' style='color:#e94057'  ></i> {{ $user->is_online ? 'Online' : 'Offline' }}</p>
                </div>
            </div>
        </div>

        <div class="get-back-btn">
            <i class='bx bx-dots-vertical-rounded' style='color:#e94057' ></i>
        </div>
    </div>

    <div class="auth-main chat-panel" style="position: relative">
        <div class="chat-container">
            @foreach($messages as $message)
                @if($message->sender_id == auth()->id())
                    <div class="sender_message">
                        <div class="sender_message_text">
                            <p>{{ $message->message }}</p>
                            <span>{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans(null, true) }}</span>
                        </div>
                    </div>
                @else
                    <div class="reciever_message">
                        <div class="reciever_message_text">
                            <p>{{ $message->message }}</p>
                            <span>{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans(null, true) }}</span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <form action="{{ route('chat.store', $user->username) }}" class="message_send_input" method="post">
            @csrf
            @method('post')
            <div style="position:relative; width: 90%;">
                <input type="text" placeholder="Your message" name="message">
            </div>


        </form>
    </div>
</div>

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

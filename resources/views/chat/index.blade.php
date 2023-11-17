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
            <h1>Messages</h1>
        </div>

        <div class="get-back-btn">
            <i class='bx bxl-telegram' style='color:#e94057' ></i>
        </div>
    </div>

    <div class="auth-main">
        <div class="chat-search-bar">
            <i class='bx bx-search-alt' ></i><input type="text" placeholder="Search">
        </div>

        <div class="chat-wrapper">
            <h4>Messages</h4>

            <div class="message-list">
                @foreach($users as $user)
                    <a href="#">
                        <div class="message-bar">
                            <div class="message_user_image">
                                <div class="img">
                                    <img src="{{ $user->avatar }}" alt="">
                                </div>
                            </div>
                            <div class="message_text">
                                <div class="message_user">
                                    <span>{{ $user->getUserFullName() }}</span>
                                    <p>{{ $user->username }}</p>
                                </div>

                                <div class="message_detail">
                                    <span>23 min</span>
                                    <span id="message_count">1</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="nav">
        <a href="{{ route('index') }}"><i class='bx bxs-card'></i></a>
        <a href="#"><i class='bx bx-calendar-event' style='color:#adafbb'  ></i></a>
        <a href="#"><i class='bx bxs-heart'></i></a>
        <a href="{{ route('chat.index') }}"><i class='bx bx-message-square-dots active'></i></a>
        <a href="{{ route('user.show', Auth::user()->username) }}"><i class='bx bxs-user'></i></a>
    </div>
</div>



<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

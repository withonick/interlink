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
    </div>

    <div class="auth-main">
        <form action="{{ route('chat.search') }}" method="get" class="chat-search-bar">
            @csrf
            @method('get')
            <i class='bx bx-search-alt' ></i><input name="query" type="text" placeholder="Search">
        </form>

        <div class="chat-wrapper">
            <h4>Messages</h4>

            <div class="message-list">
                @forelse($users as $user)
                    <a href="{{ route('chat.show', $user->username) }}">
                        <div class="message-bar">
                            <div class="message_user_image">
                                <div class="img">
                                    <img src="{{ $user->avatar }}" alt="">
                                </div>
                            </div>
                            <div class="message_text">
                                <div class="message_user">
                                    <span style="display: flex; align-items: center; font-size: 18px">{!! $user->top_full_name !!}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <p style="font-size: 20px; font-weight: 500">Еще нет сообщений.</p>
                @endforelse
            </div>
        </div>
    </div>

    @include('layouts.nav')

</div>






<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
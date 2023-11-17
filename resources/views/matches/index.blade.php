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
            <h1>Notifications</h1>
        </div>

        <div class="get-back-btn">
            <i class='bx bxl-telegram' style='color:#e94057' ></i>
        </div>
    </div>

    <div class="auth-main">
        <div class="chat-wrapper">
            <h4>Последние уведомлении</h4>

            <div class="message-list">
                        @forelse($likes as $likedUser)
                    <div class="message-bar">
                        <div class="message_user_image">
                            <div class="img">
                                <img src="{{ $likedUser->getFirstMediaUrl('avatars')  }}" alt="">
                            </div>
                        </div>
                        <div class="message_text">
                            <div class="message_user">
                                <span>{{ $likedUser->getUserFullName() }}</span>
                                <p>Пользователю понравился ваш профиль</p>
                            </div>

                            <div class="message_detail" style="flex-direction: row; gap: 0">
                                <form action="{{ route('matches.delete', $likedUser->username) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button style="background:transparent; border: none; cursor:pointer;"><i class='bx bx-x' style="color: #FFFFFF; background-color: #cc0000; padding: 10px; border-radius: 50%; font-size: 20px"></i></button>
                                </form>

                                <form action="{{ route('matches.accept', $likedUser->username) }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <button style="background:transparent; border: none; cursor:pointer;"><i class='bx bx-check' style="color: #FFFFFF; background-color: #00FF00; padding: 10px; border-radius: 50%; font-size: 20px"></i></button>

                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                            <h3 class="mt-2">У вас пока нет уведомлении.</h3>
                @endforelse
            </div>
        </div>
    </div>

    <div class="nav">
        <a href="{{ route('index') }}"><i class='bx bxs-card'></i></a>
        <a href="#"><i class='bx bx-calendar-event' style='color:#adafbb'  ></i></a>
        <a href="{{ route('matches.index') }}"><i class='bx bxs-heart active'></i></a>
        <a href="{{ route('chat.index') }}"><i class='bx bx-message-square-dots'></i></a>
        <a href="{{ route('user.show', Auth::user()->username) }}"><i class='bx bxs-user'></i></a>
    </div>
</div>



<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

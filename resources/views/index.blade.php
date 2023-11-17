<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/styles/global-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/auth/style.css') }}">
    <link href='{{ asset('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css') }}' rel='stylesheet'>
    <script
        src="{{ asset('https://code.jquery.com/jquery-3.7.1.js') }}"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

</head>
<body>
<div class="mobile-container text-center">
    <div class="mobile-container" >
        <div class="auth-header" style="position:sticky;">
            <div class="get-back-btn">
                <i class='bx bx-chevron-left'></i>
            </div>

            <div class="header-text">
                <h3>Discover</h3>
                <p>{{ Auth::user()->address->country }}</p>
            </div>

            <div class="get-back-btn">
                <a href="#"><i class='bx bx-filter' style='color:#e94057'  ></i></a>
            </div>
        </div>

        <div class="main-content">
                @forelse($users as $user)
                    <a href="{{ route('user.show', $user->username) }}">
                        <div class="user-image">
                            <img id="slider_1" src="{{ $user->getFirstMediaUrl('avatars') }}" alt="">
                            <div style="display: flex; align-items: center">
                                <span class="distance-len"><i class='bx bxs-location-plus' style='color:#ffffff'  ></i>{{ $user->address->city }}</span>
                            </div>
                            <div class="user-image-info" >
                                <h3 style="color: #fff">{{ $user->getUserFullName() . ', ' . $user->getUserAge() }}</h3>
                                <span style="color: #fff">{{ $user->status }}</span>
                            </div>
                        </div>
                    </a>
            @empty
                    <h2 style="margin-top: 150px">Новых пользователей пока нет.</h2>
                @if(empty($users))

                    @else
                        <div class="user_like_dislike">
                            <form action="{{ route('dislike', $user->username) }}" method="post" class="dislike">
                                @csrf
                                @method('POST')
                                <button style="background-color: transparent; border: none"><i class='bx bx-x' style="color: #F27121"></i></button>
                            </form>
                            <div class="chat-wrapper">
                                <a href="{{ route('chat.show', $user->username) }}"><i class='bx bxl-telegram' style='color:#FFFFFF'  ></i></a>
                            </div>
                            <form action="{{ route('like', $user->username) }}" method="post" class="like">
                                @csrf
                                @method('POST')
                                <button style="background-color: transparent; border: none"><i class='bx bxs-heart' style="color: #8A2387"></i></button>
                            </form>
                        </div>
                @endif

        </div>

        <div class="nav">
            <a href="{{ route('index') }}"><i class='bx bxs-card active'></i></a>
            <a href="#"><i class='bx bx-calendar-event' style='color:#adafbb'  ></i></a>
            <a href="{{ route('matches.index') }}"><i class='bx bxs-heart'></i></a>
            <a href="{{ route('chat.index') }}"><i class='bx bx-message-square-dots'></i></a>
            <a href="{{ route('user.show', Auth::user()->username) }}"><i class='bx bxs-user'></i></a>
        </div>

    </div>
</div>




<script src="{{ asset('js/script.js') }}"></script>


</body>
</html>

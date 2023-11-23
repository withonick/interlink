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
            <h1>Матчи</h1>
            <div class="mt-2">
                <p>Это список людей, которым понравились вы и ваши совпадения.</p>
            </div>

        </div>
    </div>

    <div class="auth-main">
        <div class="chat-wrapper">
            <div class="matched_users">
                @if($likes)
                    @foreach($likes as $user)
                        <div class="matched_user_wrapper">
                            <img src="{{ $user->avatar }}" alt="">
                            <div class="matched_user_info">
                                <span>{{ $user->fullname . ', ' . $user->age }}</span>
                            </div>
                            <div class="matched_user_actions">
                                <form action="{{ route('matches.accept', $user->username) }}" method="post" class="matched_user_action">
                                    @csrf
                                    @method('POST')
                                    <button style="background-color: transparent; border: none;"><i class='bx bx-x' style="color: #FFFFFF; font-weight: bold; font-size: 35px"></i></button>
                                </form>
                                <form action="{{ route('matches.delete', $user->username) }}" method="post" class="matched_user_action" style="border: none">
                                    @csrf
                                    @method('POST')
                                    <button style="background-color: transparent; border: none;"><i class='bx bxs-heart' style="color: #FFFFFF; font-weight: bold; font-size: 30px"></i></button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
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

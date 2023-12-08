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

    <div class="match-main">
        <div class="match_user_images">
            <div class="img">
                <img src="{{ $match->getFirstMediaUrl('avatars') }}" alt="">
            </div>
            <div class="img-2">
                <img src="{{ Auth::user()->getFirstMediaUrl('avatars') }}" alt="">
            </div>
        </div>

        <div class="match_text text-center mt-4">
            <h2 style="color: var(--background-color)">У вас матч, {{ Auth::user()->firstname }}!</h2>
            <p>Начните разговор прямо сейчас друг с другом</p>
            <div class="mt-4">
                <a class="btn btn-secondary" href="{{ route('chat.show', $match->username) }}">Сказать привет</a>
            </div>
        </div>
    </div>

    @include('layouts.nav')

</div>



<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

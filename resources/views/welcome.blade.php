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
    <div class="carousel">
        <img id="slider_1" src="{{ asset('assets/images/carousel-2.jpeg') }}" alt="">
        <img id="slider_2" src="{{ asset('assets/images/carousel-1.jpeg') }}" alt="">
        <img id="slider_3" src="{{ asset('assets/images/carousel-3.jpeg') }}" alt="">
    </div>

    <div class="carousel-nav">
        <a href="#slider_1"></a>
        <a href="#slider_2"></a>
        <a href="#slider_3"></a>
    </div>

    <div class="mt-4">
        <a href="{{ route('register.form') }}" class="btn btn-primary">Создать аккаунт</a>
    </div>
    <div class="mt-4">
        <span >У вас уже есть аккаунт ? <a style="color: #E94057; font-weight: bold" href="{{ route('login.form') }}">Войти</a></span>
    </div>
</div>




<script src="{{ asset('js/script.js') }}"></script>


</body>
</html>

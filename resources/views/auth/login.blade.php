<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/styles/global-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/auth/style.css') }}">
    <link href='{{ asset('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css') }}' rel='stylesheet'>
</head>
<body>
<div class="mobile-container">
    <div class="auth-main">
        <h1>Добро пожаловать.</h1>
        <p style="font-weight: 500">Пожалуйста введите свой логин и пароль.</p>

        <form action="{{ route('login') }}" method="post">
            @csrf
            @method('post')
            <div class="choice-wrapper">
                <div class="number-input" style="margin-bottom: 20px">
                    <i class='bx bxs-user'></i><input type="text" placeholder="Username" name="username">
                </div>
                <div class="number-input">
                    <i class='bx bxs-key' ></i><input type="password" placeholder="Password" name="password">
                </div>
            </div>

            <div class="continue">
                <button type="submit" class="btn btn-primary">Войти</button>
            </div>

            <div class="continue">
                <p>Нет аккаунта? <a style="color: var(--background-color)" href="{{ route('register.form') }}">Зарегистрироваться</a></p>
            </div>
        </form>
    </div>
</div>


<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

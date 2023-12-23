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
    <div class="auth-header">
        <div class="get-back-btn">
            <i class='bx bx-chevron-left'></i>
        </div>

        <div class="skip-btn">

        </div>
    </div>

    <div class="auth-main">
        <h1>Регистрация.</h1>
        <p>Пожалуйста, введите свой действительный адрес электронной почты.</p>

        <form action="{{ route('register.email.store') }}" method="post">
            @csrf
            @method('post')
            <div class="choice-wrapper">
                <div class="number-input" style="margin-bottom: 20px">
                    <i class='bx bxs-user'></i><input type="text" placeholder="Имя пользователя" name="username">
                </div>
                <div class="number-input" style="margin-bottom: 20px">
                    <i class='bx bxs-envelope'></i><input type="email" placeholder="Электронный адрес" name="email">
                </div>
                <div class="number-input">
                    <i class='bx bxs-key' ></i><input type="password" placeholder="Пароль" name="password">
                </div>
            </div>

            <div class="continue">
                <button type="submit" class="btn btn-primary">Продолжить</button>
            </div>

            <div class="continue">
                <p>Уже есть аккаунт? <a style="color: var(--background-color)" href="{{ route('login.form') }}">Войти</a></p>
            </div>
        </form>
    </div>
</div>


<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

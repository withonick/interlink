<!DOCTYPE html>
<html lang="en">
@extends('layouts.head')

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

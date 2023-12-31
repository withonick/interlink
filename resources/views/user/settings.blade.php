<!DOCTYPE html>
<html lang="en">
@extends('layouts.head')

<body>
<div class="mobile-container">
    <div class="auth-header">
        <div class="get-back-btn">
            <i class='bx bx-chevron-left'></i>
        </div>
    </div>

    <div class="settings-wrapper">
        <div class="settings-item">
            <div class="settings-item__header">
                <h2>Аккаунт</h2>
            </div>
            <div class="settings-item__content">
                <div class="settings-item__content__item">
                    <a href="{{ route('user.edit', $user->username) }}">Редактировать профиль</a>
                </div>
                <div class="settings-item__content__item">
                    <a href="{{ route('user.verifications', $user->username) }}">Запросить подтверждение</a>
                </div>
                <form action="{{ route('logout') }}" method="post" class="settings-item__content__item">
                    @csrf
                    @method('post')
                    <button style="background: transparent; border: none" href="#"><a >Выйти с аккаунта</a></button>
                </form>
            </div>
        </div>
    </div>

{{--    <div style="display: flex; justify-content: center">--}}
{{--        <form action="{{ route('logout') }}" method="post">--}}
{{--            @csrf--}}
{{--            <button type="submit" class="btn btn-primary">Выйти с аккаунта</button>--}}
{{--        </form>--}}
{{--    </div>--}}
</div>


<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

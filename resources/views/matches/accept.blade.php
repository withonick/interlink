<!DOCTYPE html>
<html lang="en">
@extends('layouts.head')

<body>
<div class="mobile-container">

    <div class="match-main">
        <div class="match_user_images">
            <div class="img">
                <img src="{{ $match->avatar }}" alt="">
            </div>
            <div class="img-2">
                <img src="{{ Auth::user()->avatar }}" alt="">
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

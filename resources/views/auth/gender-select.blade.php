<!DOCTYPE html>
<html lang="en">
@extends('layouts.head')

<body>
<div class="mobile-container">
    <div class="auth-header">

        <div class="skip-btn">
            <a href="{{ route('register.hobbies') }}">Пропустить</a>
        </div>
    </div>

    <div class="auth-main">
        <h1>Я являюсь</h1>

        <form action="{{ route('register.gender.store') }}" method="post">
            @csrf
            @method('post')
            <div class="choice-wrapper">
                @foreach($genders as $gender)
                    <input type="radio" style="visibility: hidden;" value="{{ $gender->name }}" id="{{ $gender->value }}" name="gender">
                    <label for="{{ $gender->name }}">{{ $gender->name }} <i class='bx bx-check'></i></label>
                @endforeach
            </div>

            <div class="continue">
                <button type="submit" class="btn btn-primary">Продолжить</button>
            </div>
        </form>
    </div>
</div>


<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

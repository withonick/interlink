<!DOCTYPE html>
<html lang="en">
@extends('layouts.head')

<body>
<div class="mobile-container">
    <div class="auth-header">
        <div class="skip-btn">
            <a href="{{ route('user.show', $user->username) }}">Пропустить</a>
        </div>
    </div>


    <form action="{{ route('user.update', $user->username) }}" enctype="multipart/form-data" method="post" class="auth-main">
        <h1>Детали профиля</h1>
        <div class="choice-wrapper">
            @csrf
            @method('PUT')
            <div class="profile_img_container">
                <img src="{{ $user->avatar }}" alt="">
                <i id="image_btn" class='bx bxs-camera' style='color:#ffffff; '  ></i>
            </div>

            <div class="profile_detail_info" style="display: flex; flex-direction: column; align-items: center">
                <input id="image_input" name="image" type="file" style="display: none;">

                <div style="display: flex; flex-direction: column; gap: 10px">
                    <span>Имя:</span>
                    <input type="text" placeholder="Введите ваше имя" name="firstname" value="{{ Auth::user()->firstname }}">
                </div>
                <div style="display: flex; flex-direction: column; gap: 10px">
                    <span>Фамилия:</span>
                    <input type="text" placeholder="Введите вашу фамилию" name="surname" value="{{ Auth::user()->surname }}">
                </div>
                <div style="display: flex; flex-direction: column; gap: 10px">
                    <span>День рождение:</span>
                    <input type="date" onkeypress="return false" name="birthday" value="{{ Auth::user()->birthday }}">
                </div>
                <div style="display: flex; flex-direction: column; gap: 10px">
                    <span>Статус:</span>
                    <input type="text" placeholder="Установить статус профиля" name="status" value="{{ Auth::user()->status }}">
                </div>
                <div style="display: flex; flex-direction: column; gap: 10px">
                    <span>Местоимения:</span>
                    <div style="display: flex">
                        <input type="text" name="pronouns_1" style="width: 150px" value="{{ Auth::user()->pronouns->pronouns_1 ?? '' }}">
                        <input type="text" name="pronouns_2" style="width: 150px" value="{{ Auth::user()->pronouns->pronouns_2 ?? '' }}">
                    </div>
                </div>
                <div style="display: flex; flex-direction: column; gap: 10px">
                    <span>Про вас:</span>
                    <textarea name="bio" style="resize: none" cols="30" rows="10">
                        {{ Auth::user()->bio }}
                    </textarea>
                </div>
                <div style="display: flex; flex-direction: column; gap: 10px">
                    <span>Адрес:</span>
                    <select name="country">
                        @foreach($countries as $country)
                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                    <input type="text" placeholder="Введите город" name="city" value="{{ Auth::user()->address->city ?? '' }}">
                    <input type="text" placeholder="Улица" name="street" value="{{ Auth::user()->address->street ?? '' }}">
                    <input type="number" placeholder="Квартира" name="zip" value="{{ Auth::user()->address->zip ?? '' }}">

                </div>

                <div class="continue">
                    <button class="btn btn-primary">Сохранить</button>
                </div>


            </div>
        </div>
    </form>

    <div style="display: flex; justify-content: center">
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-primary">Выйти с аккаунта</button>
        </form>
    </div>
</div>


<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
@extends('layouts.head')

<body>
<div class="mobile-container text-center">
    <div class="mobile-container" >
        <div class="auth-header" style="position:sticky;">
            <div class="get-back-btn">
                <i class='bx bx-chevron-left'></i>
            </div>

            <div class="header-text">
                <h3>Discover</h3>
            </div>

            <div class="get-back-btn">
                <a href="#demo-modal"><i class='bx bx-filter' style='color:#e94057'  ></i></a>
            </div>
        </div>

        <div class="main-content">
            @forelse($users as $user)
                <a href="{{ route('user.show', $user->username) }}">
                    <div class="user-image">
                        <img id="slider_1" src="{{ $user->getFirstMediaUrl('avatars') }}" alt="">
                        <div style="display: flex; align-items: center">
                            <span class="distance-len"><i class='bx bxs-location-plus' style='color:#ffffff'  ></i>{{ $user->address->city }}</span>
                        </div>
                        <div class="user-image-info" >
                            <h3 style="color: #fff">{{ $user->fullname . ', ' . $user->age }}</h3>
                            <span style="color: #fff">{{ $user->status }}a
                        </div>
                    </div>
                </a>
                <div class="user_like_dislike">
                    <form action="{{ route('dislike', $user->username) }}" method="post" class="dislike">
                        @csrf
                        @method('POST')
                        <button id="dislike_btn" style="background-color: transparent; border: none"><i class='bx bx-x' style="color: #F27121"></i></button>
                    </form>
                    <div class="chat-wrapper">
                        <a href="{{ route('chat.show', $user->username) }}"><i class='bx bxl-telegram' style='color:#FFFFFF'  ></i></a>
                    </div>
                    <form action="{{ route('like', $user->username) }}" method="post" class="like">
                        @csrf
                        @method('POST')
                        <button id="like_btn" style="background-color: transparent; border: none"><i class='bx bxs-heart' style="color: #8A2387"></i></button>
                    </form>
                </div>
            @empty
                <h3 class="mt-2">Новых пользователей пока нет.</h3>
            @endforelse
        </div>

        @include('layouts.nav')


    </div>
</div>







<script src="{{ asset('js/script.js') }}"></script>


</body>

<div id="demo-modal" class="search-modal">
    <div class="search_modal_content">
        <h1>Фильтр</h1>

        <form action="{{ route('search.user') }}" method="get"  class="filter-wrapper">
            @csrf
            @method('GET')

            <div class="search__input-wrapper">
                <input type="text" placeholder="Имя, Фамилия, Логин, Эл. адрес" name="query">
                <i class='bx bx-search'></i>
            </div>

            <div class="filter_main mt-2">
                <div class="filter_gender">
                    <h2 style="margin-bottom: 10px">Кого вы ищете?</h2>
                    <div style="display: flex; align-items: center; gap: 10px">
                        <div class="checkbox-wrapper-12">
                            <div class="cbx">
                                <input name="gender" value="Male" type="checkbox" id="cbx-12">
                                <label for="cbx-12"></label>
                                <svg fill="none" viewBox="0 0 15 14" height="14" width="15">
                                    <path d="M2 8.36364L6.23077 12L13 2"></path>
                                </svg>
                            </div>

                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <filter id="goo-12">
                                        <feGaussianBlur result="blur" stdDeviation="4" in="SourceGraphic"></feGaussianBlur>
                                        <feColorMatrix result="goo-12" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" mode="matrix" in="blur"></feColorMatrix>
                                        <feBlend in2="goo-12" in="SourceGraphic"></feBlend>
                                    </filter>
                                </defs>
                            </svg>
                        </div>
                        <label for="male">Мужчина</label>
                    </div>
                    <div class="mt-2" style="display: flex; align-items: center; gap: 10px">
                        <div class="checkbox-wrapper-12">
                            <div class="cbx">
                                <input name="gender" value="Female" type="checkbox" id="cbx-12">
                                <label for="cbx-12"></label>
                                <svg fill="none" viewBox="0 0 15 14" height="14" width="15">
                                    <path d="M2 8.36364L6.23077 12L13 2"></path>
                                </svg>
                            </div>

                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <filter id="goo-12">
                                        <feGaussianBlur result="blur" stdDeviation="4" in="SourceGraphic"></feGaussianBlur>
                                        <feColorMatrix result="goo-12" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" mode="matrix" in="blur"></feColorMatrix>
                                        <feBlend in2="goo-12" in="SourceGraphic"></feBlend>
                                    </filter>
                                </defs>
                            </svg>
                        </div>
                        <label for="female">Женщина</label>
                    </div>
                    <div class="mt-2" style="display: flex; align-items: center; gap: 10px">
                        <div class="checkbox-wrapper-12">
                            <div class="cbx">
                                <input name="gender" value="Other" type="checkbox" id="cbx-12">
                                <label for="cbx-12"></label>
                                <svg fill="none" viewBox="0 0 15 14" height="14" width="15">
                                    <path d="M2 8.36364L6.23077 12L13 2"></path>
                                </svg>
                            </div>

                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <filter id="goo-12">
                                        <feGaussianBlur result="blur" stdDeviation="4" in="SourceGraphic"></feGaussianBlur>
                                        <feColorMatrix result="goo-12" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" mode="matrix" in="blur"></feColorMatrix>
                                        <feBlend in2="goo-12" in="SourceGraphic"></feBlend>
                                    </filter>
                                </defs>
                            </svg>
                        </div>
                        <label for="other">Другие</label>
                    </div>
                </div>
                <div class="age-filter">
                    <h2>Выберите возраст</h2>

                    <div style="display: flex">
                        <div class="mt-2" style="display: flex; flex-direction: column; gap: 10px">
                            <label for="min">Минимум:</label>
                            <input type="number" name="age_min" min="18">
                        </div>
                        <div class="mt-4" style="display: flex; justify-content: center; align-items: center">
                            <i class='bx bx-chevron-right' style="font-size: 24px"></i>
                        </div>
                        <div class="mt-2" style="display: flex; flex-direction: column; gap: 10px">
                            <label for="max">Максимум:</label>
                            <input type="number" name="age_max" max="99">
                        </div>
                    </div>
                </div>

                <div class="country_filter">
                    <h2 style="margin-bottom: 10px">Выберите страну</h2>

                    <select name="country" id="">
                        <option value="">Выберите страну</option>
                        @foreach(\App\Enums\Country::getCountryList() as $country)
                            <option value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>

                    <input type="text" placeholder="Город" class="form-control" name="city">
                </div>
            </div>
            <div class="mt-4" style="display: flex; justify-content: center">
                <button class="btn btn-primary">Найти</button>
            </div>
        </form>

        <div class="search_modal_footer">
        </div>

        <a href="#" class="search_modal_close"><i class='bx bx-x' style="font-size: 24px"></i></a>
        </form>
    </div>
</div>

</html>

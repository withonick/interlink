<!DOCTYPE html>
<html lang="en">
@extends('layouts.head')

<body>
<div class="profile-image" style="
                max-width: 700px;
                margin: 0 auto;
                height: 800px;
                background-image: url({{ $user->avatar }});
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                clear: both;
                position:relative;

         ">

</div>
<div class="mobile-container" style="
                                border-radius: 50px 50px 0 0;
                                position:absolute;
                                top: 750px;
                                left: 0;
                                right: 0;
                                margin-left: auto;
                                margin-right: auto;
                                ">

    <div class="auth-main" style="margin-top: -60px; display: flex; flex-direction: column">
        <div class="user-info">
            <div class="text-center">
                <a style="float: right" href="#" ><i class='bx bxl-telegram' style='color:#e94057; font-size: 24px; padding: 10px; border: 1px solid var(--secondary-color); border-radius: 10px'  ></i></a>

                @if($user->pronouns)
                    <i class="text-center">{{ ($user->pronouns->pronouns_1 ?? '') . '/' . ($user->pronouns->pronouns_2 ?? '') }}</i>
                @else
                    <i class="text-center">Местоимение не указано</i>
                @endif
            </div>
            @if($user->firstname || $user->surname)
                <h3 class="mt-2">{!! $user->top_full_name !!}</h3>
            @else
                <h3>Имя и фамилия не указано.</h3>
            @endif
            <p style="font-weight: 500">{{ $user->status ?? 'Пользователь еще не установил статус.' }}</p>

            <div class="mt-4">
                <h2>Адрес</h2>
                <div class="mt-2">
                    <span style="font-weight: 500">{{ $user->address->location ?? 'Адрес не указан.' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <h2>Про себя</h2>
                <div class="mt-2">
                    <p>{{ $user->bio ?? 'Пользователь еще не написал про себя.' }}</p>
                </div>
            </div>

            <div class="mt-4">
                <h2>Интересы</h2>

                <div class="mt-2">
                    <div class="user-hobbies">
                        @forelse($hobbies as $hobby)
                            @if(Auth::user()->hobbies->contains($hobby))
                                <label class=""> <i class='bx bx-check-double' ></i> {{ $hobby->name }}</label>
                            @else
                                <label class=""> {{ $hobby->name }}</label>
                            @endif
                        @empty
                            <p style="width: 600px; font-weight: 500; font-size: 18px">Пользователь еще не выбрал интересы.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h2>Галерея</h2>

                <div>
                    <div class="user-gallery">
                        @forelse($user->getMedia('gallery') as $media)
                                <a href="{{ $media->getUrl() }}"><img src="{{ $media->getUrl() }}" alt=""></a>
                        @empty
                            <p style="width: 600px; font-weight: 500; font-size: 18px">Пользователь еще не добавил изображение в галерею.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        {{--        <a href="#" style="float: right"><i class='bx bxl-telegram' style='color:#e94057; border: 1px solid #F3F3F3; font-size: 24px; padding: 15px; border-radius: 10px; margin-top: 10px;'  ></i></a>--}}
    </div>
    @include('layouts.nav')

</div>


<script src="{{ asset('js/script.js') }}"></script>

<script>
    const gallery_input = document.getElementById('gallery_input');
    const gallery_label = document.getElementById('gallery_label');

    gallery_label.addEventListener('click', () => {
        gallery_input.click();
    });
</script>
</body>
</html>

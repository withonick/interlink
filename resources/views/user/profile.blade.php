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

        <div class="auth-header" style="position:absolute; top: 50px; right: 0">
            <div class="get-back-btn">
                <a href="{{ route('user.settings', $user->username) }}"><i class='bx bxs-cog' style='color:#e94057; font-size: 24px; background-color: #FFFFFF'  ></i></a>
            </div>
        </div>

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
            <a style="float: right" href="{{ route('user.edit', $user->username) }}" ><i class='bx bx-edit' style='color:#e94057; font-size: 24px; padding: 10px; border: 1px solid var(--secondary-color); border-radius: 10px'  ></i></a>

            <div class="text-center">
                @if($user->pronouns)
                    <i class="text-center">{{ ($user->pronouns->pronouns_1 ?? '') . '/' . ($user->pronouns->pronouns_2 ?? '') }}</i>
                @else
                    <i class="text-center">Местоимение не указано.</i>
                @endif
            </div>
            @if($user->firstname || $user->surname)
                <h3 class="mt-2">{!! $user->top_full_name !!}</h3>
            @else
                <h3>Имя и фамилия не указано.</h3>
            @endif
            <p style="font-weight: 500">{{ $user->status ?? 'Вы еще не установили статус.' }}</p>

            <div class="mt-4">
                <h2>Адрес:</h2>
                <div class="mt-2">
                    <span style="font-weight: 500">{{ $user->address->location ?? 'Адрес не указан.' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <h2>Про себя:</h2>
                <div class="mt-2">
                    <p>{{ $user->bio ?? 'Вы еще не написали про себя.' }}</p>
                </div>
            </div>

            <div class="mt-4">
                <h2>Интересы</h2>

                <div class="mt-2">
                    <div class="user-hobbies">
                        @foreach($hobbies as $hobby)
                            <label style="cursor:default;">{{ $hobby->name }}</label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h2>Галерея</h2>

                <div>
                    <div class="user-gallery">
                        @forelse($user->getMedia('gallery') as $media)
                            <form method="post" action="{{ route('user.images.delete', [$user->username, $media->getAttribute('id')]) }}" class="gallery_images">
                                @csrf
                                @method('DELETE')
                                <a href="{{ $media->getUrl() }}"><img src="{{ $media->getUrl() }}" alt=""></a>
                                <button style="border: none; background-color: transparent"><i class='bx bx-x' style='color:#FFFFFF'  ></i></button>
                            </form>
                        @empty
                            <p style="width: 600px; font-weight: 500; font-size: 18px">Вы еще не добавили изображение в галерею.</p>
                        @endforelse
                    </div>
                    <form action="{{ route('user.images.store', $user->username) }}" class="mt-4 gallery-form"  method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="file" style="display: none" id="gallery_input" name="images[]" multiple>
                        <label id="gallery_label"> <i class='bx bx-image' style='color:#e94057'  ></i> Выбрать изображение</label>
                        <button class="btn btn-primary">Добавить</button>
                    </form>
                </div>
            </div>

            <div class="mt-4">
                <h2>Посты</h2>

                <div>
                    <div class="user-gallery">
                        @forelse($posts as $post)
                                <div class="mt-2">
                                    <a href="{{ $post->image }}"><img src="{{ $post->image }}" alt=""></a>
                                    <a style="font-weight: 600" href="{{ route('posts.show', $post) }}">{{ $post->body }}</a>
                                </div>
                        @empty
                            <p style="width: 600px; font-weight: 500; font-size: 18px">Вы еще не добавили изображение в галерею.</p>
                        @endforelse
                    </div>
                </div>
            </div>


            <div class="mt-4">
                <h2>Ивенты</h2>

                <div>
                    <div class="user-gallery">
                        @forelse($events as $event)
                            <div class="mt-2">
                                <a href="{{ $event->avatar }}"><img src="{{ $event->avatar }}" alt=""></a>
                                <a style="font-weight: 600" href="{{ route('events.show', $event) }}">{{ $event->name }}</a>
                            </div>
                        @empty
                            <p style="width: 600px; font-weight: 500; font-size: 18px">Вы еще не участвуете ни в каком ивенте.</p>
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

<!DOCTYPE html>
<html lang="en">
@extends('layouts.head')

<style>
    .modal {
        visibility: hidden;
        opacity: 0;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(77, 77, 77, .7);
        transition: all .4s;
    }

    .modal:target {
        visibility: visible;
        opacity: 1;
    }

    .modal__content {
        border-radius: 4px;
        position: relative;
        width: 500px;
        max-width: 90%;
        background: #fff;
        padding: 1em 2em;
    }

    .modal__footer {
        text-align: right;
        a {
            color: #585858;
        }
        i {
            color: #d02d2c;
        }
    }
    .modal__close {
        position: absolute;
        top: 10px;
        right: 10px;
        color: #585858;
        text-decoration: none;
    }
</style>

<body>
<div class="profile-image" style="
                max-width: 700px;
                margin: 0 auto;
                height: 800px;
                background-image: url({{ $event->getFirstMediaUrl('event_avatars') ?? asset('assets/images/avatar.jpg') }});
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                clear: both;
                position:relative;

         ">

    <div class="auth-header" style="position:absolute; top: 50px;">
        <div class="get-back-btn">
            <a href="javascript:history.back()"><i class='bx bx-chevron-left' style="background-color: transparent; color: #FFFFFF"></i></a>
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
            <div class="text-center">
                @if($event->users->contains(Auth::user()->id))
                <a href="#leave_event" style="float: right"><i class='bx bx-check' style='color:#e94057; font-size: 24px; padding: 10px; border: 1px solid var(--secondary-color); border-radius: 10px'></i></a>
                @else
                    <a style="float: right" href="#join_event" ><i class='bx bx-plus' style='color:#e94057; font-size: 24px; padding: 10px; border: 1px solid var(--secondary-color); border-radius: 10px'  ></i></a>
                @endif

                <i class="text-center"></i>
            </div>
            <h2 style="margin-top: 20px;">{{ $event->name}}</h2>
            <p style="font-weight: 500">{{ $event->short_desc }}</p>

           <div class="mt-2">
               <h3>Участники {{ $event->countEventMembers() . '/' . $event->members }}</h3>
           </div>

            <div class="mt-4">
                <h2>Локация</h2>
                <div class="mt-2" style="display: flex; flex-direction: column">
                    <span style="font-weight: 500">{{ $event->location ?? '' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <h2>Дата и время</h2>
                <div class="mt-2" style="display: flex; flex-direction: column; gap: 10px">
                    <span style="font-weight: 500">Дата: {{ \Carbon\Carbon::parse($event->date)->format('d.m.Y') ?? '' }}</span>
                    <span style="font-weight: 500">Время: {{ $event->time }}</span>
                </div>
            </div>

            <div class="mt-4">
                <h2>Описание</h2>
                <div class="mt-2">
                    <p>{{ $event->description }}</p>
                </div>
            </div>

            <div class="mt-4">
                <h2>Галерея</h2>

                <div>
                    <div class="user-gallery">
                        @forelse($event->getMedia('event_gallery') as $media)
                            <form method="post" action="{{ route('events.images.delete', [$event, $media->getAttribute('id')]) }}" class="gallery_images">
                                @csrf
                                @method('DELETE')
                                <a href="{{ $media->getUrl() }}"><img src="{{ $media->getUrl() }}" alt=""></a>
                                <button style="border: none; background-color: transparent"><i class='bx bx-x' style='color:#FFFFFF'  ></i></button>
                            </form>
                        @empty
                            <p style="width: 600px; font-weight: 500; font-size: 18px">Создатель еще не добавил изображение в галерею.</p>
                        @endforelse
                    </div>

                        @role('admin')
                            <form action="{{ route('events.images.store', $event) }}" class="mt-4 gallery-form"  method="post" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <input type="file" style="display: none" id="gallery_input" name="images[]" multiple>
                                <label id="gallery_label"> <i class='bx bx-image' style='color:#e94057'  ></i> Выбрать изображение</label>
                                <button class="btn btn-primary">Добавить</button>
                            </form>
                        @endrole
                    </div>
                </div>
            </div>
        </div>

    <div id="join_event" class="modal">
        <div class="modal__content">
            <h1>Вы уверены что хотите участвовать в ивенте?</h1>

            <p>
            <form style="display: flex; justify-content: center; gap: 20px; margin-top: 20px" action="{{ route('events.join', $event) }}" method="post">
                @csrf
                @method('POST')
                <button class="btn btn-primary">Да</button>
                <a href="#" class="btn btn-secondary">Нет</a>
            </form>
            </p>

            <a href="#" class="modal__close">&times;</a>
        </div>
    </div>

    <div id="leave_event" class="modal">
        <div class="modal__content">
            <h1>Вы уверены что хотите выйти с ивента?</h1>

            <p>
            <form style="display: flex; justify-content: center; gap: 20px; margin-top: 20px" action="{{ route('events.join', $event) }}" method="post">
                @csrf
                @method('POST')
                <button class="btn btn-primary">Да</button>
                <a href="#" class="btn btn-secondary">Нет</a>
            </form>
            </p>

            <a href="#" class="modal__close">&times;</a>
        </div>
    </div>

    @include('layouts.nav')

</div>
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

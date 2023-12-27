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
<div class="mobile-container">
    <div class="auth-header">
        <div class="get-back-btn">
            <h1>Матчи</h1>
            <div class="mt-2">
                <p>Это список людей, которым понравились вы и ваши совпадения.</p>
            </div>

        </div>

    </div>


    <div class="stories-wrapper auth-header mt-2">
        <h3>Истории ваших подписок:</h3>

        <div class="stories-list">
            <div class="stories-item">
                <a href="#add_status" id="auth-stories"><img style="border: 3px solid {{ Auth::user()->story ? 'var(--background-color); backdrop-filter:brightness(40%)' : 'var(--secondary-color)' }}" @if(!Auth::user()->story) id="story_upload_btn" @endif src="{{ Auth::user()->avatar }}" alt=""></a>
                <span id="story_created_date"
                      style="font-size: 14px; font-weight: 500; margin-top: 5px;">Ваша история</span>
            </div>

            @foreach($stories as $story)
                <div class="stories-item">
                    <form id="delete_story_id" style="display: none" action="{{ route('stories.delete', $story) }}" method="post">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="story_id" value="{{ $story->id }}">
                        <button type="submit" style="background-color: transparent; border: none;"><i class='bx bx-x' style="color: #FFFFFF; font-weight: bold; font-size: 35px"></i>
                        </button>
                    </form>
                    <a id="open-stories" style="cursor:pointer;"><img src="{{ $story->user->avatar }}" alt=""></a>
                    <span id="story_created_date"
                          style="font-size: 14px; font-weight: 500; margin-top: 5px;">{{ $story->user->username }}</span>

                    <script>
                        setInterval(backwardsTimer, 1000);
                        function backwardsTimer() {
                            let storyTime = '{{ $story->created_at }}';
                            let storyTimeDate = new Date(storyTime);
                            let now = new Date();
                            let difference = now - storyTimeDate;
                            let seconds = Math.floor(difference / 1000);
                            let minutes = Math.floor(seconds / 60);
                            let hours = Math.floor(minutes / 60);
                            let days = Math.floor(hours / 24);
                            hours %= 24;
                            minutes %= 60;
                            seconds %= 60;

                            if(hours == 23 && minutes == 59 && seconds == 59) {
                                document.getElementById("delete_story_id").submit();
                            }
                        }
                    </script>
                </div>


                <div id="stories-modal" class="modal">
                    <div class="modal__content">
                        <div class="stories-user">
                            <div class="story_user_avatar">
                                <img src="{{ $story->user->avatar }}" alt="">
                            </div>
                            <div class="story_user_info">
                                <span>{{ $story->user->username }} <small style="color: #fff; margin-left: 10px">{{ \Carbon\Carbon::parse($story->created_at)->diffForHumans(null, true, true, 1) }}</small></span>
                            </div>
                        </div>
                        <div class="stories-timer">
                            <div class="stories-timer__line"></div>
                        </div>
                        <img id="story-image" src="{{ $story->getFirstMediaUrl('stories') }}" alt="">
                        <input type="text" placeholder="Напишите что нибудь">
                        <div class="modal__footer">
                        </div>

                        <a href="#" class="modal__close"><i class='bx bx-x' style="font-size: 24px"></i></a>
                        </form>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <div class="auth-main">
        <div class="chat-wrapper">
            <div class="matched_users">
                @if($likes)
                    @foreach($likes as $user)
                        <div class="matched_user_wrapper">
                            <img src="{{ $user->avatar }}" alt="">
                            <div class="matched_user_info">
                                <a href="{{ route('user.show', $user->username) }}">{{ $user->fullname . ', ' . $user->age }}</a>
                            </div>
                            <div class="matched_user_actions">
                                <form action="{{ route('matches.delete', $user->username) }}" method="post"
                                      class="matched_user_action">
                                    @csrf
                                    @method('DELETE')
                                    <button style="background-color: transparent; border: none;"><i class='bx bx-x' style="color: #FFFFFF; font-weight: bold; font-size: 35px"></i>
                                    </button>
                                </form>

                                <form action="{{ route('matches.accept', $user->username) }}" method="post"
                                      class="matched_user_action" style="border: none">
                                    @csrf
                                    @method('POST')
                                    <button style="background-color: transparent; border: none;"><i class='bx bxs-heart'
                                                                                                    style="color: #FFFFFF; font-weight: bold; font-size: 30px"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    @include('layouts.nav')

</div>
<script>

    var timerDuration = 5000;

    var open_modal = document.querySelector('#open-stories');
    var modal = document.getElementById('stories-modal');
    var timerLine = document.querySelector('.stories-timer__line');
    var close_modal = document.querySelector('.modal__close');

    open_modal.addEventListener('click', function () {

        timerLine.style.animation = 'timerAnimation 5s linear';

        modal.classList.add('modal_active');

        timerLine.style.animationDuration = 4500 + 'ms';
        timerLine.style.animationPlayState = 'running';
    });


    timerLine.addEventListener('animationend', function () {
        closeModal();
    });

    function closeModal() {
        modal.classList.remove('modal_active');
        timerLine.style.animation = 'none';
        console.log(modal.classList);
        close_modal.click();
    }


    var storyUploadBtn = document.getElementById('story_upload_btn');
    var storyUploadInput = document.getElementById('story_upload_input');

    storyUploadBtn.addEventListener('click', function () {
        storyUploadInput.click();
    });

</script>

<div id="add_status" class="modal">
    <div class="modal__content">
        <h1>Дополнить историю</h1>

        <p>
        <form action="{{ route('stories.store') }}" style="display: flex; justify-content: center; margin-top: 20px; gap: 10px" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <input style="display: none" type="file" name="story" id="story_upload_input">
            <label for="story_upload_input" class="btn btn-secondary">Выбрать изображение</label>
            <button class="btn btn-primary">Добавить</button>
        </form>
        </p>

        <script>
            const storyUploadBtn = document.getElementById('story_upload_btn');
            const storyUploadInput = document.getElementById('story_upload_input');

            storyUploadBtn.addEventListener('click', () => {
                storyUploadInput.click();
            });
        </script>

        <a href="#" class="modal__close">&times;</a>
    </div>
</div>

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

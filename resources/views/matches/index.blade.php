<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/styles/global-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/auth/style.css') }}">
    <link href='{{ asset('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css') }}' rel='stylesheet'>
    <link rel="shortcut icon" href="{{ asset('assets/images/trademark.svg') }}" type="image/x-icon">
</head>
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
                <form action="{{ route('stories.store') }}" style="display: none" method="post"  enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="file" name="story" id="story_upload_input">
                    <button>Go</button>
                </form>
                <a id="auth-stories"><img style="border: 3px solid {{ Auth::user()->story ? 'var(--background-color); backdrop-filter:brightness(40%)' : 'var(--secondary-color)' }}" @if(!Auth::user()->story) id="story_upload_btn" @endif src="{{ Auth::user()->story ? Auth::user()->avatar : asset('assets/images/profile.png') }}" alt=""></a>
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
                                <span>{{ $user->fullname . ', ' . $user->age }}</span>
                            </div>
                            <div class="matched_user_actions">
                                <form action="{{ route('matches.delete', $user->username) }}" method="post"
                                      class="matched_user_action">
                                    @csrf
                                    @method('POST')
                                    <button style="background-color: transparent; border: none;"><i class='bx bx-x'
                                                                                                    style="color: #FFFFFF; font-weight: bold; font-size: 35px"></i>
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

    var open_modal = document.getElementById('open-stories');
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
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

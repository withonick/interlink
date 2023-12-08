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
            <h1>Посты</h1>
            <div class="mt-2">
                <p style="font-weight: 500">Это посты людей, которым понравились вы и ваши совпадения.</p>
            </div>
        </div>

    </div>

    <div class="auth-main">
        <div class="chat-wrapper">
            <div class="posts_list">
                        <div class="post_item">
                            <div class="post_item__header">
                                <div class="post_item__header__avatar">
                                    <img src="{{ $post->user->avatar }}" alt="">
                                </div>
                                <div class="post_item__header__info">
                                    <div class="post_item__header__info__username">
                                        <a style="display: flex; align-items: center" href="{{ route('user.show', $post->user->username) }}">{!! $post->user->top_full_name !!}</a>
                                    </div>
                                    <div class="post_item__header__info__date">
                                        {{ $post->created_at->diffForHumans(null, false, 2) }}
                                    </div>
                                </div>

                                @if($post->user->id == Auth::id() || Auth::user()->hasRole('admin'))
                                <div class="post-actions" style="display: flex; align-items: center; gap: 10px; margin-left: 10px">
                                    <div class="post-actions__item">
                                        <a href="{{ route('posts.edit', $post) }}"><i class='bx bx-edit' style='color:#e94057; font-size: 24px; padding: 10px; border: 1px solid var(--secondary-color); border-radius: 10px'  ></i></a>
                                    </div>
                                    <div class="post-actions__item">
                                        <form action="{{ route('posts.destroy', $post) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button style="background-color: transparent; border: none; margin-top: 2px; padding: 0; cursor:pointer;"><i class='bx bx-trash' style='color:#e94057; font-size: 24px; padding: 10px; border: 1px solid var(--secondary-color); border-radius: 10px'  ></i></button>
                                        </form>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="post_item__content">
                                <div class="post_item__content__text">
                                    {{ $post->body }}
                                </div>
                                @if($post->image)
                                    <div class="post_item__content__image">
                                        <a href="{{ $post->image }}"><img src="{{ $post->image }}" alt=""></a>
                                    </div>
                                @endif
                            </div>
                            <div class="post_item__footer">
                                <form class="post_item__footer__likes" action="{{ route('posts.like', $post) }}" method="post">
                                    @csrf
                                    <button style="background-color: transparent; border: none; margin-top: 2px; padding: 0"><i id="like_icon" class='bx @if($post->likedUsers()->where('user_id', Auth::id())->exists()) bxs-heart @else bx-heart @endif' style="font-size: 20px; margin: 0; cursor:pointer;"></i></button>
                                    <span style="font-weight: 500; font-size: 16px">{{ $post->likes >= 1000 ? number_format($post->likes / 1000, 1) . 'k' : $post->likes }}</span>
                                </form>
                            </div>
                        </div>
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

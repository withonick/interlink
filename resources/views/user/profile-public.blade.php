<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/styles/global-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/auth/style.css') }}">
    <link href='{{ asset('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css') }}' rel='stylesheet'>
</head>
<body>
<div class="profile-image" style="
                max-width: 700px;
                margin: 0 auto;
                height: 800px;
                background-image: url({{ $user->getFirstMediaUrl('avatars') ?? asset('assets/images/avatar.jpg') }});
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                clear: both;
                position:relative;

         ">

    <div class="auth-header" style="position:absolute; top: 50px;">
        <div class="get-back-btn">
            <a href="{{ route('home') }}"><i class='bx bx-chevron-left' style="background-color: transparent; color: #FFFFFF"></i></a>
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
                <a style="float: right" href="#" ><i class='bx bxl-telegram' style='color:#e94057; font-size: 24px; padding: 10px; border: 1px solid var(--secondary-color); border-radius: 10px'  ></i></a>

                <i class="text-center">{{ ($user->pronouns->pronouns_1 ?? '') . '/' . ($user->pronouns->pronouns_2 ?? '') }}</i>
            </div>
            <h2 style="margin-top: 20px;">{{ $user->getUserFullName() . ', ' . $user->getUserAge() }}</h2>
            <p style="font-weight: 500">{{ $user->status }}</p>

            <div class="mt-4">
                <h2>Location</h2>
                <div class="mt-2">
                    <span style="font-weight: 500">{{ $user->address->location ?? '' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <h2>About</h2>
                <div class="mt-2">
                    <p>{{ $user->bio }}</p>
                </div>
            </div>

            <div class="mt-4">
                <h2>Interests</h2>

                <div class="mt-2">
                    <div class="user-hobbies">
                        @forelse($hobbies as $hobby)
                            <label class="">{{ $hobby->name }}</label>
                        @empty
                            <p style="width: 600px; font-weight: 500; font-size: 18px">Пользователь еще не добавил интересы.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h2>Gallery</h2>

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
    <div class="nav">
        <a href="{{ route('index') }}"><i class='bx bxs-card'></i></a>
        <a href="#"><i class='bx bx-calendar-event' style='color:#adafbb'  ></i></a>
        <a href="{{ route('matches.index') }}"><i class='bx bxs-heart'></i></a>
        <a href="{{ route('chat.index') }}"><i class='bx bx-message-square-dots'></i></a>
        <a href="{{ route('user.show', Auth::user()->username) }}"><i class='bx bxs-user active'></i></a>
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

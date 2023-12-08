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
<div class="mobile-container">
    <div class="auth-header">
        <div class="get-back-btn">
            <i class='bx bx-chevron-left'></i>
        </div>
    </div>


    <form action="{{ route('user.verify.store', $user->username) }}" enctype="multipart/form-data" method="post" class="auth-main">
        @csrf
        @method('post')
        <h1>Запросить подтверждение</h1>
        <div class="choice-wrapper">
            <div class="profile_img_container">
                <img src="{{ $user->getFirstMediaUrl('avatars') }}" alt="">
            </div>

            <div class="profile_detail_info" style="display: flex; flex-direction: column; align-items: center">
                <div style="display: flex; flex-direction: column; gap: 10px">
                    <span>Ваше полное имя:</span>
                    <input type="text" placeholder="Full name" name="fullname" value="{{ $user->fullname }}">
                </div>
                <div style="display: flex; flex-direction: column; gap: 10px">
                    <span>Кем вы являетесь:</span>
                    <input type="text" placeholder="Your profession" name="profession">
                </div>
                <div style="display: flex; flex-direction: column; gap: 10px">
                    <span>Ссылка на статью про вас:</span>
                    <input type="text" name="article_link" placeholder="Article link">
                </div>
                <div style="display: flex; flex-direction: column; gap: 10px">
                    <span>Файл подтверждающий:</span>
                    <div style="display: flex">
                        <label id="file_label" style="font-size: 16px; font-weight: 500">Загрузить файл</label>
                        <input style="display: none" id="file_input" type="file" name="file" />
                    </div>

                    <script>
                        const file_label = document.getElementById('file_label');
                        const file_input = document.getElementById('file_input');

                        file_label.addEventListener('click', () => {
                            file_input.click();
                        });

                    </script>
                </div>
                <div style="display: flex; flex-direction: column; gap: 10px">
                    <span>Немного про себя:</span>
                    <textarea name="about_self" style="resize: none" cols="30" rows="10"></textarea>
                </div>

                <div class="continue">
                    <button class="btn btn-primary">Отправить</button>
                </div>

            </div>
        </div>
    </form>
</div>


<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

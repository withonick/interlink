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
            <h1>Добавить ивент</h1>
        </div>
    </div>

    <div class="auth-main">
        <div class="chat-wrapper">
            <form action="{{ route('events.store') }}" method="post" class="add_event" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="mt-2" style="display: flex; flex-direction: column">
                    <label for="name">Название:</label>
                    <input type="text" placeholder="Название ивента" name="name">
                </div>

                <div class="mt-2" style="display: flex; flex-direction: column">
                    <label for="image">Изображение:</label>
                    <input type="file" name="image" style="display: none" id="add_image_input">
                    <label id="add_image_label">Добавить изображение</label>
                </div>

                <div class="mt-2" style="display: flex; flex-direction: column">
                    <label for="price">Цена:</label>
                    <input type="number" placeholder="Цена билета" name="price">
                </div>

                <div class="mt-2" style="display: flex; flex-direction: column">
                    <label for="members">Максимум людей:</label>
                    <input type="number" placeholder="Название ивента" name="members">
                </div>

                <div class="mt-2" style="display: flex; flex-direction: column">
                    <label for="date">Дата:</label>
                    <input type="date" placeholder="Дата ивента" name="date">
                </div>

                <div class="mt-2" style="display: flex; flex-direction: column">
                    <label for="time">Время:</label>
                    <input type="time" placeholder="Время ивента" name="time">
                </div>

                <div class="mt-2" style="display: flex; flex-direction: column">
                    <label for="location">Локация:</label>
                    <input type="text" placeholder="Локация ивента" name="location">
                </div>

                <div class="mt-2" style="display: flex; flex-direction: column">
                    <label for="short_desc">Короткое описание:</label>
                    <textarea name="short_desc"></textarea>
                </div>

                <div class="mt-2" style="display: flex; flex-direction: column">
                    <label for="description">Полное описание:</label>
                    <textarea cols="15" name="description"></textarea>
                </div>

                <div class="mt-2">
                    <button class="btn btn-secondary">Добавить</button>
                </div>
            </form>
        </div>
    </div>

    @include('layouts.nav')

</div>


<script>
    const add_image_input = document.getElementById('add_image_input');
    const add_image_label = document.getElementById('add_image_label');

    add_image_label.addEventListener('click', () => {
        add_image_input.click();
    });
</script>

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

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

    <div class="auth-main">
        <h1>Contacts</h1>

        <div class="mt-4">
            <h3 style="color: var(--background-color); display: flex; align-items: center; gap: 10px; margin-bottom: 10px;"> <i class='bx bx-phone' style="color: var(--background-color)"></i> +7 778 362 7292</h3>
            <h3 style="color: var(--background-color); display: flex; align-items: center; gap: 10px; margin-bottom: 10px;"> <i class='bx bx-phone' style="color: var(--background-color)"></i> +7 778 944 4647</h3>
            <h3 style="color: var(--background-color); display: flex; align-items: center; gap: 10px; margin-bottom: 10px;"> <i class='bx bxs-business' style="color: var(--background-color)"></i> Kazakhstan, Almaty, Almaty, Taugul-1, 46</h3>
            <h3 style="color: var(--background-color); display: flex; align-items: center; gap: 10px"> <i class='bx bxs-envelope' style="color: var(--background-color)"></i> techopskz@gmail.com</h3>

            <div class="mt-2">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1028.066991481601!2d76.88108129461783!3d43.21342053244663!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x388368f04e4268ef%3A0x7153fd93eb3255bc!2sASTG!5e0!3m2!1sru!2skz!4v1700213697482!5m2!1sru!2skz" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

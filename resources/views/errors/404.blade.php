<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/styles/global-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/auth/style.css') }}">
    <link href='{{ asset('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css') }}' rel='stylesheet'>
    <script
        src="{{ asset('https://code.jquery.com/jquery-3.7.1.js') }}"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

</head>
<body>
<div class="mobile-container text-center">
    <div class="mobile-container" style="display: flex; align-items: center; justify-content: center; height: 70vh">

        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <img style="pointer-events: none" src="{{ asset('assets/images/404.svg') }}" width="300" alt="">
            <a href="{{ route('index') }}" style="font-size: 20px; color: var(--background-color); font-weight: 600">Back to home</a>
            <a href="#" style="font-size: 16px; margin-top: 10px; font-weight: 500">Report error</a>
        </div>

    </div>
</div>


<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>

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

        <div class="skip-btn">
            <a href="{{ route('user.edit', $user->username) }}">Skip</a>
        </div>
    </div>

    <div class="auth-main">
        <h1>Your interests</h1>
        <p>Select a few of your interests and let everyone know what you’re passionate about.</p>

        <form action="{{ route('register.hobbies.store') }}" method="post">
            @csrf
            @method('post')
            <div class="interest_select">
                @foreach($hobbies as $hobby)
                    <input type="checkbox" style="visibility: hidden;" id="{{ $hobby->name }}" value="{{ $hobby->id }}" name="hobbies[]">
                    <label for="{{ $hobby->name }}">{{ $hobby->name }}</label>
                @endforeach
            </div>

            <div class="continue">
                <button class="btn btn-primary">Continue</button>
            </div>
        </form>
    </div>
</div>


<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

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
            <a href="#">Skip</a>
        </div>
    </div>


    <form action="{{ route('user.update', $user->username) }}" enctype="multipart/form-data" method="post" class="auth-main">
        <h1>Profile detail</h1>
        <div class="choice-wrapper">
            @csrf
            @method('PUT')
            <div class="profile_img_container">
                <img src="{{ $user->getFirstMediaUrl('avatars') }}" alt="">
                <i id="image_btn" class='bx bxs-camera' style='color:#ffffff; '  ></i>
            </div>

            <div class="profile_detail_info">
                <input id="image_input" name="image" type="file" style="display: none;">
                <input type="text" placeholder="First name" name="firstname" value="{{ Auth::user()->firstname }}">
                <input type="text" placeholder="Last name" name="surname" value="{{ Auth::user()->surname }}">
                <input type="date" onkeypress="return false" name="birthday" value="{{ Auth::user()->birthday }}">
            </div>
        </div>

        <div class="continue">
            <button class="btn btn-primary">Confirm</button>
        </div>
    </form>
</div>


<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

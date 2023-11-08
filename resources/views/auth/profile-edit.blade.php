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

        <h1>Profile detail</h1>
    <form action="{{ route('user.update') }}" method="post" class="auth-main">
        <div class="choice-wrapper">
            @csrf
            @method('PUT')
            <div class="profile_img_container">
                <img src="{{ asset('assets/images/profile.png') }}" alt="">
                <i id="image_btn" class='bx bxs-camera' style='color:#ffffff; '  ></i>
                <input id="image_input" type="file" style="display: none;">
            </div>

            <div class="profile_detail_info">
                <input type="text" placeholder="First name" name="firstname" value="{{ Auth::user()->firstname }}">
                <input type="text" placeholder="Last name" name="surname" value="{{ Auth::user()->surname }}">
                <input type="date" onkeypress="return false" name="birthdate" value="{{ Auth::user()->birthdate }}">
            </div>
        </div>

        <div class="continue">
            <button class="btn btn-primary">Confirm</button>
        </div>
    </form>
</div>


<script src="../js/script.js"></script>
</body>
</html>

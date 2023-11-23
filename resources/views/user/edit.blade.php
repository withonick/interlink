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
            <a href="{{ route('user.show', $user->username) }}">Skip</a>
        </div>
    </div>


    <form action="{{ route('user.update', $user->username) }}" enctype="multipart/form-data" method="post" class="auth-main">
        <h1>Profile detail</h1>
        <div class="choice-wrapper">
            @csrf
            @method('PUT')
            <div class="profile_img_container">
                <img src="{{ $user->getFirstMediaUrl('avatars') ?? asset('assets/images/avatar.jpg') }}" alt="">
                <i id="image_btn" class='bx bxs-camera' style='color:#ffffff; '  ></i>
            </div>

            <div class="profile_detail_info" style="display: flex; flex-direction: column; align-items: center">
                <input id="image_input" name="image" type="file" style="display: none;">

                <div style="display: flex; flex-direction: column; gap: 10px">
                    <span>Firstname:</span>
                    <input type="text" placeholder="First name" name="firstname" value="{{ Auth::user()->firstname }}">
                </div>
                <div style="display: flex; flex-direction: column; gap: 10px">
                    <span>Surname:</span>
                    <input type="text" placeholder="Last name" name="surname" value="{{ Auth::user()->surname }}">
                </div>
                <div style="display: flex; flex-direction: column; gap: 10px">
                    <span>Birthdate:</span>
                    <input type="date" onkeypress="return false" name="birthday" value="{{ Auth::user()->birthday }}">
                </div>
                <div style="display: flex; flex-direction: column; gap: 10px">
                    <span>Status:</span>
                    <input type="text" placeholder="Set profile status" name="status" value="{{ Auth::user()->status }}">
                </div>
                <div style="display: flex; flex-direction: column; gap: 10px">
                    <span>Pronouns:</span>
                    <div style="display: flex">
                        <input type="text" name="pronouns_1" style="width: 150px" value="{{ Auth::user()->pronouns->pronouns_1 ?? '' }}">
                        <input type="text" name="pronouns_2" style="width: 150px" value="{{ Auth::user()->pronouns->pronouns_2 ?? '' }}">
                    </div>
                </div>
                <div style="display: flex; flex-direction: column; gap: 10px">
                    <span>About:</span>
                    <textarea name="bio" style="resize: none" cols="30" rows="10">
                        {{ Auth::user()->bio }}
                    </textarea>
                </div>
                <div style="display: flex; flex-direction: column; gap: 10px">
                    <span>Address:</span>
                    <select name="country">
                        @foreach($countries as $country)
                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                    <input type="text" placeholder="City" name="city" value="{{ Auth::user()->address->city ?? '' }}">
                    <input type="text" placeholder="Street" name="street" value="{{ Auth::user()->address->street ?? '' }}">
                    <input type="number" placeholder="Zip" name="zip" value="{{ Auth::user()->address->zip ?? '' }}">

                </div>

                <div class="continue">
                    <button class="btn btn-primary">Сохранить</button>
                </div>


            </div>
        </div>
    </form>

    <div style="display: flex; justify-content: center">
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-primary">Выйти с аккаунта</button>
        </form>
    </div>
</div>


<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

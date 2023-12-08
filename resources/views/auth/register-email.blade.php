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

        </div>
    </div>

    <div class="auth-main">
        <h1>Email</h1>
        <p>Please enter your valid email. We will send you a link to verify your account. </p>

        <form action="{{ route('register.email.store') }}" method="post">
            @csrf
            @method('post')
            <div class="choice-wrapper">
                <div class="number-input" style="margin-bottom: 20px">
                    <i class='bx bxs-user'></i><input type="text" placeholder="Username" name="username">
                </div>
                <div class="number-input" style="margin-bottom: 20px">
                    <i class='bx bxs-envelope'></i><input type="email" placeholder="Email address" name="email">
                </div>
                <div class="number-input">
                    <i class='bx bxs-key' ></i><input type="password" placeholder="Password" name="password">
                </div>

                <div class="google-auth text-center continue mt-2" style="padding: 0; margin-top: 20px">
                    <a href="{{ route('google_page') }}" class="btn" style="border: 1px solid var(--secondary-color); display: flex; align-items: center; gap: 10px; width: 400px;"><i class='bx bxl-google' style='color:#e94057; font-size: 24px'  ></i> Sign up with Google</a>
                </div>
            </div>

            <div class="continue">
                <button type="submit" class="btn btn-primary">Continue</button>
            </div>
        </form>
    </div>
</div>


<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

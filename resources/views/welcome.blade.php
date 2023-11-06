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
<div class="mobile-container text-center" style="margin-top: 70px">
    <div class="logo-wrapper">
        <img src="{{ asset('assets/images/trademark.svg') }}" alt="">
    </div>

    <div class="auth-wrapper">
        <h3>Sign up to continue</h3>

        <div class="form-group">
            <a href="/login-email" id="with_email" class="btn btn-primary">Continue with email</a>
        </div>

        <div class="form-group">
            <a id="with_number" class="btn btn-secondary">Use phone number</a>
        </div>

        <div class="form-group">
            <span>Or sign up with</span>
        </div>

        <div class="social-icons">
            <a href="#"><i class='bx bxl-facebook-square' style='color:#e94057'  ></i></a>
            <a href="#"><i class='bx bxl-google' style='color:#e94057' ></i></a>
            <a href="#"><i class='bx bxl-apple' style='color:#e94057' ></i></a>
        </div>


        <div class="politic-links">
            <a href="#">Terms of use</a>
            <a href="#">Privacy Policy</a>
        </div>
    </div>

    <form action="{{ route('logout') }}" method="post">
        @csrf
        @method('post')
        <button>Logout</button>
    </form>

</div>




<script src="../js/script.js"></script>


</body>
</html>

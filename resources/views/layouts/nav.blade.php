<div class="nav">
    <span id="burger_nav"><i class='bx bx-menu' ></i></span>
    <a href="{{ route('index') }}"><i class='bx bxs-card {{ Request::is('/') ? 'active' : '' }}'></i></a>
    <a href="{{ route('events.index') }}"><i class='bx bx-calendar-event {{ request()->is('events*') ? 'active' : '' }}' style='color:#adafbb'  ></i></a>
    <a href="{{ route('posts.index') }}"><i class='bx bx-hash {{ request()->is('posts*') ? 'active' : '' }}'></i></a>
    <a href="{{ route('matches.index') }}"><i class='bx bxs-heart {{ request()->is('matches*') ? 'active' : '' }}'></i></a>
    <a href="{{ route('chat.index') }}"><i class='bx bx-message-square-dots {{ request()->is('chat*') ? 'active' : '' }}'></i></a>
    <a href="{{ route('user.show', Auth::user()->username) }}"><i class='bx bxs-user {{ request()->is('profile*') ? 'active' : '' }}'></i></a>
</div>


<div class="mobile_nav">
    <a href="{{ route('index') }}">Главная</a>
    <a href="{{ route('events.index') }}">Ивенты</a>
    <a href="{{ route('posts.index') }}">Посты</a>
    <a href="{{ route('matches.index') }}">Матчи</a>
    <a href="{{ route('chat.index') }}">Чаты</a>
    <a href="{{ route('user.show', Auth::user()->username) }}">Профиль</a>
</div>


<script>
    var burger_nav = document.getElementById('burger_nav');

    burger_nav.addEventListener('click', function(){
        var mobile_nav = document.querySelector('.mobile_nav');
        mobile_nav.classList.toggle('active');
    })
</script>

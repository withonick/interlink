<div class="nav">
    <a href="{{ route('index') }}"><i class='bx bxs-card {{ Request::is('/') ? 'active' : '' }}'></i></a>
    <a href="{{ route('events.index') }}"><i class='bx bx-calendar-event {{ request()->is('events*') ? 'active' : '' }}' style='color:#adafbb'  ></i></a>
    <a href="{{ route('posts.index') }}"><i class='bx bx-hash {{ request()->is('posts*') ? 'active' : '' }}'></i></a>
    <a href="{{ route('matches.index') }}"><i class='bx bxs-heart {{ request()->is('matches*') ? 'active' : '' }}'></i></a>
    <a href="{{ route('chat.index') }}"><i class='bx bx-message-square-dots {{ request()->is('chat*') ? 'active' : '' }}'></i></a>
    <a href="{{ route('user.show', Auth::user()->username) }}"><i class='bx bxs-user {{ request()->is('profile*') ? 'active' : '' }}'></i></a>
</div>

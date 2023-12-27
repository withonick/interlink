<!DOCTYPE html>
<html lang="en">
@extends('layouts.head')

<body>
<div class="mobile-container">
    <div class="auth-header">
        <div class="get-back-btn">
            <h1>Сообщении</h1>
        </div>
    </div>

    <div class="auth-main">
        <div class="chat-wrapper">
            <h4>Поселдние сообщении</h4>

            <div class="message-list">
                @forelse($usersWithLastMessages as $user)
                    @php
                        $user = $user['user'];
                    @endphp
                    @if ($user->id !== auth()->id())
                    <a href="{{ route('chat.show', $user->username) }}">
                        <div class="message-bar">
                            <div class="message_user_image">
                                <div class="img">
                                    <img src="{{ $user->avatar }}" alt="">
                                </div>
                            </div>
                            <div class="message_text">
                                <div class="message_user">
                                    <span style="display: flex; align-items: center; font-size: 18px">{!! $user->top_full_name !!}</span>

                                    @if ($user->latestMessageWithUser($user->id))
                                    <p>{{ Str::limit($user->latestMessageWithUser($user->id)->message, 55) }}</p>
                                    @endif
                                </div>

                                <div class="message_detail">
                                    <span>{{ \Carbon\Carbon::parse($user->latestMessageWithUser($user->id)->created_at)->format('g:i A') }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endif
                @empty
                    <p style="font-size: 20px; font-weight: 500">Еще нет сообщений.</p>
                @endforelse
            </div>
        </div>
    </div>

    @include('layouts.nav')

</div>






<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

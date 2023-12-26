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
                @forelse($chatList as $chat)
                    <a href="{{ route('chat.show', $chat['user']->username) }}">
                        <div class="message-bar">
                            <div class="message_user_image">
                                <div class="img">
                                    <img src="{{ $chat['user']->avatar }}" alt="">
                                </div>
                            </div>
                            <div class="message_text">
                                <div class="message_user">
                                    <span style="display: flex; align-items: center; font-size: 18px">{!! $chat['user']->top_full_name !!}</span>

                                    @if($chat)
                                        <p>{{ Str::limit($chat['last_message']->message, 55) }}</p>
                                    @endif
                                </div>

                                <div class="message_detail">
                                    <span>{{ \Carbon\Carbon::parse($chat['last_message']->created_at)->format('g:i A') }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
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

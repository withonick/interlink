<!DOCTYPE html>
<html lang="en">
@extends('layouts.head')

<body>
<div class="mobile-container">
    <div class="auth-header" style="display: flex; flex-direction: column">
        <div class="get-back-btn">
            <h1>Ивенты</h1>
            <div class="mt-2">
                <p>Это список мероприятии, которые подходят вам.</p>
            </div>
        </div>
        <div class="mt-2 event_search">
            <input type="text" name="search" placeholder="Название или тег">
            <button style="border: none; margin: 0; padding: 0"><i class='bx bx-search'></i></button>
        </div>
    </div>

    <div class="auth-main">
        <div class="chat-wrapper">
            @role('admin')
            <a href="{{ route("events.create") }}" class="btn btn-secondary">Добавить</a>
            @endrole
            <div class="matched_users mt-4">
                @if($events)
                    @foreach($events as $event)
                        <div class="matched_user_wrapper" >
                            <img src="{{ $event->avatar }}" alt="">
                            <div class="matched_user_actions" style="display: flex; justify-content: space-between; align-items: center">
                                <a href="{{ route('events.show', $event) }}" style="color: #fff; font-size: 20px; font-weight: bold; margin: 0 10px;">{{ $event->name }}</a>
                                <small style="margin: 15px; color: #fff; font-weight: bold">{{ $event->countEventMembers() . '/' . $event->members }}</small>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    @include('layouts.nav')

</div>



<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

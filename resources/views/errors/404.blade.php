<!DOCTYPE html>
<html lang="en">
@extends('layouts.head')

<body>
<div class="mobile-container text-center">
    <div class="mobile-container" style="display: flex; align-items: center; justify-content: center; height: 70vh">

        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <img style="pointer-events: none" src="{{ asset('assets/images/404.svg') }}" width="300" alt="">
            <a href="{{ route('index') }}" style="font-size: 20px; color: var(--background-color); font-weight: 600">Back to home</a>
            <a href="#" style="font-size: 16px; margin-top: 10px; font-weight: 500">Report error</a>
        </div>

    </div>
</div>


<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>

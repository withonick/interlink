<!DOCTYPE html>
<html lang="en">
@extends('layouts.head')

<body>
<div class="mobile-container">
    <div class="auth-header">
        <div class="get-back-btn">
            <h1>Редактировать пост</h1>
        </div>

    </div>

    <div class="auth-main">
        <div class="chat-wrapper">
            <div class="posts_list">
                <form action="{{ route('posts.update', $post) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <textarea name="body" class="form-control" rows="10" style="width: 100%">{{ $post->body }}</textarea>
                    <label id="post_image_btn_label" class="mt-2">Добавить изображение</label>
                    <input style="display: none" type="file" name="image" id="post_upload_input">
                    <div class="mt-4 text-center">
                        <button class="btn btn-primary" type="submit">Обновить пост</button>
                    </div>

                    <script>
                        const post_image_btn = document.getElementById('post_upload_input');
                        const post_image_btn_label = document.getElementById('post_image_btn_label');

                        post_image_btn_label.addEventListener('click', () => {
                            post_image_btn.click();
                        });
                    </script>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.nav')

</div>

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

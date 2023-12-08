<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(){
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index', compact('posts') );
    }

    public function create(){
        return view('posts.create');
    }

    public function show(Post $post){
        return view('posts.show', compact('post'));
    }

    public function store(PostRequest $request){
        $post = Auth::user()->posts()->create($request->validated(), ['likes' => 0]);


        if ($request->has('image')){
            $post->addMediaFromRequest('image')->toMediaCollection('post_images');
        }

        return redirect()->route('posts.index');
    }

    public function like(Post $post){

        if($post->likedUsers()->where('user_id', Auth::id())->exists()){
            $post->likedUsers()->detach(Auth::id());
            $post->decrement('likes');
        }

        else{
            Auth::user()->likedPosts()->attach($post->id);
            $post->increment('likes');
        }

        return back();
    }

    public function edit(Post $post){
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post){
        $validated = $request->validate([
            'body' => 'required|string|max:255',
        ]);

        if ($request->image){
            $post->clearMediaCollection('post_images');
            $post->addMediaFromRequest('image')->toMediaCollection('post_images');
        }

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect()->route('posts.index');
    }
}

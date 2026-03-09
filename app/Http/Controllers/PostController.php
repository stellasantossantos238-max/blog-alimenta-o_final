<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')->where('publicado', true)->where('tipo', 'normal')->latest()->paginate(6);
        return view('posts.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::with(['author', 'comments.user'])->where('slug', $slug)->firstOrFail();
        return view('posts.show', compact('post'));
    }

    public function ai()
    {
        $posts = Post::where('tipo', 'ai')->where('publicado', true)->latest()->get();
        return view('posts.ai', compact('posts'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\FoodCategory;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')->where('publicado', true)->latest()->take(6)->get();
        $aiPost = Post::where('tipo', 'ai')->where('publicado', true)->latest()->first();
        $categories = FoodCategory::all();
        return view('home', compact('posts', 'aiPost', 'categories'));
    }
}

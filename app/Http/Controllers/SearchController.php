<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Food;
use App\Models\Author;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q', '');

        $posts = Post::with('author')
            ->where('publicado', true)
            ->where(function ($q) use ($query) {
                $q->where('titulo', 'like', "%{$query}%")
                    ->orWhere('resumo', 'like', "%{$query}%");
            })
            ->take(5)->get();

        $foods = Food::with('category')
            ->where('nome', 'like', "%{$query}%")
            ->take(5)->get();

        $authors = Author::where('nome', 'like', "%{$query}%")
            ->take(3)->get();

        return view('search', compact('query', 'posts', 'foods', 'authors'));
    }

    public function suggestions(Request $request)
    {
        $query = $request->get('q', '');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $results = [];

        // Alimentos
        $foods = Food::with('category')
            ->where('nome', 'like', "%{$query}%")
            ->take(4)->get();

        foreach ($foods as $food) {
            $results[] = [
                'type' => 'food',
                'icon' => $food->category->icone,
                'label' => $food->nome,
                'sublabel' => $food->category->nome,
                'url' => route('foods.show', $food->id),
            ];
        }

        // Autores
        $authors = Author::where('nome', 'like', "%{$query}%")
            ->take(3)->get();

        foreach ($authors as $author) {
            $results[] = [
                'type' => 'author',
                'icon' => '👤',
                'label' => $author->nome,
                'sublabel' => $author->especialidade,
                'url' => route('posts.index') . '?autor=' . $author->id,
            ];
        }

        // Posts
        $posts = Post::where('publicado', true)
            ->where('titulo', 'like', "%{$query}%")
            ->take(3)->get();

        foreach ($posts as $post) {
            $results[] = [
                'type' => 'post',
                'icon' => $post->tipo === 'ai' ? '🤖' : ($post->tipo === 'oms' ? '🏥' : '📝'),
                'label' => $post->titulo,
                'sublabel' => 'Artigo',
                'url' => route('posts.show', $post->slug),
            ];
        }

        return response()->json($results);
    }
}

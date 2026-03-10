<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $tipo  = $request->query('tipo');
        $posts = Post::publicados()
            ->when($tipo, fn($q) => $q->doTipo($tipo))
            ->with('author')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('posts.index', compact('posts', 'tipo'));
    }

    public function show(Post $post)
    {
        abort_unless($post->publicado, 404);
        $relacionados = Post::publicados()
            ->where('tipo', $post->tipo)
            ->where('id', '!=', $post->id)
            ->latest()->take(3)->get();

        return view('posts.show', compact('post', 'relacionados'));
    }

    public function create()
    {
        $this->authorize('create', Post::class);
        $tipos = Post::TIPOS;
        return view('posts.create', compact('tipos'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Post::class);
        $validated = $request->validate([
            'titulo'    => 'required|string|max:255',
            'resumo'    => 'nullable|string|max:500',
            'conteudo'  => 'required|string',
            'tipo'      => 'required|in:noticia,sugestao,alimentacao_saudavel',
            'imagem'    => 'nullable|image|max:2048',
            'publicado' => 'boolean',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['titulo']) . '-' . time();

        if ($request->hasFile('imagem')) {
            $validated['imagem'] = $request->file('imagem')->store('posts', 'public');
        }

        Post::create($validated);
        return redirect()->route('posts.index')->with('success', 'Post publicado com sucesso!');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $tipos = Post::TIPOS;
        return view('posts.edit', compact('post', 'tipos'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $validated = $request->validate([
            'titulo'    => 'required|string|max:255',
            'resumo'    => 'nullable|string|max:500',
            'conteudo'  => 'required|string',
            'tipo'      => 'required|in:noticia,sugestao,alimentacao_saudavel',
            'imagem'    => 'nullable|image|max:2048',
            'publicado' => 'boolean',
        ]);

        if ($request->hasFile('imagem')) {
            $validated['imagem'] = $request->file('imagem')->store('posts', 'public');
        }

        $post->update($validated);
        return redirect()->route('posts.show', $post->slug)->with('success', 'Post atualizado!');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post eliminado.');
    }

    public function ai()
    {
        return view('posts.ai');
    }
}

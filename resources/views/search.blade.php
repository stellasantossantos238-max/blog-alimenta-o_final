@extends('layouts.app')
@section('title', 'Pesquisa')
@section('content')

<div class="container section">
    <div style="max-width:700px;margin:0 auto">
        <h1 class="section-title" style="margin-bottom:2rem">
            <span class="green-dot"></span>Resultados para "{{ $query }}"
        </h1>

        <!-- Barra de pesquisa -->
        <form method="GET" action="{{ route('search') }}" style="margin-bottom:3rem">
            <div style="display:flex;gap:0.75rem">
                <input type="text" name="q" value="{{ $query }}" class="form-control" placeholder="Pesquisar alimentos, artigos, autores..." style="flex:1;padding-left:1rem">
                <button type="submit" class="btn btn-primary" style="flex-shrink:0">
                    <i class="fas fa-search"></i> Pesquisar
                </button>
            </div>
        </form>

        @if($posts->isNotEmpty())
        <div style="margin-bottom:2.5rem">
            <h3 style="margin-bottom:1rem;color:#81c784;font-size:1rem"><i class="fas fa-newspaper"></i> Artigos ({{ $posts->count() }})</h3>
            @foreach($posts as $post)
            <a href="{{ route('posts.show', $post->slug) }}" style="text-decoration:none">
                <div class="glass-card" style="padding:1.25rem;margin-bottom:0.75rem;display:flex;gap:1rem;align-items:center">
                    <span style="font-size:1.5rem">{{ $post->tipo === 'ai' ? '🤖' : '📝' }}</span>
                    <div>
                        <div style="font-weight:600;color:#e8f5e9;margin-bottom:0.25rem">{{ $post->titulo }}</div>
                        <div style="font-size:0.85rem;color:rgba(232,245,233,0.5)">{{ Str::limit($post->resumo, 80) }}</div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @endif

        @if($foods->isNotEmpty())
        <div style="margin-bottom:2.5rem">
            <h3 style="margin-bottom:1rem;color:#81c784;font-size:1rem"><i class="fas fa-apple-alt"></i> Alimentos ({{ $foods->count() }})</h3>
            @foreach($foods as $food)
            <a href="{{ route('foods.show', $food->id) }}" style="text-decoration:none">
                <div class="glass-card" style="padding:1.25rem;margin-bottom:0.75rem;display:flex;gap:1rem;align-items:center;justify-content:space-between">
                    <div style="display:flex;gap:1rem;align-items:center">
                        <span style="font-size:1.5rem">{{ $food->category->icone }}</span>
                        <div>
                            <div style="font-weight:600;color:#e8f5e9">{{ $food->nome }}</div>
                            <div style="font-size:0.85rem;color:rgba(232,245,233,0.5)">{{ $food->category->nome }}</div>
                        </div>
                    </div>
                    <span class="badge badge-green">{{ $food->calorias_por_100g }} kcal</span>
                </div>
            </a>
            @endforeach
        </div>
        @endif

        @if($authors->isNotEmpty())
        <div style="margin-bottom:2.5rem">
            <h3 style="margin-bottom:1rem;color:#81c784;font-size:1rem"><i class="fas fa-user"></i> Autores ({{ $authors->count() }})</h3>
            @foreach($authors as $author)
            <div class="glass-card" style="padding:1.25rem;margin-bottom:0.75rem;display:flex;gap:1rem;align-items:center">
                <div style="width:40px;height:40px;background:linear-gradient(135deg,#4caf50,#2e7d32);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0">
                    {{ strtoupper(substr($author->nome, 0, 1)) }}
                </div>
                <div>
                    <div style="font-weight:600;color:#e8f5e9">{{ $author->nome }}</div>
                    <div style="font-size:0.85rem;color:rgba(232,245,233,0.5)">{{ $author->especialidade }}</div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($posts->isEmpty() && $foods->isEmpty() && $authors->isEmpty())
        <div class="glass" style="padding:4rem;text-align:center">
            <div style="font-size:4rem;margin-bottom:1rem">🔍</div>
            <h3 style="margin-bottom:0.5rem">Sem resultados</h3>
            <p style="color:rgba(232,245,233,0.4)">Tente pesquisar por outro termo.</p>
        </div>
        @endif
    </div>
</div>
@endsection

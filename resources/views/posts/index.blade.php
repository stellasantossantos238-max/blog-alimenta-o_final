@extends('layouts.app')
@section('title', 'Blog')
@section('content')

<div class="container section">
    <div style="margin-bottom:2.5rem">
        <h1 class="section-title"><span class="green-dot"></span>Blog NutriSaúde</h1>
        <p class="section-subtitle">Artigos sobre alimentação saudável escritos por especialistas</p>
    </div>

    <div class="grid-3">
        @foreach($posts as $post)
        <div class="glass-card post-card">
            @if($post->imagem)
                <img src="{{ $post->imagem }}" alt="{{ $post->titulo }}" style="width:100%;height:180px;object-fit:cover;border-radius:8px;margin-bottom:1rem">
            @else
                <div class="img-placeholder">
                    {{ $post->tipo === 'ai' ? '🤖' : ($post->tipo === 'oms' ? '🏥' : '🥗') }}
                </div>
            @endif
            <span class="tag tag-{{ $post->tipo }}">
                {{ $post->tipo === 'ai' ? '✨ IA' : ($post->tipo === 'oms' ? '🏥 OMS' : '📝 Artigo') }}
            </span>
            <h3>{{ $post->titulo }}</h3>
            <p>{{ Str::limit($post->resumo, 110) }}</p>
            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:auto">
                <div>
                    <div class="author">✍️ {{ $post->author?->nome ?? 'IA NutriSaúde' }}</div>
                    <div style="font-size:0.75rem;color:rgba(232,245,233,0.3);margin-top:2px">{{ $post->created_at->format('d/m/Y') }}</div>
                </div>
                <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-outline" style="padding:0.4rem 0.8rem;font-size:0.8rem">Ler</a>
            </div>
        </div>
        @endforeach
    </div>

    <div style="margin-top:2rem">{{ $posts->links() }}</div>
</div>
@endsection

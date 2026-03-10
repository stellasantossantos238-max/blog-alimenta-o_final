@extends('layouts.app')
@section('title', 'Blog')
@section('content')

<div class="container section">

    {{-- ── CABEÇALHO ─────────────────────────────────────────────── --}}
    <div style="text-align:center;margin-bottom:2.5rem">
        <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;color:#fff;
                   text-shadow:0 2px 12px rgba(0,0,0,0.4);margin-bottom:0.5rem">
            <span class="green-dot"></span>Blog Eco-Sustentável
        </h1>
        <p style="color:rgba(255,255,255,0.8);font-size:0.95rem">
            Artigos sobre alimentação saudável escritos por especialistas
        </p>
    </div>

    {{-- ── FILTROS CENTRADOS ──────────────────────────────────────── --}}
    <div style="display:flex;justify-content:center;flex-wrap:wrap;gap:0.5rem;margin-bottom:2.5rem">
        <a href="{{ route('posts.index') }}"
           class="filter-btn all {{ !request('tipo') ? 'active' : '' }}">
            🌿 Todos
        </a>
        <a href="{{ route('posts.index', ['tipo' => 'noticia']) }}"
           class="filter-btn noticia {{ request('tipo') === 'noticia' ? 'active' : '' }}">
            📰 Notícias
        </a>
        <a href="{{ route('posts.index', ['tipo' => 'sugestao']) }}"
           class="filter-btn sugestao {{ request('tipo') === 'sugestao' ? 'active' : '' }}">
            💡 Sugestões
        </a>
        <a href="{{ route('posts.index', ['tipo' => 'alimentacao_saudavel']) }}"
           class="filter-btn alimentacao_saudavel {{ request('tipo') === 'alimentacao_saudavel' ? 'active' : '' }}">
            🥗 Alimentação Saudável
        </a>
    </div>

    {{-- ── GRID DE CARDS ──────────────────────────────────────────── --}}
    @if($posts->isEmpty())
        <div class="card" style="padding:3rem;text-align:center">
            <div style="font-size:3rem;margin-bottom:1rem">🔍</div>
            <p style="color:#888;font-size:0.95rem">Nenhum artigo encontrado nesta categoria.</p>
            <a href="{{ route('posts.index') }}" class="btn btn-outline" style="margin-top:1rem">
                Ver todos os artigos
            </a>
        </div>
    @else
    <div class="grid-3">
        @foreach($posts as $post)
        <div class="card" style="padding:0;overflow:hidden;display:flex;flex-direction:column">

            {{-- Imagem ou placeholder --}}
            @if($post->imagem)
                <img src="{{ $post->imagem }}" alt="{{ $post->titulo }}"
                     style="width:100%;height:190px;object-fit:cover;display:block;flex-shrink:0">
            @else
                <div style="width:100%;height:190px;display:flex;align-items:center;
                            justify-content:center;font-size:3.5rem;flex-shrink:0;
                            background:linear-gradient(135deg,
                                {{ $post->tipo === 'noticia' ? '#e8f5e9,#c8e6c9' : ($post->tipo === 'sugestao' ? '#e3f2fd,#bbdefb' : '#fff3e0,#ffe0b2') }})">
                    {{ $post->tipo === 'noticia' ? '📰' : ($post->tipo === 'sugestao' ? '💡' : '🥗') }}
                </div>
            @endif

            {{-- Badge de categoria — colado à imagem --}}
            <div style="padding:0.9rem 1.25rem 0;margin-top:-1px">
                @php
                    $cores = [
                        'noticia'              => ['bg'=>'#2e7d32','label'=>'📰 Notícia'],
                        'sugestao'             => ['bg'=>'#1565c0','label'=>'💡 Sugestão'],
                        'alimentacao_saudavel' => ['bg'=>'#e65100','label'=>'🥗 Alimentação Saudável'],
                    ];
                    $c = $cores[$post->tipo] ?? ['bg'=>'#555','label'=>$post->tipo];
                @endphp
                <span style="display:inline-block;background:{{ $c['bg'] }};color:#fff;
                             font-size:0.68rem;font-weight:700;letter-spacing:0.06em;
                             text-transform:uppercase;padding:0.25rem 0.75rem;border-radius:4px">
                    {{ $c['label'] }}
                </span>
            </div>

            {{-- Conteúdo --}}
            <div style="padding:0.85rem 1.25rem 1.25rem;display:flex;flex-direction:column;flex:1">
                <h3 style="font-size:1rem;font-weight:700;color:#1a1a1a;line-height:1.45;
                           margin-bottom:0.55rem">
                    {{ $post->titulo }}
                </h3>
                <p style="font-size:0.86rem;color:#555;line-height:1.65;margin-bottom:1rem;flex:1">
                    {{ Str::limit($post->resumo, 110) }}
                </p>

                {{-- Rodapé do card --}}
                <div style="display:flex;justify-content:space-between;align-items:center;
                            border-top:1px solid #f0f0f0;padding-top:0.85rem;margin-top:auto">
                    <div>
                        <div style="font-size:0.72rem;color:#aaa;margin-top:2px">
                            {{ $post->created_at->format('d/m/Y') }}
                        </div>
                    </div>
                    <a href="{{ route('posts.show', $post->slug) }}"
                       class="btn btn-outline"
                       style="padding:0.38rem 0.9rem;font-size:0.8rem">
                        Ler <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Paginação --}}
    <div style="margin-top:2.5rem;display:flex;justify-content:center">
        {{ $posts->appends(request()->query())->links() }}
    </div>
    @endif

</div>
@endsection

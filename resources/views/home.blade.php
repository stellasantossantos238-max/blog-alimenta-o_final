@extends('layouts.app')
@section('title', 'Início')
@section('content')

{{-- ══════════════════════════════════════════
     HERO — só texto, sem vídeo nem imagem
══════════════════════════════════════════ --}}
<div style="padding:5rem 2rem 4rem;text-align:center">
    <div class="container">

        <div style="display:inline-flex;align-items:center;gap:8px;padding:0.4rem 1.1rem;
                    background:rgba(255,255,255,0.85);border:1.5px solid rgba(76,175,80,0.35);
                    border-radius:20px;font-size:0.84rem;color:#2e7d32;margin-bottom:1.5rem;
                    backdrop-filter:blur(8px);font-weight:500">
            <span style="width:8px;height:8px;background:#4caf50;border-radius:50%;display:inline-block"></span>
            Baseado nas recomendações da OMS
        </div>

        <h1 style="font-size:clamp(2rem,5vw,3.2rem);font-weight:700;line-height:1.25;
                   margin-bottom:1.5rem;color:#fff;
                   text-shadow:0 2px 16px rgba(0,0,0,0.5)">
            A sua jornada para uma<br>
            <span style="background:linear-gradient(135deg,#4caf50,#8bc34a);
                         -webkit-background-clip:text;-webkit-text-fill-color:transparent">
                alimentação saudável
            </span><br>
            começa aqui
        </h1>

        <p style="font-size:1.05rem;color:rgba(255,255,255,0.9);max-width:560px;
                  margin:0 auto 2rem;text-shadow:0 1px 8px rgba(0,0,0,0.4)">
            Descubra receitas, aprenda sobre nutrição e acompanhe os seus hábitos
            alimentares com inteligência artificial.
        </p>

        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
            <a href="{{ route('register') }}" class="btn btn-primary">
                <i class="fas fa-leaf"></i> Começar Agora
            </a>
            <a href="{{ route('posts.index') }}" class="btn"
               style="background:rgba(255,255,255,0.92);color:#2e7d32;font-weight:600;
                      backdrop-filter:blur(8px);border:none">
                <i class="fas fa-book-open"></i> Explorar Blog
            </a>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════
     STATS
══════════════════════════════════════════ --}}
<div class="container">
    <div class="grid-4" style="margin-bottom:3rem">
        <div class="card stat-card">
            <div class="stat-number">400g</div>
            <div class="stat-label">Hortícolas recomendados/dia</div>
        </div>
        <div class="card stat-card">
            <div class="stat-number">300g</div>
            <div class="stat-label">Fruta recomendada/dia</div>
        </div>
        <div class="card stat-card">
            <div class="stat-number">8</div>
            <div class="stat-label">Categorias alimentares</div>
        </div>
        <div class="card stat-card">
            <div class="stat-number">100%</div>
            <div class="stat-label">Baseado na ciência OMS</div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════
         ARTIGOS RECENTES
    ══════════════════════════════════════════ --}}
    <div class="section">
        <div style="display:flex;justify-content:space-between;align-items:center;
                    margin-bottom:2rem;flex-wrap:wrap;gap:1rem">
            <div>
                <h2 style="font-size:1.6rem;font-weight:700;color:#fff;
                           text-shadow:0 1px 8px rgba(0,0,0,0.4);margin-bottom:0.25rem">
                    <span class="green-dot"></span>Artigos Recentes
                </h2>
                <p style="color:rgba(255,255,255,0.75);font-size:0.9rem">
                    Os últimos artigos sobre alimentação saudável
                </p>
            </div>
            <a href="{{ route('posts.index') }}" class="btn"
               style="background:rgba(255,255,255,0.92);color:#2e7d32;font-weight:600;border:none">
                Ver todos <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="grid-3">
            @foreach($posts as $post)
            <div class="card" style="padding:0;overflow:hidden">
                @if($post->imagem)
                    <img src="{{ $post->imagem }}" alt="{{ $post->titulo }}"
                         style="width:100%;height:180px;object-fit:cover;display:block">
                @else
                    <div style="width:100%;height:180px;display:flex;align-items:center;
                                justify-content:center;font-size:3rem;
                                background:linear-gradient(135deg,#e8f5e9,#c8e6c9)">
                        {{ $post->tipo === 'sugestao' ? '💡' : ($post->tipo === 'alimentacao_saudavel' ? '🥗' : '📰') }}
                    </div>
                @endif
                <div style="padding:1.25rem 1.5rem 1.5rem">
                    <x-post-badge :tipo="$post->tipo" />
                    <h3 style="font-size:1rem;font-weight:700;margin-bottom:0.6rem;
                               color:#1a1a1a;line-height:1.4">
                        {{ $post->titulo }}
                    </h3>
                    <p style="font-size:0.87rem;color:#555;line-height:1.6;margin-bottom:1rem">
                        {{ Str::limit($post->resumo, 100) }}
                    </p>
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <span style="font-size:0.78rem;color:#999">
                            {{ $post->author?->name ?? '—' }}
                        </span>
                        <a href="{{ route('posts.show', $post->slug) }}"
                           class="btn btn-outline"
                           style="padding:0.35rem 0.85rem;font-size:0.8rem">
                            Ler <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- ══════════════════════════════════════════
         SECÇÃO IA
    ══════════════════════════════════════════ --}}
    @if($aiPost ?? false)
    <div class="section">
        <div class="card" style="padding:3rem;background:linear-gradient(135deg,#f3e5f5,#ede7f6)">
            <div style="display:grid;grid-template-columns:1fr auto;gap:2rem;align-items:center">
                <div>
                    <span class="badge badge-purple" style="margin-bottom:1rem">✨ Inteligência Artificial</span>
                    <h2 style="font-size:1.5rem;margin-bottom:1rem;color:#1a1a1a">{{ $aiPost->titulo }}</h2>
                    <p style="color:#555;line-height:1.7;margin-bottom:1.5rem">
                        {{ Str::limit($aiPost->resumo, 150) }}
                    </p>
                    <a href="{{ route('posts.show', $aiPost->slug) }}" class="btn btn-primary">
                        <i class="fas fa-robot"></i> Explorar com IA
                    </a>
                </div>
                <div style="font-size:5rem;line-height:1">🤖</div>
            </div>
        </div>
    </div>
    @endif

    {{-- ══════════════════════════════════════════
         CATEGORIAS ALIMENTARES
    ══════════════════════════════════════════ --}}
    <div class="section">
        <h2 style="font-size:1.6rem;font-weight:700;color:#fff;
                   text-shadow:0 1px 8px rgba(0,0,0,0.4);margin-bottom:0.4rem">
            <span class="green-dot"></span>Categorias Alimentares
        </h2>
        <p style="color:rgba(255,255,255,0.75);margin-bottom:2rem;font-size:0.9rem">
            Explore os diferentes grupos alimentares
        </p>

        <div class="grid-4">
            @foreach($categories as $cat)
            <a href="{{ route('foods.index') }}" style="text-decoration:none">
                <div class="card" style="padding:1.75rem 1rem;text-align:center">
                    <div style="font-size:2.8rem;margin-bottom:0.75rem;line-height:1">{{ $cat->icone }}</div>
                    <div style="font-weight:700;color:#1a1a1a;margin-bottom:0.3rem;font-size:0.95rem">
                        {{ $cat->nome }}
                    </div>
                    <div style="font-size:0.78rem;color:#888">
                        {{ $cat->foods_count ?? '0' }} alimentos
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    {{-- ══════════════════════════════════════════
         CTA
    ══════════════════════════════════════════ --}}
    <div class="section">
        <div class="card" style="padding:3rem;text-align:center;
                                  background:linear-gradient(135deg,#e8f5e9,#f1f8e9)">
            <h2 style="font-size:1.8rem;margin-bottom:1rem;color:#1a2e1a;font-weight:700">
                Pronto para melhorar a sua alimentação?
            </h2>
            <p style="color:#5a7a5a;margin-bottom:2rem;max-width:500px;
                      margin-left:auto;margin-right:auto;line-height:1.7">
                Registe-se gratuitamente e comece a acompanhar os seus hábitos
                alimentares com a ajuda da IA.
            </p>
            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
                @guest
                    <a href="{{ route('register') }}" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Criar Conta Grátis
                    </a>
                @else
                    <a href="{{ route('purchases.index') }}" class="btn btn-primary">
                        <i class="fas fa-shopping-basket"></i> As Minhas Compras
                    </a>
                @endguest
                <a href="{{ route('oms.index') }}" class="btn btn-outline">
                    <i class="fas fa-info-circle"></i> Saber Mais
                </a>
            </div>
        </div>
    </div>

</div>
@endsection

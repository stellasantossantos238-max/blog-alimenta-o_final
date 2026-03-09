@extends('layouts.app')
@section('title', 'Início')
@section('content')

<div class="hero" style="padding:0;position:relative;min-height:100vh;display:flex;align-items:center">

    <!-- Camada de media -->
    <div id="heroMedia" style="position:absolute;inset:0;z-index:0;overflow:hidden">
        <img id="heroImg" src="{{ asset('images/fundo_fruta.jpg') }}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:opacity 1s ease">
        <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(10,22,40,0.75),rgba(13,40,24,0.7));z-index:1"></div>
        <video id="heroVideo" muted playsinline style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:0;transition:opacity 1s ease;z-index:0"></video>
    </div>

    <!-- Conteúdo -->
    <div class="container" style="position:relative;z-index:2;padding:6rem 2rem;text-align:center">
        <div style="display:inline-flex;align-items:center;gap:8px;padding:0.4rem 1rem;background:rgba(76,175,80,0.1);border:1px solid rgba(76,175,80,0.2);border-radius:20px;font-size:0.85rem;color:#81c784;margin-bottom:1.5rem">
            <span style="width:8px;height:8px;background:#4caf50;border-radius:50%;display:inline-block;animation:pulse 2s infinite"></span>
            Baseado nas recomendações da OMS
        </div>
        <h1>A sua jornada para uma<br><span class="highlight">alimentação saudável</span><br>começa aqui</h1>
        <p style="font-size:1.1rem;color:rgba(232,245,233,0.7);max-width:600px;margin:0 auto 2rem">Descubra receitas, aprenda sobre nutrição e acompanhe os seus hábitos alimentares com inteligência artificial.</p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;position:relative">
            <a href="{{ route('register') }}" class="btn btn-primary">
                <i class="fas fa-leaf"></i> Começar Agora
            </a>
            <a href="{{ route('posts.index') }}" class="btn btn-outline">
                <i class="fas fa-book-open"></i> Explorar Blog
            </a>
        </div>

        <!-- Dots indicadores -->
        <div style="position:absolute;bottom:-3rem;left:50%;transform:translateX(-50%);display:flex;gap:0.5rem;align-items:center">
            <div id="dot0" style="width:24px;height:8px;border-radius:4px;background:#4caf50;transition:all 0.3s"></div>
            <div id="dot1" style="width:8px;height:8px;border-radius:50%;background:rgba(255,255,255,0.2);transition:all 0.3s"></div>
            <div id="dot2" style="width:8px;height:8px;border-radius:50%;background:rgba(255,255,255,0.2);transition:all 0.3s"></div>
            <div id="dot3" style="width:8px;height:8px;border-radius:50%;background:rgba(255,255,255,0.2);transition:all 0.3s"></div>
            <div id="dot4" style="width:8px;height:8px;border-radius:50%;background:rgba(255,255,255,0.2);transition:all 0.3s"></div>
            <div id="dot5" style="width:8px;height:8px;border-radius:50%;background:rgba(255,255,255,0.2);transition:all 0.3s"></div>
            <div id="dot6" style="width:8px;height:8px;border-radius:50%;background:rgba(255,255,255,0.2);transition:all 0.3s"></div>
            <div id="dot7" style="width:8px;height:8px;border-radius:50%;background:rgba(255,255,255,0.2);transition:all 0.3s"></div>
        </div>
    </div>
</div>

<!-- Stats -->
<div class="container">
    <div class="grid-4" style="margin-bottom:3rem;margin-top:4rem">
        <div class="glass stat-card">
            <div class="stat-number">400g</div>
            <div class="stat-label">Hortícolas recomendados/dia</div>
        </div>
        <div class="glass stat-card">
            <div class="stat-number">300g</div>
            <div class="stat-label">Fruta recomendada/dia</div>
        </div>
        <div class="glass stat-card">
            <div class="stat-number">8</div>
            <div class="stat-label">Categorias alimentares</div>
        </div>
        <div class="glass stat-card">
            <div class="stat-number">100%</div>
            <div class="stat-label">Baseado na ciência OMS</div>
        </div>
    </div>

    <!-- Posts recentes -->
    <div class="section">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;flex-wrap:wrap;gap:1rem">
            <div>
                <h2 class="section-title"><span class="green-dot"></span>Artigos Recentes</h2>
                <p class="section-subtitle">Os últimos artigos sobre alimentação saudável</p>
            </div>
            <a href="{{ route('posts.index') }}" class="btn btn-outline">Ver todos <i class="fas fa-arrow-right"></i></a>
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
                <p>{{ Str::limit($post->resumo, 100) }}</p>
                <div style="display:flex;justify-content:space-between;align-items:center">
                    <span class="author">{{ $post->author?->nome ?? 'IA NutriSaúde' }}</span>
                    <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-outline" style="padding:0.4rem 0.8rem;font-size:0.8rem">Ler <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- IA Section -->
    @if($aiPost)
    <div class="section">
        <div class="glass-strong" style="padding:3rem;background:linear-gradient(135deg,rgba(103,58,183,0.15),rgba(76,175,80,0.1));border-color:rgba(103,58,183,0.2)">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:3rem;align-items:center">
                <div>
                    <span class="badge badge-purple" style="margin-bottom:1rem">✨ Inteligência Artificial</span>
                    <h2 style="font-size:1.8rem;margin-bottom:1rem;color:#e8f5e9">{{ $aiPost->titulo }}</h2>
                    <p style="color:rgba(232,245,233,0.6);line-height:1.7;margin-bottom:1.5rem">{{ Str::limit($aiPost->resumo, 150) }}</p>
                    <a href="{{ route('posts.show', $aiPost->slug) }}" class="btn btn-primary">
                        <i class="fas fa-robot"></i> Explorar com IA
                    </a>
                </div>
                <div style="text-align:center;font-size:8rem">🤖</div>
            </div>
        </div>
    </div>
    @endif

    <!-- Categorias -->
    <div class="section">
        <h2 class="section-title"><span class="green-dot"></span>Categorias Alimentares</h2>
        <p class="section-subtitle">Explore os diferentes grupos alimentares</p>
        <div class="grid-4">
            @foreach($categories as $cat)
            <a href="{{ route('foods.index') }}" style="text-decoration:none">
                <div class="glass-card" style="padding:1.5rem;text-align:center">
                    <div style="font-size:2.5rem;margin-bottom:0.75rem">{{ $cat->icone }}</div>
                    <div style="font-weight:600;color:#e8f5e9;margin-bottom:0.25rem">{{ $cat->nome }}</div>
                    <div style="font-size:0.8rem;color:rgba(232,245,233,0.5)">{{ $cat->foods_count ?? '' }} alimentos</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <!-- CTA -->
    <div class="section">
        <div class="glass-strong" style="padding:3rem;text-align:center;background:linear-gradient(135deg,rgba(76,175,80,0.1),rgba(139,195,74,0.05))">
            <h2 style="font-size:2rem;margin-bottom:1rem">Pronto para melhorar a sua alimentação?</h2>
            <p style="color:rgba(232,245,233,0.6);margin-bottom:2rem;max-width:500px;margin-left:auto;margin-right:auto">Registe-se gratuitamente e comece a acompanhar os seus hábitos alimentares com a ajuda da IA.</p>
            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
                @guest
                    <a href="{{ route('register') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Criar Conta Grátis</a>
                @else
                    <a href="{{ route('purchases.index') }}" class="btn btn-primary"><i class="fas fa-shopping-basket"></i> As Minhas Compras</a>
                @endguest
                <a href="{{ route('oms.index') }}" class="btn btn-outline"><i class="fas fa-info-circle"></i> Saber Mais</a>
            </div>
        </div>
    </div>
</div>

<script>
const videos = [
    '{{ asset("videos/1019-142621240_medium.mp4") }}',
    '{{ asset("videos/76983-561052225_medium.mp4") }}',
    '{{ asset("videos/11699-231758978_medium.mp4") }}',
    '{{ asset("videos/11695-231758964_medium.mp4") }}'
];

const sequence = [
    { type: 'image' },
    { type: 'video', src: videos[0] },
    { type: 'image' },
    { type: 'video', src: videos[1] },
    { type: 'image' },
    { type: 'video', src: videos[2] },
    { type: 'image' },
    { type: 'video', src: videos[3] },
];

let current = 0;
let imageTimer = null;

const heroImg = document.getElementById('heroImg');
const heroVideo = document.getElementById('heroVideo');

function updateDots(index) {
    for (let i = 0; i < 8; i++) {
        const dot = document.getElementById('dot' + i);
        if (!dot) return;
        dot.style.background = i === index ? '#4caf50' : 'rgba(255,255,255,0.2)';
        dot.style.width = i === index ? '24px' : '8px';
        dot.style.borderRadius = i === index ? '4px' : '50%';
    }
}

function showImage() {
    clearTimeout(imageTimer);
    heroVideo.style.opacity = '0';
    heroImg.style.opacity = '1';
    heroVideo.pause();
    updateDots(current);

    imageTimer = setTimeout(() => {
        current = (current + 1) % sequence.length;
        playSequence();
    }, 15000);
}

function showVideo(src) {
    clearTimeout(imageTimer);
    heroVideo.src = src;
    heroVideo.load();
    heroVideo.play().catch(() => {});
    heroVideo.style.opacity = '1';
    heroImg.style.opacity = '0';
    updateDots(current);

    heroVideo.onended = () => {
        current = (current + 1) % sequence.length;
        playSequence();
    };
}

function playSequence() {
    const step = sequence[current];
    if (step.type === 'image') {
        showImage();
    } else {
        showVideo(step.src);
    }
}

playSequence();
</script>

@endsection

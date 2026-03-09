@extends('layouts.app')
@section('title', 'Alimentos')
@section('content')

<div class="container section">
    <div style="margin-bottom:2.5rem">
        <h1 class="section-title"><span class="green-dot"></span>Base de Dados de Alimentos</h1>
        <p class="section-subtitle">Explore os alimentos organizados por categoria com informação nutricional completa</p>

        <div class="grid-4" style="margin-bottom:2rem">
            <div class="glass stat-card">
                <div class="stat-number">{{ $categories->sum(fn($c) => $c->foods->count()) }}</div>
                <div class="stat-label">Total de alimentos</div>
            </div>
            <div class="glass stat-card">
                <div class="stat-number">{{ $categories->count() }}</div>
                <div class="stat-label">Categorias</div>
            </div>
            <div class="glass stat-card">
                <div class="stat-number">100%</div>
                <div class="stat-label">Dados nutricionais</div>
            </div>
            <div class="glass stat-card">
                <div class="stat-number">OMS</div>
                <div class="stat-label">Baseado em diretrizes</div>
            </div>
        </div>

        <div style="display:flex;gap:0.75rem;flex-wrap:wrap;margin-bottom:2rem">
            <button onclick="filtrarCategoria('all')" class="btn-filtro active" data-cat="all" style="padding:0.5rem 1rem;border-radius:20px;border:1px solid rgba(76,175,80,0.4);background:rgba(76,175,80,0.15);color:#81c784;cursor:pointer;font-family:'Inter',sans-serif;font-size:0.85rem;transition:all 0.2s">
                🌿 Todos
            </button>
            @foreach($categories as $cat)
            <button onclick="filtrarCategoria('{{ $cat->id }}')" class="btn-filtro" data-cat="{{ $cat->id }}" style="padding:0.5rem 1rem;border-radius:20px;border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.05);color:rgba(232,245,233,0.6);cursor:pointer;font-family:'Inter',sans-serif;font-size:0.85rem;transition:all 0.2s">
                {{ $cat->icone }} {{ $cat->nome }}
            </button>
            @endforeach
        </div>
    </div>

    @foreach($categories as $category)
    <div class="categoria-section" data-cat="{{ $category->id }}" style="margin-bottom:3rem">
        <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:1px solid rgba(255,255,255,0.06)">
            <div style="width:50px;height:50px;background:rgba(76,175,80,0.1);border:1px solid rgba(76,175,80,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.8rem">
                {{ $category->icone }}
            </div>
            <div>
                <h2 style="font-size:1.3rem;font-weight:600;color:#e8f5e9">{{ $category->nome }}</h2>
                <span style="font-size:0.8rem;color:rgba(232,245,233,0.4)">{{ $category->foods->count() }} alimentos disponíveis</span>
            </div>
        </div>

        <div class="grid-4">
            @foreach($category->foods as $food)
            <a href="{{ route('foods.show', $food->id) }}" style="text-decoration:none">
                <div class="glass-card" style="overflow:hidden">
                    @if($food->imagem)
                        <img src="{{ $food->imagem }}" alt="{{ $food->nome }}" style="width:100%;height:140px;object-fit:cover" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                        <div style="display:none;width:100%;height:140px;background:linear-gradient(135deg,rgba(76,175,80,0.15),rgba(139,195,74,0.1));align-items:center;justify-content:center;font-size:3rem">{{ $category->icone }}</div>
                    @else
                        <div style="width:100%;height:140px;background:linear-gradient(135deg,rgba(76,175,80,0.15),rgba(139,195,74,0.1));display:flex;align-items:center;justify-content:center;font-size:3rem">
                            {{ $category->icone }}
                        </div>
                    @endif

                    <div style="padding:1rem">
                        <h3 style="font-size:0.95rem;font-weight:600;color:#e8f5e9;margin-bottom:0.75rem">{{ $food->nome }}</h3>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.4rem;margin-bottom:0.75rem">
                            <div style="text-align:center;padding:0.35rem;background:rgba(76,175,80,0.08);border-radius:6px">
                                <div style="font-size:0.7rem;color:rgba(232,245,233,0.4)">Calorias</div>
                                <div style="font-size:0.85rem;font-weight:600;color:#81c784">{{ $food->calorias_por_100g }} kcal</div>
                            </div>
                            <div style="text-align:center;padding:0.35rem;background:rgba(33,150,243,0.08);border-radius:6px">
                                <div style="font-size:0.7rem;color:rgba(232,245,233,0.4)">Proteína</div>
                                <div style="font-size:0.85rem;font-weight:600;color:#90caf9">{{ $food->proteinas }}g</div>
                            </div>
                            <div style="text-align:center;padding:0.35rem;background:rgba(255,193,7,0.08);border-radius:6px">
                                <div style="font-size:0.7rem;color:rgba(232,245,233,0.4)">Carbs</div>
                                <div style="font-size:0.85rem;font-weight:600;color:#ffe082">{{ $food->carboidratos }}g</div>
                            </div>
                            <div style="text-align:center;padding:0.35rem;background:rgba(255,87,34,0.08);border-radius:6px">
                                <div style="font-size:0.7rem;color:rgba(232,245,233,0.4)">Gordura</div>
                                <div style="font-size:0.85rem;font-weight:600;color:#ffab91">{{ $food->gorduras }}g</div>
                            </div>
                        </div>
                        <div style="text-align:center;font-size:0.75rem;color:rgba(232,245,233,0.3)">por 100g · Ver detalhes →</div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endforeach
</div>

<style>
.btn-filtro:hover { background:rgba(76,175,80,0.15) !important; border-color:rgba(76,175,80,0.4) !important; color:#81c784 !important; }
.btn-filtro.active { background:rgba(76,175,80,0.2) !important; border-color:rgba(76,175,80,0.5) !important; color:#81c784 !important; }
</style>

<script>
function filtrarCategoria(catId) {
    document.querySelectorAll('.btn-filtro').forEach(btn => {
        btn.classList.remove('active');
        if (btn.dataset.cat === catId) btn.classList.add('active');
    });
    document.querySelectorAll('.categoria-section').forEach(section => {
        section.style.display = (catId === 'all' || section.dataset.cat === catId) ? 'block' : 'none';
    });
}
</script>
@endsection

@extends('layouts.app')
@section('title', 'Alimentos')
@section('content')

<div class="container section">

    {{-- ── CABEÇALHO ─────────────────────────────────────────────── --}}
    <div style="text-align:center;margin-bottom:2.5rem">
        <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;color:#fff;
                   text-shadow:0 2px 12px rgba(0,0,0,0.4);margin-bottom:0.5rem">
            <span class="green-dot"></span>Base de Dados de Alimentos
        </h1>
        <p style="color:rgba(255,255,255,0.8);font-size:0.95rem">
            Explore os alimentos organizados por categoria com informação nutricional completa
        </p>
    </div>

    {{-- ── ESTATÍSTICAS ───────────────────────────────────────────── --}}
    <div class="grid-4" style="margin-bottom:2.5rem">
        <div class="card" style="text-align:center;padding:1.25rem">
            <div style="font-size:1.8rem;font-weight:700;color:#81c784">
                {{ $categories->sum(fn($c) => $c->foods->count()) }}
            </div>
            <div style="font-size:0.78rem;color:#aaa;margin-top:0.2rem;text-transform:uppercase;letter-spacing:0.05em">
                Total de alimentos
            </div>
        </div>
        <div class="card" style="text-align:center;padding:1.25rem">
            <div style="font-size:1.8rem;font-weight:700;color:#81c784">
                {{ $categories->count() }}
            </div>
            <div style="font-size:0.78rem;color:#aaa;margin-top:0.2rem;text-transform:uppercase;letter-spacing:0.05em">
                Categorias
            </div>
        </div>
        <div class="card" style="text-align:center;padding:1.25rem">
            <div style="font-size:1.8rem;font-weight:700;color:#81c784">100%</div>
            <div style="font-size:0.78rem;color:#aaa;margin-top:0.2rem;text-transform:uppercase;letter-spacing:0.05em">
                Dados nutricionais
            </div>
        </div>
        <div class="card" style="text-align:center;padding:1.25rem">
            <div style="font-size:1.8rem;font-weight:700;color:#81c784">OMS</div>
            <div style="font-size:0.78rem;color:#aaa;margin-top:0.2rem;text-transform:uppercase;letter-spacing:0.05em">
                Baseado em diretrizes
            </div>
        </div>
    </div>

    {{-- ── FILTROS CENTRADOS ──────────────────────────────────────── --}}
    <div style="display:flex;justify-content:center;flex-wrap:wrap;gap:0.5rem;margin-bottom:2.5rem">
        <button onclick="filtrarCategoria('all')" class="filter-btn all active" data-cat="all">
            🌿 Todos
        </button>
        @foreach($categories as $cat)
        <button onclick="filtrarCategoria('{{ $cat->id }}')"
                class="filter-btn"
                data-cat="{{ $cat->id }}">
            {{ $cat->icone }} {{ $cat->nome }}
        </button>
        @endforeach
    </div>

    {{-- ── SECÇÕES POR CATEGORIA ──────────────────────────────────── --}}
    @foreach($categories as $category)
    <div class="categoria-section" data-cat="{{ $category->id }}" style="margin-bottom:3rem">

        {{-- Título da categoria --}}
        <div style="display:flex;align-items:center;gap:0.85rem;
                    margin-bottom:1.5rem;padding-bottom:1rem;
                    border-bottom:1px solid rgba(255,255,255,0.07)">
            <div style="width:46px;height:46px;flex-shrink:0;
                        background:rgba(76,175,80,0.12);
                        border:1px solid rgba(76,175,80,0.25);
                        border-radius:10px;display:flex;
                        align-items:center;justify-content:center;
                        font-size:1.6rem">
                {{ $category->icone }}
            </div>
            <div>
                <h2 style="font-size:1.15rem;font-weight:700;color:#fff;line-height:1.2">
                    {{ $category->nome }}
                </h2>
                <span style="font-size:0.75rem;color:#aaa">
                    {{ $category->foods->count() }} alimentos disponíveis
                </span>
            </div>
        </div>

        {{-- Grid de cards de alimentos --}}
        <div class="grid-4">
            @foreach($category->foods as $food)
            <a href="{{ route('foods.show', $food->id) }}" style="text-decoration:none;display:flex">
                <div class="card" style="padding:0;overflow:hidden;
                                         display:flex;flex-direction:column;width:100%">

                    {{-- Imagem ou placeholder --}}
                    @if($food->imagem)
                        <img src="{{ $food->imagem }}" alt="{{ $food->nome }}"
                             style="width:100%;height:150px;object-fit:cover;display:block;flex-shrink:0"
                             onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                        <div style="display:none;width:100%;height:150px;flex-shrink:0;
                                    align-items:center;justify-content:center;font-size:3rem;
                                    background:linear-gradient(135deg,rgba(76,175,80,0.12),rgba(139,195,74,0.08))">
                            {{ $category->icone }}
                        </div>
                    @else
                        <div style="width:100%;height:150px;flex-shrink:0;
                                    display:flex;align-items:center;justify-content:center;
                                    font-size:3rem;
                                    background:linear-gradient(135deg,rgba(76,175,80,0.12),rgba(139,195,74,0.08))">
                            {{ $category->icone }}
                        </div>
                    @endif

                    {{-- Conteúdo --}}
                    <div style="padding:0.9rem 1rem 1rem;display:flex;flex-direction:column;flex:1">
                        <h3 style="font-size:0.92rem;font-weight:700;color:#1a1a1a;
                                   line-height:1.4;margin-bottom:0.75rem">
                            {{ $food->nome }}
                        </h3>

                        {{-- Macros --}}
                        <div style="display:grid;grid-template-columns:1fr 1fr;
                                    gap:0.4rem;margin-bottom:0.85rem;flex:1">
                            <div style="text-align:center;padding:0.4rem 0.25rem;
                                        background:#f1f8f1;border-radius:6px">
                                <div style="font-size:0.65rem;color:#888;text-transform:uppercase;
                                            letter-spacing:0.04em">Calorias</div>
                                <div style="font-size:0.82rem;font-weight:700;color:#2e7d32;margin-top:1px">
                                    {{ $food->calorias_por_100g }} kcal
                                </div>
                            </div>
                            <div style="text-align:center;padding:0.4rem 0.25rem;
                                        background:#e3f2fd;border-radius:6px">
                                <div style="font-size:0.65rem;color:#888;text-transform:uppercase;
                                            letter-spacing:0.04em">Proteína</div>
                                <div style="font-size:0.82rem;font-weight:700;color:#1565c0;margin-top:1px">
                                    {{ $food->proteinas }}g
                                </div>
                            </div>
                            <div style="text-align:center;padding:0.4rem 0.25rem;
                                        background:#fff8e1;border-radius:6px">
                                <div style="font-size:0.65rem;color:#888;text-transform:uppercase;
                                            letter-spacing:0.04em">Carbs</div>
                                <div style="font-size:0.82rem;font-weight:700;color:#e65100;margin-top:1px">
                                    {{ $food->carboidratos }}g
                                </div>
                            </div>
                            <div style="text-align:center;padding:0.4rem 0.25rem;
                                        background:#fce4ec;border-radius:6px">
                                <div style="font-size:0.65rem;color:#888;text-transform:uppercase;
                                            letter-spacing:0.04em">Gordura</div>
                                <div style="font-size:0.82rem;font-weight:700;color:#b71c1c;margin-top:1px">
                                    {{ $food->gorduras }}g
                                </div>
                            </div>
                        </div>

                        {{-- Rodapé do card --}}
                        <div style="display:flex;justify-content:space-between;align-items:center;
                                    border-top:1px solid #f0f0f0;padding-top:0.75rem;margin-top:auto">
                            <div style="font-size:0.7rem;color:#aaa">por 100g</div>
                            <span class="btn btn-outline"
                                  style="padding:0.38rem 0.9rem;font-size:0.8rem;pointer-events:none">
                                Ver <i class="fas fa-arrow-right"></i>
                            </span>
                        </div>
                    </div>

                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endforeach

</div>

<style>
/* ── Filtros — mesma lógica do blog ── */
.filter-btn {
    padding: 0.45rem 1.1rem;
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.15);
    background: rgba(255,255,255,0.06);
    color: rgba(255,255,255,0.65);
    cursor: pointer;
    font-family: inherit;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.2s;
    white-space: nowrap;
}
.filter-btn:hover {
    background: rgba(76,175,80,0.15);
    border-color: rgba(76,175,80,0.4);
    color: #81c784;
}
.filter-btn.active {
    background: rgba(76,175,80,0.2);
    border-color: rgba(76,175,80,0.5);
    color: #81c784;
    font-weight: 600;
}

/* ── Hover no card de alimento ── */
.card a:hover .card,
a:hover > .card {
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.18);
}

/* ── Responsividade ── */
@media (max-width: 900px) {
    .grid-4 { grid-template-columns: repeat(2, 1fr) !important; }
}
@media (max-width: 540px) {
    .grid-4 { grid-template-columns: 1fr !important; }
    .grid-4 a { display: block; }
    .categoria-section > div:first-child {
        flex-wrap: wrap;
    }
}
</style>

<script>
function filtrarCategoria(catId) {
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.toggle('active', btn.dataset.cat === catId);
    });
    document.querySelectorAll('.categoria-section').forEach(section => {
        section.style.display =
            (catId === 'all' || section.dataset.cat === catId) ? 'block' : 'none';
    });
}
</script>

@endsection

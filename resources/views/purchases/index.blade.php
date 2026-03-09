@extends('layouts.app')
@section('title', 'As Minhas Compras')
@section('content')

<div class="container section">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2.5rem;flex-wrap:wrap;gap:1rem">
        <div>
            <h1 class="section-title"><span class="green-dot"></span>As Minhas Compras</h1>
            <p class="section-subtitle">Semana de {{ \Carbon\Carbon::parse($semana)->format('d/m/Y') }}</p>
        </div>
        <a href="{{ route('score.calcular') }}" class="btn btn-primary">
            <i class="fas fa-calculator"></i> Calcular Pontuação
        </a>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1.5fr;gap:2rem;align-items:start">
        <!-- Formulário -->
        <div class="glass" style="padding:1.5rem">
            <h3 style="margin-bottom:1.5rem;font-size:1rem;color:#81c784"><i class="fas fa-plus-circle"></i> Adicionar Produto</h3>
            <form method="POST" action="{{ route('purchases.store') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Categoria</label>
                    <select class="form-control" id="categoriaSelect" onchange="filtrarAlimentos(this.value)">
                        <option value="">Todas as categorias</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->icone }} {{ $cat->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Alimento</label>
                    <select class="form-control" name="food_id" id="foodSelect" required>
                        <option value="">Selecione um alimento</option>
                        @foreach($categories as $cat)
                            @foreach($cat->foods as $food)
                            <option value="{{ $food->id }}" data-cat="{{ $cat->id }}">{{ $food->nome }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Quantidade (gramas)</label>
                    <input type="number" class="form-control" name="quantidade_gramas" placeholder="ex: 500" min="1" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%">
                    <i class="fas fa-plus"></i> Adicionar
                </button>
            </form>
        </div>

        <!-- Lista de compras -->
        <div class="glass" style="padding:1.5rem">
            <h3 style="margin-bottom:1.5rem;font-size:1rem;color:#81c784"><i class="fas fa-shopping-basket"></i> Compras desta semana ({{ $purchases->count() }})</h3>

            @if($purchases->isEmpty())
            <div style="text-align:center;padding:3rem;color:rgba(232,245,233,0.4)">
                <div style="font-size:3rem;margin-bottom:1rem">🛒</div>
                <p>Ainda não adicionou produtos esta semana.</p>
            </div>
            @else
            <div style="display:flex;flex-direction:column;gap:0.75rem">
                @foreach($purchases as $purchase)
                <div style="display:flex;align-items:center;justify-content:space-between;padding:1rem;background:rgba(255,255,255,0.03);border-radius:10px;border:1px solid rgba(255,255,255,0.06)">
                    <div style="display:flex;align-items:center;gap:1rem">
                        <span style="font-size:1.5rem">{{ $purchase->food->category->icone }}</span>
                        <div>
                            <div style="font-weight:500;font-size:0.95rem">{{ $purchase->food->nome }}</div>
                            <div style="font-size:0.8rem;color:rgba(232,245,233,0.4)">{{ $purchase->food->category->nome }}</div>
                        </div>
                    </div>
                    <div style="display:flex;align-items:center;gap:1rem">
                        <span class="badge badge-green">{{ $purchase->quantidade_gramas }}g</span>
                        <form method="POST" action="{{ route('purchases.destroy', $purchase->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding:0.3rem 0.7rem;font-size:0.8rem">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Resumo por categoria -->
            <div style="margin-top:2rem;padding-top:1.5rem;border-top:1px solid rgba(255,255,255,0.08)">
                <h4 style="margin-bottom:1rem;font-size:0.9rem;color:rgba(232,245,233,0.5)">RESUMO POR CATEGORIA</h4>
                @php
                    $porCategoria = $purchases->groupBy('food.category.nome');
                @endphp
                @foreach($porCategoria as $catNome => $items)
                <div style="display:flex;justify-content:space-between;padding:0.5rem 0;border-bottom:1px solid rgba(255,255,255,0.04)">
                    <span style="font-size:0.9rem;color:rgba(232,245,233,0.7)">{{ $catNome }}</span>
                    <span class="badge badge-blue">{{ $items->sum('quantidade_gramas') }}g</span>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>

<script>
function filtrarAlimentos(catId) {
    const select = document.getElementById('foodSelect');
    const options = select.querySelectorAll('option');
    options.forEach(opt => {
        if (!opt.value) return;
        opt.style.display = (!catId || opt.dataset.cat === catId) ? '' : 'none';
    });
    select.value = '';
}
</script>
@endsection

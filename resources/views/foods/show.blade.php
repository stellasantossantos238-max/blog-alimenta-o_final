@extends('layouts.app')
@section('title', $food->nome)
@section('content')

<div class="container section">
    <div style="max-width:700px;margin:0 auto">
        <a href="{{ route('foods.index') }}" style="color:#81c784;text-decoration:none;font-size:0.9rem;display:inline-flex;align-items:center;gap:6px;margin-bottom:1.5rem">
            <i class="fas fa-arrow-left"></i> Voltar aos Alimentos
        </a>

        <div class="glass" style="padding:2.5rem">
            <div style="text-align:center;margin-bottom:2rem">
            @if($food->imagem)
                <img src="{{ $food->imagem }}" alt="{{ $food->nome }}" style="width:200px;height:200px;object-fit:cover;border-radius:50%;margin:0 auto 1rem;display:block;border:3px solid rgba(76,175,80,0.3)" onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
                <div style="display:none;font-size:5rem;margin-bottom:1rem">{{ $food->category->icone }}</div>
            @else
                <div style="font-size:5rem;margin-bottom:1rem">{{ $food->category->icone }}</div>
            @endif
            <h1 style="font-size:2rem;font-weight:700">{{ $food->nome }}</h1>
            <span class="badge badge-green" style="margin-top:0.5rem">{{ $food->category->icone }} {{ $food->category->nome }}</span>
        </div>

            <h3 style="margin-bottom:1rem;color:rgba(232,245,233,0.7);font-size:0.9rem;text-transform:uppercase;letter-spacing:1px">Valores Nutricionais por 100g</h3>

            <div class="grid-2" style="gap:1rem;margin-bottom:2rem">
                <div style="padding:1.5rem;background:rgba(76,175,80,0.1);border-radius:10px;border:1px solid rgba(76,175,80,0.2);text-align:center">
                    <div style="font-size:2rem;font-weight:700;color:#81c784">{{ $food->calorias_por_100g }}</div>
                    <div style="font-size:0.85rem;color:rgba(232,245,233,0.5)">Calorias (kcal)</div>
                </div>
                <div style="padding:1.5rem;background:rgba(33,150,243,0.1);border-radius:10px;border:1px solid rgba(33,150,243,0.2);text-align:center">
                    <div style="font-size:2rem;font-weight:700;color:#90caf9">{{ $food->proteinas }}g</div>
                    <div style="font-size:0.85rem;color:rgba(232,245,233,0.5)">Proteínas</div>
                </div>
                <div style="padding:1.5rem;background:rgba(255,193,7,0.1);border-radius:10px;border:1px solid rgba(255,193,7,0.2);text-align:center">
                    <div style="font-size:2rem;font-weight:700;color:#ffe082">{{ $food->carboidratos }}g</div>
                    <div style="font-size:0.85rem;color:rgba(232,245,233,0.5)">Carboidratos</div>
                </div>
                <div style="padding:1.5rem;background:rgba(255,87,34,0.1);border-radius:10px;border:1px solid rgba(255,87,34,0.2);text-align:center">
                    <div style="font-size:2rem;font-weight:700;color:#ffab91">{{ $food->gorduras }}g</div>
                    <div style="font-size:0.85rem;color:rgba(232,245,233,0.5)">Gorduras</div>
                </div>
            </div>

            <!-- Gráfico -->
            <div style="max-width:300px;margin:0 auto">
                <canvas id="foodChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
new Chart(document.getElementById('foodChart'), {
    type: 'bar',
    data: {
        labels: ['Proteínas', 'Carboidratos', 'Gorduras'],
        datasets: [{
            data: [{{ $food->proteinas }}, {{ $food->carboidratos }}, {{ $food->gorduras }}],
            backgroundColor: ['rgba(33,150,243,0.6)','rgba(255,193,7,0.6)','rgba(255,87,34,0.6)'],
            borderRadius: 6
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: {
            y: { ticks: { color: 'rgba(232,245,233,0.5)' }, grid: { color: 'rgba(255,255,255,0.05)' } },
            x: { ticks: { color: 'rgba(232,245,233,0.5)' }, grid: { display: false } }
        }
    }
});
</script>
@endsection

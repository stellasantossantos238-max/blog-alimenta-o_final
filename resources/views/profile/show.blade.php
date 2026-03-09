@extends('layouts.app')
@section('title', 'O Meu Perfil')
@section('content')

<div class="container section">
    <div style="margin-bottom:2.5rem">
        <h1 class="section-title"><span class="green-dot"></span>O Meu Perfil</h1>
        <p class="section-subtitle">Acompanhe o seu progresso alimentar</p>
    </div>

    <div style="display:grid;grid-template-columns:1fr 2fr;gap:2rem;align-items:start">
        <!-- Perfil -->
        <div style="display:flex;flex-direction:column;gap:1.5rem">
            <div class="glass" style="padding:2rem;text-align:center">
                <div style="width:80px;height:80px;background:linear-gradient(135deg,#4caf50,#2e7d32);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:2rem;margin:0 auto 1rem">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <h2 style="font-size:1.2rem;font-weight:600;margin-bottom:0.25rem">{{ auth()->user()->name }}</h2>
                <p style="font-size:0.85rem;color:rgba(232,245,233,0.4)">{{ auth()->user()->email }}</p>
                <div style="margin-top:1rem">
                    @if($score)
                        @if($score->percentagem_conformidade >= 80)
                            <span class="badge badge-green">🏆 Utilizador Exemplar</span>
                        @elseif($score->percentagem_conformidade >= 50)
                            <span class="badge badge-blue">⭐ Em Progresso</span>
                        @else
                            <span class="badge badge-purple">🌱 A Começar</span>
                        @endif
                    @else
                        <span class="badge badge-purple">🌱 Novo Utilizador</span>
                    @endif
                </div>
            </div>

            @if($score)
            <div class="glass" style="padding:1.5rem">
                <h3 style="font-size:0.9rem;color:rgba(232,245,233,0.5);margin-bottom:1rem;text-transform:uppercase;letter-spacing:1px">Pontuação desta semana</h3>
                <div style="text-align:center;margin-bottom:1rem">
                    <div style="font-size:3rem;font-weight:700;background:linear-gradient(135deg,#4caf50,#8bc34a);-webkit-background-clip:text;-webkit-text-fill-color:transparent">
                        {{ round($score->percentagem_conformidade) }}%
                    </div>
                    <div style="font-size:0.85rem;color:rgba(232,245,233,0.4)">Conformidade OMS</div>
                </div>
                <div class="progress-bar" style="height:12px">
                    <div class="progress-fill" style="width:{{ $score->percentagem_conformidade }}%"></div>
                </div>
            </div>
            @endif

            <a href="{{ route('purchases.index') }}" class="btn btn-primary" style="justify-content:center">
                <i class="fas fa-shopping-basket"></i> Gerir Compras
            </a>
            <a href="{{ route('score.calcular') }}" class="btn btn-outline" style="justify-content:center">
                <i class="fas fa-calculator"></i> Resetar Pontuação
            </a>
        </div>

        <!-- Conteúdo principal -->
        <div style="display:flex;flex-direction:column;gap:1.5rem">

            <!-- Comentários automáticos -->
            @if($score && $score->comentario_automatico)
            <div class="glass" style="padding:1.5rem">
                <h3 style="margin-bottom:1.5rem;font-size:1rem"><i class="fas fa-comment-dots" style="color:#81c784"></i> Análise Automática</h3>
                @foreach(explode("\n", $score->comentario_automatico) as $comentario)
                    @if(trim($comentario))
                    <div style="padding:0.75rem 1rem;background:rgba(255,255,255,0.03);border-radius:8px;margin-bottom:0.5rem;font-size:0.9rem;color:rgba(232,245,233,0.7);border-left:3px solid rgba(76,175,80,0.4)">
                        {{ $comentario }}
                    </div>
                    @endif
                @endforeach
            </div>
            @endif

            <!-- Compras desta semana -->
            @if($purchases->isNotEmpty())
            <div class="glass" style="padding:1.5rem">
                <h3 style="margin-bottom:1.5rem;font-size:1rem"><i class="fas fa-shopping-basket" style="color:#81c784"></i> Compras desta semana</h3>
                <canvas id="purchasesChart" height="200"></canvas>
            </div>
            @endif

            <!-- Histórico -->
            @if($historico->isNotEmpty())
            <div class="glass" style="padding:1.5rem">
                <h3 style="margin-bottom:1.5rem;font-size:1rem"><i class="fas fa-chart-line" style="color:#81c784"></i> Histórico de Pontuações</h3>
                <canvas id="historicoChart" height="150"></canvas>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
@if($purchases->isNotEmpty())
@php
    $porCategoria = $purchases->groupBy('food.category.nome');
@endphp
new Chart(document.getElementById('purchasesChart'), {
    type: 'bar',
    data: {
        labels: @json($porCategoria->keys()),
        datasets: [{
            label: 'Gramas compradas',
            data: @json($porCategoria->map(fn($i) => $i->sum('quantidade_gramas'))->values()),
            backgroundColor: 'rgba(76,175,80,0.5)',
            borderColor: 'rgba(76,175,80,0.8)',
            borderWidth: 1,
            borderRadius: 6
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: {
            y: { ticks: { color: 'rgba(232,245,233,0.5)' }, grid: { color: 'rgba(255,255,255,0.05)' } },
            x: { ticks: { color: 'rgba(232,245,233,0.5)', maxRotation: 45 }, grid: { display: false } }
        }
    }
});
@endif

@if($historico->isNotEmpty())
new Chart(document.getElementById('historicoChart'), {
    type: 'line',
    data: {
        labels: @json($historico->pluck('semana_inicio')),
        datasets: [{
            label: 'Conformidade %',
            data: @json($historico->pluck('percentagem_conformidade')),
            borderColor: '#4caf50',
            backgroundColor: 'rgba(76,175,80,0.1)',
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#4caf50'
        }]
    },
    options: {
        plugins: { legend: { labels: { color: 'rgba(232,245,233,0.5)' } } },
        scales: {
            y: { ticks: { color: 'rgba(232,245,233,0.5)' }, grid: { color: 'rgba(255,255,255,0.05)' }, max: 100 },
            x: { ticks: { color: 'rgba(232,245,233,0.5)' }, grid: { display: false } }
        }
    }
});
@endif
</script>
@endsection

@extends('layouts.app')
@section('title', 'Ranking')
@section('content')

<div class="container section">
    <div style="text-align:center;margin-bottom:3rem">
        <span class="badge badge-gold" style="margin-bottom:1rem;font-size:0.9rem;padding:0.5rem 1rem">🏆 Tabela de Classificação</span>
        <h1 class="section-title">Ranking Semanal</h1>
        <p class="section-subtitle">Semana de {{ \Carbon\Carbon::parse($semana)->format('d/m/Y') }}</p>
    </div>

    @if($ranking->isEmpty())
    <div class="glass" style="padding:4rem;text-align:center">
        <div style="font-size:4rem;margin-bottom:1rem">🏆</div>
        <h3 style="margin-bottom:0.5rem">Ainda não há classificações</h3>
        <p style="color:rgba(232,245,233,0.4);margin-bottom:1.5rem">Seja o primeiro a calcular a sua pontuação esta semana!</p>
        @auth
        <a href="{{ route('score.calcular') }}" class="btn btn-primary">Calcular Pontuação</a>
        @else
        <a href="{{ route('register') }}" class="btn btn-primary">Registar Agora</a>
        @endauth
    </div>
    @else

    <!-- Top 3 -->
    @if($ranking->count() >= 3)
    <div style="display:grid;grid-template-columns:1fr 1.2fr 1fr;gap:1rem;margin-bottom:3rem;align-items:end">
        <!-- 2º lugar -->
        <div class="glass-card" style="padding:1.5rem;text-align:center">
            <div style="font-size:2.5rem;margin-bottom:0.5rem">🥈</div>
            <div style="width:50px;height:50px;background:linear-gradient(135deg,#9e9e9e,#616161);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.2rem;margin:0 auto 0.75rem">
                {{ strtoupper(substr($ranking[1]->user->name, 0, 1)) }}
            </div>
            <div style="font-weight:600;font-size:0.9rem">{{ $ranking[1]->user->name }}</div>
            <div style="font-size:1.5rem;font-weight:700;color:#c0c0c0;margin-top:0.5rem">{{ round($ranking[1]->percentagem_conformidade) }}%</div>
        </div>

        <!-- 1º lugar -->
        <div class="glass-strong" style="padding:2rem;text-align:center;background:linear-gradient(135deg,rgba(255,193,7,0.1),rgba(255,152,0,0.05));border-color:rgba(255,193,7,0.3)">
            <div style="font-size:3rem;margin-bottom:0.5rem">🥇</div>
            <div style="width:60px;height:60px;background:linear-gradient(135deg,#ffd700,#ff8f00);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.5rem;margin:0 auto 0.75rem">
                {{ strtoupper(substr($ranking[0]->user->name, 0, 1)) }}
            </div>
            <div style="font-weight:700;color:#ffe082">{{ $ranking[0]->user->name }}</div>
            <div style="font-size:2rem;font-weight:700;color:#ffd700;margin-top:0.5rem">{{ round($ranking[0]->percentagem_conformidade) }}%</div>
            <span class="badge badge-gold" style="margin-top:0.5rem">👑 Líder da semana</span>
        </div>

        <!-- 3º lugar -->
        <div class="glass-card" style="padding:1.5rem;text-align:center">
            <div style="font-size:2.5rem;margin-bottom:0.5rem">🥉</div>
            <div style="width:50px;height:50px;background:linear-gradient(135deg,#a1887f,#6d4c41);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.2rem;margin:0 auto 0.75rem">
                {{ strtoupper(substr($ranking[2]->user->name, 0, 1)) }}
            </div>
            <div style="font-weight:600;font-size:0.9rem">{{ $ranking[2]->user->name }}</div>
            <div style="font-size:1.5rem;font-weight:700;color:#cd7f32;margin-top:0.5rem">{{ round($ranking[2]->percentagem_conformidade) }}%</div>
        </div>
    </div>
    @endif

    <!-- Tabela completa -->
    <div class="glass" style="padding:1.5rem">
        <h3 style="margin-bottom:1.5rem;font-size:1rem"><span class="green-dot"></span>Classificação Completa</h3>
        <div style="overflow-x:auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Utilizador</th>
                        <th>Conformidade</th>
                        <th>Pontuação</th>
                        <th>Progresso</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ranking as $entry)
                    <tr>
                        <td>
                            @if($entry->posicao == 1) <span class="rank-1">🥇</span>
                            @elseif($entry->posicao == 2) <span class="rank-2">🥈</span>
                            @elseif($entry->posicao == 3) <span class="rank-3">🥉</span>
                            @else <span style="color:rgba(232,245,233,0.4)">#{{ $entry->posicao }}</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;align-items:center;gap:0.75rem">
                                <div style="width:35px;height:35px;background:linear-gradient(135deg,#4caf50,#2e7d32);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.9rem;flex-shrink:0">
                                    {{ strtoupper(substr($entry->user->name, 0, 1)) }}
                                </div>
                                <span style="font-weight:500">{{ $entry->user->name }}</span>
                            </div>
                        </td>
                        <td>
                            <span style="font-weight:600;color:{{ $entry->percentagem_conformidade >= 80 ? '#81c784' : ($entry->percentagem_conformidade >= 50 ? '#90caf9' : '#ef9a9a') }}">
                                {{ round($entry->percentagem_conformidade) }}%
                            </span>
                        </td>
                        <td><span class="badge badge-green">{{ round($entry->pontuacao) }} pts</span></td>
                        <td style="min-width:150px">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width:{{ $entry->percentagem_conformidade }}%"></div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection

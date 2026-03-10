@extends('layouts.app')
@section('title', 'Backoffice Admin')

@section('content')
<div style="display:flex;min-height:calc(100vh - 70px)">
    <aside class="admin-sidebar" style="flex-shrink:0">
        <div style="padding:0.75rem 1rem 1.5rem;border-bottom:1px solid rgba(255,255,255,0.08);margin-bottom:1rem">
            <div style="font-size:0.7rem;color:rgba(232,245,233,0.3);letter-spacing:0.1em;text-transform:uppercase;margin-bottom:0.25rem">Backoffice</div>
            <div style="font-weight:700;color:#a5d6a7;font-size:1rem">Eco-Sustentável</div>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-pie" style="width:18px"></i> Dashboard
        </a>
        <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
            <i class="fas fa-users" style="width:18px"></i> Utilizadores
        </a>
        <a href="{{ route('admin.posts') }}" class="{{ request()->routeIs('admin.posts') ? 'active' : '' }}">
            <i class="fas fa-newspaper" style="width:18px"></i> Posts
        </a>
        <div style="border-top:1px solid rgba(255,255,255,0.08);margin:1rem 0"></div>
        <a href="{{ route('home') }}"><i class="fas fa-arrow-left" style="width:18px"></i> Voltar ao site</a>
    </aside>

    <div style="flex:1;padding:2rem;background:#f5f7f5;overflow-y:auto">
        <div style="margin-bottom:2rem">
            <h1 style="font-size:1.6rem;font-weight:700;color:#1a2e1a">Dashboard</h1>
            <p style="color:#6a8f6a;font-size:0.9rem">Visão geral do sistema</p>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:1rem;margin-bottom:2rem">
            <div class="card" style="padding:1.25rem">
                <div style="font-size:0.8rem;color:#6a8f6a;font-weight:500;margin-bottom:0.5rem;text-transform:uppercase;letter-spacing:0.05em">Total Utilizadores</div>
                <div style="font-size:2rem;font-weight:700;color:#2e7d32">{{ $stats['total_users'] }}</div>
                <div style="font-size:0.78rem;color:#8aaa8a;margin-top:0.35rem">{{ $stats['admins'] }} admin · {{ $stats['profissionais'] }} prof. · {{ $stats['utilizadores'] }} user</div>
            </div>
            <div class="card" style="padding:1.25rem">
                <div style="font-size:0.8rem;color:#6a8f6a;font-weight:500;margin-bottom:0.5rem;text-transform:uppercase;letter-spacing:0.05em">Total Posts</div>
                <div style="font-size:2rem;font-weight:700;color:#2e7d32">{{ $stats['total_posts'] }}</div>
                <div style="font-size:0.78rem;color:#8aaa8a;margin-top:0.35rem">{{ $stats['posts_publicados'] }} publicados</div>
            </div>
            <div class="card" style="padding:1.25rem">
                <div style="font-size:0.8rem;color:#6a8f6a;font-weight:500;margin-bottom:0.5rem;text-transform:uppercase;letter-spacing:0.05em">Notícias</div>
                <div style="font-size:2rem;font-weight:700;color:#2e7d32">{{ $stats['posts_noticia'] }}</div>
            </div>
            <div class="card" style="padding:1.25rem">
                <div style="font-size:0.8rem;color:#6a8f6a;font-weight:500;margin-bottom:0.5rem;text-transform:uppercase;letter-spacing:0.05em">Sugestões</div>
                <div style="font-size:2rem;font-weight:700;color:#1565c0">{{ $stats['posts_sugestao'] }}</div>
            </div>
            <div class="card" style="padding:1.25rem">
                <div style="font-size:0.8rem;color:#6a8f6a;font-weight:500;margin-bottom:0.5rem;text-transform:uppercase;letter-spacing:0.05em">Alimentação</div>
                <div style="font-size:2rem;font-weight:700;color:#e65100">{{ $stats['posts_alimentacao'] }}</div>
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
            <div class="card" style="padding:1.5rem">
                <h3 style="font-size:1rem;font-weight:700;color:#1a2e1a;margin-bottom:1.25rem">Utilizadores Recentes</h3>
                <table class="table">
                    <thead><tr><th>Nome</th><th>Role</th><th>Data</th></tr></thead>
                    <tbody>
                    @foreach($recentUsers as $user)
                        <tr>
                            <td style="font-weight:500">{{ $user->name }}</td>
                            <td><span class="role-{{ $user->role }}">{{ ucfirst($user->role) }}</span></td>
                            <td style="color:#8aaa8a;font-size:0.82rem">{{ $user->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{ route('admin.users') }}" class="btn btn-outline" style="margin-top:1rem;font-size:0.85rem;padding:0.5rem 1rem">Ver todos</a>
            </div>

            <div class="card" style="padding:1.5rem">
                <h3 style="font-size:1rem;font-weight:700;color:#1a2e1a;margin-bottom:1.25rem">Posts Recentes</h3>
                <table class="table">
                    <thead><tr><th>Título</th><th>Tipo</th><th>Estado</th></tr></thead>
                    <tbody>
                    @foreach($recentPosts as $post)
                        <tr>
                            <td style="font-weight:500;font-size:0.85rem;max-width:160px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $post->titulo }}</td>
                            <td><x-post-badge :tipo="$post->tipo" /></td>
                            <td>
                                @if($post->publicado)
                                    <span style="color:#2e7d32;font-size:0.8rem;font-weight:600">✓ Pub.</span>
                                @else
                                    <span style="color:#c62828;font-size:0.8rem">✗ Oculto</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{ route('admin.posts') }}" class="btn btn-outline" style="margin-top:1rem;font-size:0.85rem;padding:0.5rem 1rem">Ver todos</a>
            </div>
        </div>
    </div>
</div>
@endsection

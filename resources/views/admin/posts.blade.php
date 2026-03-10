@extends('layouts.app')
@section('title', 'Gestão de Posts')

@section('content')
<div style="display:flex;min-height:calc(100vh - 70px)">
    <aside class="admin-sidebar" style="flex-shrink:0">
        <div style="padding:0.75rem 1rem 1.5rem;border-bottom:1px solid rgba(255,255,255,0.08);margin-bottom:1rem">
            <div style="font-size:0.7rem;color:rgba(232,245,233,0.3);letter-spacing:0.1em;text-transform:uppercase;margin-bottom:0.25rem">Backoffice</div>
            <div style="font-weight:700;color:#a5d6a7;font-size:1rem">Eco-Sustentável</div>
        </div>
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-pie" style="width:18px"></i> Dashboard</a>
        <a href="{{ route('admin.users') }}"><i class="fas fa-users" style="width:18px"></i> Utilizadores</a>
        <a href="{{ route('admin.posts') }}" class="active"><i class="fas fa-newspaper" style="width:18px"></i> Posts</a>
        <div style="border-top:1px solid rgba(255,255,255,0.08);margin:1rem 0"></div>
        <a href="{{ route('home') }}"><i class="fas fa-arrow-left" style="width:18px"></i> Voltar ao site</a>
    </aside>

    <div style="flex:1;padding:2rem;background:#f5f7f5;overflow-y:auto">
        <div style="margin-bottom:2rem">
            <h1 style="font-size:1.6rem;font-weight:700;color:#1a2e1a">Posts</h1>
            <p style="color:#6a8f6a;font-size:0.9rem">Gerir todos os posts do blog</p>
        </div>

        <div class="filter-bar" style="margin-bottom:1.5rem">
            <a href="{{ route('admin.posts') }}" class="filter-btn all {{ !$tipo ? 'active' : '' }}">Todos</a>
            <a href="{{ route('admin.posts', ['tipo' => 'noticia']) }}" class="filter-btn noticia {{ $tipo === 'noticia' ? 'active' : '' }}">📰 Notícias</a>
            <a href="{{ route('admin.posts', ['tipo' => 'sugestao']) }}" class="filter-btn sugestao {{ $tipo === 'sugestao' ? 'active' : '' }}">💡 Sugestões</a>
            <a href="{{ route('admin.posts', ['tipo' => 'alimentacao_saudavel']) }}" class="filter-btn alimentacao_saudavel {{ $tipo === 'alimentacao_saudavel' ? 'active' : '' }}">🥗 Alimentação</a>
        </div>

        <div class="card" style="overflow:hidden">
            <table class="table">
                <thead><tr><th>#</th><th>Título</th><th>Tipo</th><th>Autor</th><th>Estado</th><th>Data</th><th>Ações</th></tr></thead>
                <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td style="color:#8aaa8a;font-size:0.82rem">{{ $post->id }}</td>
                        <td style="font-weight:600;font-size:0.88rem;max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $post->titulo }}</td>
                        <td><x-post-badge :tipo="$post->tipo" /></td>
                        <td style="font-size:0.85rem;color:#6a8f6a">{{ $post->author?->name ?? '—' }}</td>
                        <td>
                            @if($post->publicado)
                                <span style="color:#2e7d32;font-size:0.82rem;font-weight:600">✓ Publicado</span>
                            @else
                                <span style="color:#c62828;font-size:0.82rem">✗ Oculto</span>
                            @endif
                        </td>
                        <td style="color:#8aaa8a;font-size:0.82rem">{{ $post->created_at->format('d/m/Y') }}</td>
                        <td style="display:flex;gap:0.4rem;align-items:center">
                            <form method="POST" action="{{ route('admin.posts.toggle', $post) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-outline" style="padding:0.25rem 0.6rem;font-size:0.78rem">
                                    {{ $post->publicado ? 'Ocultar' : 'Publicar' }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.posts.delete', $post) }}"
                                  onsubmit="return confirm('Tens a certeza?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding:0.25rem 0.6rem;font-size:0.78rem">
                                    Apagar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="text-align:center;color:#8aaa8a;padding:2rem">Nenhum post encontrado.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top:1.5rem">{{ $posts->links() }}</div>
    </div>
</div>
@endsection

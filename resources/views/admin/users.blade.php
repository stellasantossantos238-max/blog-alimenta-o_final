@extends('layouts.app')
@section('title', 'Gestão de Utilizadores')

@section('content')
<div style="display:flex;min-height:calc(100vh - 70px)">
    <aside class="admin-sidebar" style="flex-shrink:0">
        <div style="padding:0.75rem 1rem 1.5rem;border-bottom:1px solid rgba(255,255,255,0.08);margin-bottom:1rem">
            <div style="font-size:0.7rem;color:rgba(232,245,233,0.3);letter-spacing:0.1em;text-transform:uppercase;margin-bottom:0.25rem">Backoffice</div>
            <div style="font-weight:700;color:#a5d6a7;font-size:1rem">Eco-Sustentável</div>
        </div>
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-pie" style="width:18px"></i> Dashboard</a>
        <a href="{{ route('admin.users') }}" class="active"><i class="fas fa-users" style="width:18px"></i> Utilizadores</a>
        <a href="{{ route('admin.posts') }}"><i class="fas fa-newspaper" style="width:18px"></i> Posts</a>
        <div style="border-top:1px solid rgba(255,255,255,0.08);margin:1rem 0"></div>
        <a href="{{ route('home') }}"><i class="fas fa-arrow-left" style="width:18px"></i> Voltar ao site</a>
    </aside>

    <div style="flex:1;padding:2rem;background:#f5f7f5;overflow-y:auto">
        <div style="margin-bottom:2rem">
            <h1 style="font-size:1.6rem;font-weight:700;color:#1a2e1a">Utilizadores</h1>
            <p style="color:#6a8f6a;font-size:0.9rem">Gerir roles e permissões</p>
        </div>

        <div class="filter-bar" style="margin-bottom:1.5rem">
            <a href="{{ route('admin.users') }}" class="filter-btn all {{ !$role ? 'active' : '' }}">Todos</a>
            <a href="{{ route('admin.users', ['role' => 'admin']) }}" class="filter-btn noticia {{ $role === 'admin' ? 'active' : '' }}">Admin</a>
            <a href="{{ route('admin.users', ['role' => 'profissional']) }}" class="filter-btn sugestao {{ $role === 'profissional' ? 'active' : '' }}">Profissional</a>
            <a href="{{ route('admin.users', ['role' => 'utilizador']) }}" class="filter-btn alimentacao_saudavel {{ $role === 'utilizador' ? 'active' : '' }}">Utilizador</a>
        </div>

        <div class="card" style="overflow:hidden">
            <table class="table">
                <thead><tr><th>#</th><th>Nome</th><th>Email</th><th>Role Atual</th><th>Registado em</th><th>Alterar Role</th></tr></thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td style="color:#8aaa8a;font-size:0.82rem">{{ $user->id }}</td>
                        <td style="font-weight:600">{{ $user->name }}</td>
                        <td style="color:#6a8f6a;font-size:0.85rem">{{ $user->email }}</td>
                        <td><span class="role-{{ $user->role }}">{{ ucfirst($user->role) }}</span></td>
                        <td style="color:#8aaa8a;font-size:0.82rem">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td>
                            @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.role', $user) }}" style="display:flex;gap:0.5rem;align-items:center">
                                @csrf
                                @method('PATCH')
                                <select name="role" class="form-control" style="width:auto;padding:0.3rem 0.6rem;font-size:0.82rem">
                                    <option value="utilizador"   {{ $user->role === 'utilizador'   ? 'selected' : '' }}>Utilizador</option>
                                    <option value="profissional" {{ $user->role === 'profissional' ? 'selected' : '' }}>Profissional</option>
                                    <option value="admin"        {{ $user->role === 'admin'        ? 'selected' : '' }}>Admin</option>
                                </select>
                                <button type="submit" class="btn btn-primary" style="padding:0.3rem 0.75rem;font-size:0.82rem">Guardar</button>
                            </form>
                            @else
                                <span style="color:#8aaa8a;font-size:0.82rem;font-style:italic">Tu próprio</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center;color:#8aaa8a;padding:2rem">Nenhum utilizador encontrado.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top:1.5rem">{{ $users->links() }}</div>
    </div>
</div>
@endsection

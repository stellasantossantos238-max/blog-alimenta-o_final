@extends('layouts.app')
@section('title', $post->titulo)
@section('content')

<div class="container section">
    <div style="max-width:800px;margin:0 auto">
        <a href="{{ route('posts.index') }}" style="color:#81c784;text-decoration:none;font-size:0.9rem;display:inline-flex;align-items:center;gap:6px;margin-bottom:1.5rem">
            <i class="fas fa-arrow-left"></i> Voltar ao Blog
        </a>

        <div class="glass" style="padding:2.5rem">

            <h1 style="font-size:2rem;font-weight:700;margin-bottom:1rem;line-height:1.3">{{ $post->titulo }}</h1>

           @if($post->author)
            <div style="display:flex;align-items:center;gap:1rem;padding:1rem;background:rgba(255,255,255,0.03);border-radius:10px;margin-bottom:1.5rem">
                @if($post->author->avatar)
                    <img src="{{ $post->author->avatar }}" alt="{{ $post->author->nome }}" style="width:50px;height:50px;border-radius:50%;object-fit:cover;border:2px solid rgba(76,175,80,0.3)">
                @else
                    <div style="width:50px;height:50px;background:linear-gradient(135deg,#4caf50,#2e7d32);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.2rem">👤</div>
                @endif
                <div>
                    <div style="font-weight:600;color:#e8f5e9">{{ $post->author->nome }}</div>
                    <div style="font-size:0.8rem;color:rgba(232,245,233,0.5)">{{ $post->author->especialidade }} • {{ $post->created_at->format('d/m/Y') }}</div>
                </div>
            </div>
            @endif

           @if($post->imagem)
    <img src="{{ $post->imagem }}" alt="{{ $post->titulo }}" style="width:100%;height:300px;object-fit:cover;border-radius:12px;margin-bottom:2rem">
@else
    <div class="img-placeholder" style="height:250px;font-size:5rem;margin-bottom:2rem">
        {{ $post->tipo === 'ai' ? '🤖' : ($post->tipo === 'oms' ? '🏥' : '🥗') }}
    </div>
@endif

            <div style="line-height:1.9;color:rgba(232,245,233,0.85);font-size:1rem">
                {!! nl2br(e($post->conteudo)) !!}
            </div>
        </div>

        <!-- Comentários -->
        <div class="glass" style="padding:2rem;margin-top:1.5rem">
            <h3 style="margin-bottom:1.5rem;font-size:1.2rem">💬 Comentários ({{ $post->comments->count() }})</h3>

            @auth
            <form method="POST" action="#" style="margin-bottom:2rem">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name="conteudo" rows="3" placeholder="Partilhe a sua opinião..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="font-size:0.9rem;padding:0.6rem 1.2rem">Comentar</button>
            </form>
            @else
            <div style="padding:1rem;background:rgba(76,175,80,0.08);border-radius:8px;margin-bottom:1.5rem;font-size:0.9rem;color:rgba(232,245,233,0.6)">
                <a href="{{ route('login') }}" style="color:#81c784">Entre</a> para comentar.
            </div>
            @endauth

            @forelse($post->comments as $comment)
            <div style="padding:1rem;border-bottom:1px solid rgba(255,255,255,0.05);display:flex;gap:1rem">
                <div style="width:36px;height:36px;background:linear-gradient(135deg,#4caf50,#2e7d32);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.9rem;flex-shrink:0">
                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                </div>
                <div>
                    <div style="font-weight:600;font-size:0.9rem;margin-bottom:0.25rem">{{ $comment->user->name }}</div>
                    <div style="font-size:0.85rem;color:rgba(232,245,233,0.6)">{{ $comment->conteudo }}</div>
                </div>
            </div>
            @empty
            <p style="color:rgba(232,245,233,0.4);font-size:0.9rem">Ainda não há comentários. Seja o primeiro!</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

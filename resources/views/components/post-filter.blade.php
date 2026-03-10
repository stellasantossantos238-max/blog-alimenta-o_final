@props(['tipo' => null])

<div class="filter-bar">
    <a href="{{ route('posts.index') }}"
       class="filter-btn all {{ !$tipo ? 'active' : '' }}">
        Todos
    </a>
    <a href="{{ route('posts.index', ['tipo' => 'noticia']) }}"
       class="filter-btn noticia {{ $tipo === 'noticia' ? 'active' : '' }}">
        📰 Notícias
    </a>
    <a href="{{ route('posts.index', ['tipo' => 'sugestao']) }}"
       class="filter-btn sugestao {{ $tipo === 'sugestao' ? 'active' : '' }}">
        💡 Sugestões
    </a>
    <a href="{{ route('posts.index', ['tipo' => 'alimentacao_saudavel']) }}"
       class="filter-btn alimentacao_saudavel {{ $tipo === 'alimentacao_saudavel' ? 'active' : '' }}">
        🥗 Alimentação Saudável
    </a>
</div>

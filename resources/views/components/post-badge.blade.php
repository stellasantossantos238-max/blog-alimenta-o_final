@props(['tipo'])

@php
$badges = [
    'noticia'              => ['class' => 'badge-noticia',              'label' => 'NOTÍCIA'],
    'sugestao'             => ['class' => 'badge-sugestao',             'label' => 'SUGESTÃO'],
    'alimentacao_saudavel' => ['class' => 'badge-alimentacao_saudavel', 'label' => 'ALIMENTAÇÃO SAUDÁVEL'],
];
$badge = $badges[$tipo] ?? ['class' => 'badge-noticia', 'label' => strtoupper($tipo)];
@endphp

<span class="post-tipo-badge {{ $badge['class'] }}">{{ $badge['label'] }}</span>

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    // Tipos disponíveis
    const TIPOS = [
        'noticia'              => 'Notícia',
        'sugestao'             => 'Sugestão',
        'alimentacao_saudavel' => 'Alimentação Saudável',
    ];

    // Cores dos badges por tipo
    const TIPO_CORES = [
        'noticia'              => ['bg' => '#2e7d32', 'text' => '#fff', 'label' => 'NOTÍCIA'],
        'sugestao'             => ['bg' => '#1565c0', 'text' => '#fff', 'label' => 'SUGESTÃO'],
        'alimentacao_saudavel' => ['bg' => '#e65100', 'text' => '#fff', 'label' => 'ALIMENTAÇÃO SAUDÁVEL'],
    ];

    protected $fillable = [
        'author_id',
        'titulo',
        'slug',
        'resumo',
        'conteudo',
        'imagem',
        'tipo',
        'publicado',
    ];

    protected $casts = [
        'publicado' => 'boolean',
    ];

    // ─── Scopes ──────────────────────────────────────────────────────────────

    public function scopePublicados(Builder $query): Builder
    {
        return $query->where('publicado', true);
    }

    public function scopeDoTipo(Builder $query, string $tipo): Builder
    {
        return $query->where('tipo', $tipo);
    }

    // ─── Accessors ───────────────────────────────────────────────────────────

    public function getTipoLabelAttribute(): string
    {
        return self::TIPOS[$this->tipo] ?? ucfirst($this->tipo);
    }

    public function getTipoCoresAttribute(): array
    {
        return self::TIPO_CORES[$this->tipo] ?? ['bg' => '#4caf50', 'text' => '#fff', 'label' => strtoupper($this->tipo)];
    }

    // ─── Relationships ───────────────────────────────────────────────────────

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

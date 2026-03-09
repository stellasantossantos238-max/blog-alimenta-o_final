<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserScore extends Model
{
    protected $fillable = [
        'user_id',
        'pontuacao',
        'percentagem_conformidade',
        'semana_inicio',
        'comentario_automatico'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

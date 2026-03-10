<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMonthlyScore extends Model
{
    protected $fillable = [
        'user_id',
        'mes_ano',
        'score',
        'posicao',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

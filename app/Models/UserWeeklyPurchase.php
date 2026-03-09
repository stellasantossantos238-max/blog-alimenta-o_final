<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWeeklyPurchase extends Model
{
    protected $fillable = [
        'user_id',
        'food_id',
        'quantidade_gramas',
        'semana_inicio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}

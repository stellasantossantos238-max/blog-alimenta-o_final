<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{

    public function category()
    {
        return $this->belongsTo(FoodCategory::class, 'food_category_id');
    }

    public function weeklyPurchases()
    {
        return $this->hasMany(UserWeeklyPurchase::class);
    }

    protected $table = 'foods';

    protected $fillable = [
        'food_category_id',
        'nome',
        'descricao',
        'calorias_por_100g',
        'proteinas',
        'carboidratos',
        'gorduras',
        'imagem'
    ];
}


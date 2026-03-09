<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OmsRecommendation extends Model
{
    protected $fillable = [
        'food_category_id',
        'quantidade_diaria_gramas',
        'unidade',
        'descricao'
    ];

    public function category()
    {
        return $this->belongsTo(FoodCategory::class, 'food_category_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    protected $fillable = ['nome', 'descricao', 'icone'];

    public function foods()
    {
        return $this->hasMany(Food::class, 'food_category_id');
    }

    public function omsRecommendations()
    {
        return $this->hasMany(OmsRecommendation::class);
    }
}

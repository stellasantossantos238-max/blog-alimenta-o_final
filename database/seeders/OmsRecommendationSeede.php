<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OmsRecommendation;

class OmsRecommendationSeeder extends Seeder
{
    public function run(): void
    {
        $recommendations = [
            ['food_category_id' => 1, 'quantidade_diaria_gramas' => 400, 'descricao' => 'Mínimo de 400g de hortícolas por dia'],
            ['food_category_id' => 2, 'quantidade_diaria_gramas' => 300, 'descricao' => 'Mínimo de 300g de fruta por dia'],
            ['food_category_id' => 3, 'quantidade_diaria_gramas' => 250, 'descricao' => '250g de cereais integrais por dia'],
            ['food_category_id' => 4, 'quantidade_diaria_gramas' => 150, 'descricao' => '150g de proteínas por dia'],
            ['food_category_id' => 5, 'quantidade_diaria_gramas' => 200, 'descricao' => '200g de laticínios por dia'],
            ['food_category_id' => 6, 'quantidade_diaria_gramas' => 100, 'descricao' => '100g de leguminosas por dia'],
            ['food_category_id' => 7, 'quantidade_diaria_gramas' => 30, 'descricao' => '30g de gorduras saudáveis por dia'],
            ['food_category_id' => 8, 'quantidade_diaria_gramas' => 25, 'descricao' => 'Máximo de 25g de açúcar por dia'],
        ];

        foreach ($recommendations as $rec) {
            OmsRecommendation::create($rec);
        }
    }
}

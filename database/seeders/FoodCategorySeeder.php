<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FoodCategory;

class FoodCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nome' => 'Hortícolas', 'descricao' => 'Legumes e verduras frescas', 'icone' => '🥦'],
            ['nome' => 'Frutas', 'descricao' => 'Frutas frescas e naturais', 'icone' => '🍎'],
            ['nome' => 'Cereais', 'descricao' => 'Cereais e derivados', 'icone' => '🌾'],
            ['nome' => 'Proteínas', 'descricao' => 'Carnes, peixe e ovos', 'icone' => '🥩'],
            ['nome' => 'Laticínios', 'descricao' => 'Leite, queijo e iogurte', 'icone' => '🥛'],
            ['nome' => 'Leguminosas', 'descricao' => 'Feijão, grão e lentilhas', 'icone' => '🫘'],
            ['nome' => 'Gorduras Saudáveis', 'descricao' => 'Azeite, frutos secos', 'icone' => '🫒'],
            ['nome' => 'Açúcares', 'descricao' => 'Doces e açúcares', 'icone' => '🍬'],
        ];

        foreach ($categories as $category) {
            FoodCategory::create($category);
        }
    }
}

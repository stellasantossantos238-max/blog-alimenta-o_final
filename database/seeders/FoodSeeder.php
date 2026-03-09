<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    public function run(): void
    {
        $foods = [
            // Hortícolas (category_id: 1)
            ['food_category_id' => 1, 'nome' => 'Brócolos', 'calorias_por_100g' => 34, 'proteinas' => 2.8, 'carboidratos' => 6.6, 'gorduras' => 0.4],
            ['food_category_id' => 1, 'nome' => 'Cenoura', 'calorias_por_100g' => 41, 'proteinas' => 0.9, 'carboidratos' => 9.6, 'gorduras' => 0.2],
            ['food_category_id' => 1, 'nome' => 'Espinafres', 'calorias_por_100g' => 23, 'proteinas' => 2.9, 'carboidratos' => 3.6, 'gorduras' => 0.4],
            ['food_category_id' => 1, 'nome' => 'Tomate', 'calorias_por_100g' => 18, 'proteinas' => 0.9, 'carboidratos' => 3.9, 'gorduras' => 0.2],
            ['food_category_id' => 1, 'nome' => 'Alface', 'calorias_por_100g' => 15, 'proteinas' => 1.4, 'carboidratos' => 2.9, 'gorduras' => 0.2],
            ['food_category_id' => 1, 'nome' => 'Cebola', 'calorias_por_100g' => 40, 'proteinas' => 1.1, 'carboidratos' => 9.3, 'gorduras' => 0.1],
            // Frutas (category_id: 2)
            ['food_category_id' => 2, 'nome' => 'Maçã', 'calorias_por_100g' => 52, 'proteinas' => 0.3, 'carboidratos' => 13.8, 'gorduras' => 0.2],
            ['food_category_id' => 2, 'nome' => 'Banana', 'calorias_por_100g' => 89, 'proteinas' => 1.1, 'carboidratos' => 22.8, 'gorduras' => 0.3],
            ['food_category_id' => 2, 'nome' => 'Laranja', 'calorias_por_100g' => 47, 'proteinas' => 0.9, 'carboidratos' => 11.8, 'gorduras' => 0.1],
            ['food_category_id' => 2, 'nome' => 'Morango', 'calorias_por_100g' => 32, 'proteinas' => 0.7, 'carboidratos' => 7.7, 'gorduras' => 0.3],
            ['food_category_id' => 2, 'nome' => 'Uva', 'calorias_por_100g' => 69, 'proteinas' => 0.7, 'carboidratos' => 18.1, 'gorduras' => 0.2],
            // Cereais (category_id: 3)
            ['food_category_id' => 3, 'nome' => 'Arroz Integral', 'calorias_por_100g' => 370, 'proteinas' => 7.9, 'carboidratos' => 77.2, 'gorduras' => 2.9],
            ['food_category_id' => 3, 'nome' => 'Aveia', 'calorias_por_100g' => 389, 'proteinas' => 16.9, 'carboidratos' => 66.3, 'gorduras' => 6.9],
            ['food_category_id' => 3, 'nome' => 'Pão Integral', 'calorias_por_100g' => 247, 'proteinas' => 13.0, 'carboidratos' => 41.3, 'gorduras' => 3.4],
            ['food_category_id' => 3, 'nome' => 'Massa Integral', 'calorias_por_100g' => 348, 'proteinas' => 13.0, 'carboidratos' => 70.0, 'gorduras' => 1.9],
            // Proteínas (category_id: 4)
            ['food_category_id' => 4, 'nome' => 'Frango', 'calorias_por_100g' => 165, 'proteinas' => 31.0, 'carboidratos' => 0.0, 'gorduras' => 3.6],
            ['food_category_id' => 4, 'nome' => 'Salmão', 'calorias_por_100g' => 208, 'proteinas' => 20.0, 'carboidratos' => 0.0, 'gorduras' => 13.0],
            ['food_category_id' => 4, 'nome' => 'Ovo', 'calorias_por_100g' => 155, 'proteinas' => 13.0, 'carboidratos' => 1.1, 'gorduras' => 11.0],
            ['food_category_id' => 4, 'nome' => 'Atum', 'calorias_por_100g' => 132, 'proteinas' => 28.0, 'carboidratos' => 0.0, 'gorduras' => 1.0],
            // Laticínios (category_id: 5)
            ['food_category_id' => 5, 'nome' => 'Leite', 'calorias_por_100g' => 61, 'proteinas' => 3.2, 'carboidratos' => 4.8, 'gorduras' => 3.3],
            ['food_category_id' => 5, 'nome' => 'Iogurte Natural', 'calorias_por_100g' => 59, 'proteinas' => 3.5, 'carboidratos' => 4.7, 'gorduras' => 3.3],
            ['food_category_id' => 5, 'nome' => 'Queijo', 'calorias_por_100g' => 402, 'proteinas' => 25.0, 'carboidratos' => 1.3, 'gorduras' => 33.0],
            // Leguminosas (category_id: 6)
            ['food_category_id' => 6, 'nome' => 'Feijão', 'calorias_por_100g' => 337, 'proteinas' => 22.0, 'carboidratos' => 61.0, 'gorduras' => 1.2],
            ['food_category_id' => 6, 'nome' => 'Grão de Bico', 'calorias_por_100g' => 364, 'proteinas' => 19.0, 'carboidratos' => 61.0, 'gorduras' => 6.0],
            ['food_category_id' => 6, 'nome' => 'Lentilhas', 'calorias_por_100g' => 353, 'proteinas' => 25.0, 'carboidratos' => 60.0, 'gorduras' => 1.1],
            // Gorduras Saudáveis (category_id: 7)
            ['food_category_id' => 7, 'nome' => 'Azeite', 'calorias_por_100g' => 884, 'proteinas' => 0.0, 'carboidratos' => 0.0, 'gorduras' => 100.0],
            ['food_category_id' => 7, 'nome' => 'Amêndoas', 'calorias_por_100g' => 579, 'proteinas' => 21.0, 'carboidratos' => 22.0, 'gorduras' => 50.0],
            ['food_category_id' => 7, 'nome' => 'Abacate', 'calorias_por_100g' => 160, 'proteinas' => 2.0, 'carboidratos' => 9.0, 'gorduras' => 15.0],
            // Açúcares (category_id: 8)
            ['food_category_id' => 8, 'nome' => 'Açúcar Branco', 'calorias_por_100g' => 387, 'proteinas' => 0.0, 'carboidratos' => 100.0, 'gorduras' => 0.0],
            ['food_category_id' => 8, 'nome' => 'Mel', 'calorias_por_100g' => 304, 'proteinas' => 0.3, 'carboidratos' => 82.0, 'gorduras' => 0.0],
        ];

        foreach ($foods as $food) {
            Food::create($food);
        }
    }
}

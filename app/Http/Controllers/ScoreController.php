<?php

namespace App\Http\Controllers;

use App\Models\UserWeeklyPurchase;
use App\Models\OmsRecommendation;
use App\Models\UserScore;
use App\Models\FoodCategory;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    public function calcular()
    {
        $semana = now()->startOfWeek()->toDateString();
        $userId = Auth::id();

        $purchases = UserWeeklyPurchase::with('food.category')
            ->where('user_id', $userId)
            ->where('semana_inicio', $semana)
            ->get();

        $recommendations = OmsRecommendation::with('category')->get();

        // Agrupa compras por categoria
        $comprasPorCategoria = [];
        foreach ($purchases as $purchase) {
            $catId = $purchase->food->food_category_id;
            if (!isset($comprasPorCategoria[$catId])) {
                $comprasPorCategoria[$catId] = 0;
            }
            $comprasPorCategoria[$catId] += $purchase->quantidade_gramas;
        }

        // Calcula pontuação
        $totalScore = 0;
        $maxScore = 0;
        $comentarios = [];

        foreach ($recommendations as $rec) {
            $catId = $rec->food_category_id;
            $recomendadoSemana = $rec->quantidade_diaria_gramas * 7;
            $comprado = $comprasPorCategoria[$catId] ?? 0;
            $maxScore += 100;

            if ($comprado == 0) {
                $comentarios[] = "Não comprou nenhum alimento da categoria {$rec->category->nome}. Considere incluir este grupo alimentar.";
                continue;
            }

            $percentagem = ($comprado / $recomendadoSemana) * 100;

            if ($percentagem >= 80 && $percentagem <= 120) {
                $totalScore += 100;
                $comentarios[] = "✅ Excelente! A quantidade de {$rec->category->nome} está dentro das recomendações.";
            } elseif ($percentagem < 80) {
                $score = ($percentagem / 80) * 100;
                $totalScore += $score;
                $comentarios[] = "⚠️ A quantidade de {$rec->category->nome} adquirida é insuficiente para as suas necessidades semanais.";
            } else {
                $score = max(0, 100 - (($percentagem - 120) / 2));
                $totalScore += $score;
                $comentarios[] = "⚠️ Comprou em excesso {$rec->category->nome}. Isso poderá dar origem a desperdício ou excesso de ingestão.";
            }
        }

        $percentagemFinal = $maxScore > 0 ? ($totalScore / $maxScore) * 100 : 0;

        UserScore::updateOrCreate(
            ['user_id' => $userId, 'semana_inicio' => $semana],
            [
                'pontuacao' => round($totalScore, 2),
                'percentagem_conformidade' => round($percentagemFinal, 2),
                'comentario_automatico' => implode("\n", $comentarios),
            ]
        );

        return redirect()->route('profile.show')->with('success', 'Pontuação calculada com sucesso!');
    }
}
